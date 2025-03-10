import csv
import random
import re
from locust import HttpUser, task, between

# Load test users from CSV
def load_users():
    users = []
    with open("users.csv", "r") as file:
        reader = csv.DictReader(file)
        for row in reader:
            # print(f"🔹 Loaded User: {row}")  # Debugging log
            users.append(row)
    return users

test_users = load_users()  # Load users at script start

print(f"🟢 Loaded {len(test_users)} test users")  # Debugging log

class AuthenticatedUser(HttpUser):
    wait_time = between(1, 5)  # Random wait time between requests
    token = None
    user_data = None

    def on_start(self):
        """Pick a random user and log in."""
        self.user_data = random.choice(test_users)
        self.login()

    def login(self):
        """Authenticate and store session token with CSRF protection."""
        # 🔹 Step 1: Fetch login page to get CSRF token
        login_page = self.client.get("/login")
        csrf_token = self.get_csrf_token(login_page.text)

        if not csrf_token:
            print("❌ Failed to retrieve CSRF token. Aborting login.")
            exit(2)
            return

        # 🔹 Step 2: Submit login form with CSRF token
        response = self.client.post(
            "/login",
            data={
                "_token": csrf_token,  # CSRF Token
                "name": self.user_data["name"],  # Using 'name' instead of 'email'
                "password": self.user_data["password"],
            },
            headers={"Referer": "http://localhost:8000/login"},  # Required by Laravel
        )

        # 🔹 Step 3: Check login success
        if response.status_code == 200 and "dashboard" in response.text.lower():
            print(f"✅ Logged in as {self.user_data['name']}")
            self.token = response.cookies.get("laravel_session")
        else:
            print(f"❌ Login Failed - Response: {response.text}")

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
            print(f"⏳ Submitting time-based result: {data['minutes']}m {data['seconds']}s")
        else:
            data = {
                "_method": "PUT",
                "_token": self.get_csrf_token(page_content),
                "points": random.randint(100, 1000)  # Random points
            }
            print(f"🎯 Submitting points result: {data['points']}")

        response = self.client.post(f"/disciplines/{discipline_id}", data=data, cookies={"laravel_session": self.token})
        print(f"📌 Submission status: {response.status_code}")

    def get_csrf_token(self, html_content):
        """Extract CSRF token from Laravel login form."""
        match = re.search(r'name="_token" value="(.+?)"', html_content)
        return match.group(1) if match else None