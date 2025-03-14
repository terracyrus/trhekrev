import csv
import random
import re
import threading
from locust import HttpUser, task, between

# Global Lock and Sets to Avoid Duplicate Logins
lock = threading.Lock()
used_users = set()
used_operators = set()

# Load test users from CSV
def load_users():
    users, operators = [], []
    with open("users.csv", "r") as file:
        reader = csv.DictReader(file)
        for row in reader:
            # print(f"🔹 Loaded User: {row}")  # Debugging log
            if row.get("role") == "operator":
                operators.append(row)
            else:
                users.append(row)
    return users, operators

test_users, test_operators = load_users()  # Load users at script start

print(f"🟢 Loaded {len(test_users)} regular users")  # Debugging log
print(f"🟠 Loaded {len(test_operators)} operators")  # Debugging log

class BaseUser(HttpUser):
    """Base class for all users"""
    wait_time = between(1, 5)
    token = None
    user_data = None

    def login(self):
        """Authenticate the user and store session token."""
        login_page = self.client.get("/login")
        csrf_token = self.get_csrf_token(login_page.text)

        if not csrf_token:
            print("❌ Failed to retrieve CSRF token. Aborting login.")
            return

        response = self.client.post(
            "/login",
            data={
                "_token": csrf_token,
                "name": self.user_data["name"],
                "password": self.user_data["password"],
            },
            headers={"Referer": "http://localhost:8000/login"},
        )

        if response.status_code == 200 and "dashboard" in response.text.lower():
            print(f"✅ Logged in as {self.user_data['name']} (Role: {self.user_data['role']})")
            self.token = response.cookies.get("laravel_session")
        else:
            print(f"❌ Login Failed for {self.user_data['name']}")

    def get_csrf_token(self, html_content):
        """Extract CSRF token from Laravel login form."""
        match = re.search(r'name="_token" value="(.+?)"', html_content)
        return match.group(1) if match else None
    
    @task
    def dummy_task(self):
        pass  # Placeholder task

class RegularUser(BaseUser, HttpUser):
    weight = 5  # Regular users run 3x more than Operators

    """Simulates a normal user"""
    def on_start(self):
        global used_users
        with lock:
            available_users = [user for user in test_users if user["name"] not in used_users]
            if not available_users:
                print("❌ No available test users")
                return

            self.user_data = random.choice(available_users)
            used_users.add(self.user_data["name"])
        self.login()


    @task(2)
    def edit_random_discipline(self):
        """Select a random discipline and open the edit page."""
        discipline_id = random.randint(1, 20)  # Adjust based on actual discipline count

        response = self.client.get(f"/disciplines/{discipline_id}/edit", cookies={"laravel_session": self.token})
        
        if response.status_code == 200:
            print(f"🔍 Loaded discipline {discipline_id} edit page.")
            self.submit_discipline_result(discipline_id, response.text)
        else:
            print(f"⚠️ Could not load discipline {discipline_id}.")

    def submit_discipline_result(self, discipline_id, page_content):
        """Submit a result for a discipline based on its type (time-based or points)."""
        is_time_based = "Minute:Sekunde" in page_content  # Detect if it's a time discipline

        if is_time_based:
            data = {
                "_method": "PUT",
                "_token": self.get_csrf_token(page_content),
                "minutes": random.randint(0, 5),  # Random minutes
                "seconds": random.randint(0, 59)  # Random seconds
            }
            #print(f"⏳ Submitting time-based result: {data['minutes']}m {data['seconds']}s")
        else:
            data = {
                "_method": "PUT",
                "_token": self.get_csrf_token(page_content),
                "points": random.randint(100, 1000)  # Random points
            }
            #print(f"🎯 Submitting points result: {data['points']}")

        response = self.client.post(f"/disciplines/{discipline_id}", data=data, cookies={"laravel_session": self.token})
        print(f"📌 Submission status: {response.status_code}")

    def get_csrf_token(self, html_content):
        """Extract CSRF token from Laravel login form."""
        match = re.search(r'name="_token" value="(.+?)"', html_content)
        return match.group(1) if match else None
    
class OperatorUser(BaseUser, HttpUser):
    weight = 1  # Operators runs less frequently

    """Simulates an Operator performing Gamechanger actions."""
    def on_start(self):
        global used_operators
        with lock:
            available_operators = [op for op in test_operators if op["name"] not in used_operators]
            if not available_operators:
                print("❌ No available test operators")
                return

            self.user_data = random.choice(available_operators)
            used_operators.add(self.user_data["name"])

        self.login()

    @task(3)
    def execute_gamechanger(self):
        """Operator executes a Gamechanger action."""

        selected_gamechanger = random.randint(1,2)
        requested_user = 1092
        target_user = random.randint(1087,1091)

        # Ensure the target is different from the requester
        if requested_user == target_user:
            return

        # Fetch CSRF token
        gamechanger_page = self.client.get("/gamechangerAction", cookies={"laravel_session": self.token})
        csrf_token = self.get_csrf_token(gamechanger_page.text)

        if not csrf_token:
            print("❌ Could not fetch CSRF token for Gamechanger execution.")
            return

        # Submit the form with the Gamechanger data
        data = {
            "_token": csrf_token,
            "gamechanger_id": selected_gamechanger,
            "requested_by": requested_user,
            "target_user": target_user,
            "count": random.randint(1, 10),  # Ensure max execution limit
        }

        response = self.client.post("/gamechangerAction", data=data, cookies={"laravel_session": self.token})

        if response.status_code == 200:
            print(f"✅ Applied Gamechanger {selected_gamechanger} by User {requested_user} to Target {target_user}")
        else:
            print(f"❌ Failed to apply Gamechanger {selected_gamechanger}")


# Ensures Locust detects the test users
class LoadTest:
    tasks = [RegularUser, OperatorUser]