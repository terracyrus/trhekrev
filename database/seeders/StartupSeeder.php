<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class StartupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['name' => 'Aaron', 'password' => '2Mo4.14'],
            ['name' => 'Abigail', 'password' => '1Sa25.3'],
            ['name' => 'Barnabas', 'password' => 'Apg4.36'],
            ['name' => 'Batseba', 'password' => '2Sa11.3'],
            ['name' => 'Cornelius', 'password' => 'Apg10.1'],
            ['name' => 'Chloë', 'password' => '1Ko1.11'],
            ['name' => 'David', 'password' => '1Sa18.1'],
            ['name' => 'Debora', 'password' => 'Rich4.4'],
            ['name' => 'Elia', 'password' => '1Kö17.1'],
            ['name' => 'Elisabeth', 'password' => 'Luk1.5'],
            ['name' => 'Festus', 'password' => 'Apg25.1'],
            ['name' => 'Phoebe', 'password' => 'Röm16.1'],
            ['name' => 'Gideon', 'password' => 'Rich6.11'],
            ['name' => 'Gomer', 'password' => 'Hos1.3'],
            ['name' => 'Hiskia', 'password' => '2Kö18.1'],
            ['name' => 'Hanna', 'password' => '1Sa1.20'],
            ['name' => 'Isaak', 'password' => '1Mo21.3'],
            ['name' => 'Isebel', 'password' => '1Kö16.31'],
            ['name' => 'Jakobus', 'password' => 'Mat4.21'],
            ['name' => 'Jael', 'password' => 'Rich4.17'],
            ['name' => 'Kaleb', 'password' => '4Mo13.30'],
            ['name' => 'Kezia', 'password' => 'Hio42.14'],
            ['name' => 'Lazarus', 'password' => 'Joh11.1'],
            ['name' => 'Lea', 'password' => '1Mo29.16'],
            ['name' => 'Machlon', 'password' => 'Rut1.2'],
            ['name' => 'Maria', 'password' => 'Luk1.27'],
            ['name' => 'Noah', 'password' => '1Mo6.9'],
            ['name' => 'Naomi', 'password' => 'Rut1.2'],
            ['name' => 'Obadja', 'password' => '1Kö18.3'],
            ['name' => 'Orpa', 'password' => 'Rut1.4'],
            ['name' => 'Paulus', 'password' => 'Apg9.4'],
            ['name' => 'Priszilla', 'password' => 'Apg18.2'],
            ['name' => 'Quartus', 'password' => 'Röm16.23'],
            ['name' => 'Quirinius', 'password' => 'Luk2.2'],
            ['name' => 'Rehabeam', 'password' => '1Kö11.43'],
            ['name' => 'Rahel', 'password' => '1Mo29.6'],
            ['name' => 'Samuel', 'password' => '1Sam3.4'],
            ['name' => 'Sara', 'password' => '1Mo17.15'],
            ['name' => 'Thomas', 'password' => 'Joh20.24'],
            ['name' => 'Tamar', 'password' => '1Mo38.6'],
            ['name' => 'Urija', 'password' => '2Sa11.3'],
            ['name' => 'Usa', 'password' => '2Sa6.3'],
            ['name' => 'Wanja', 'password' => 'Esr10.36'],
            ['name' => 'Washti', 'password' => 'Est1.9'],
            ['name' => 'Xerxes', 'password' => 'Esr4.6'],
            ['name' => 'Zacharias', 'password' => 'Luk1.5'],
            ['name' => 'Zippora', 'password' => '2Mo2.21'],
            ['name' => 'Abel', 'password' => '1Mo4.2'],
            ['name' => 'Achsa', 'password' => 'Jos15.16'],
            ['name' => 'Bartimäus', 'password' => 'Mark10.46'],
            ['name' => 'Basemat', 'password' => '1Mo26.34'],
            ['name' => 'Chuza', 'password' => 'Luk8.3'],
            ['name' => 'Damaris', 'password' => 'Apg17.34'],
            ['name' => 'Demas', 'password' => 'Kol4.14'],
            ['name' => 'Elischeba', 'password' => '2Mo6.23'],
            ['name' => 'Esra', 'password' => 'Esr7.1'],
            ['name' => 'Felix', 'password' => 'Apg23.24'],
            ['name' => 'Fortunatus', 'password' => '1Kor16.17'],
        ];

        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'email' => $user['name'] . '@example.com',
                'password' => $user['password'],
                'role' => 'user',
            ]);
        }

        $leaderboard = [
            ['name' => 'Gideon', 'points' => 108],
            ['name' => 'David', 'points' => 105],
            ['name' => 'Hanna', 'points' => 103],
            ['name' => 'Esra', 'points' => 101],
            ['name' => 'Rahel', 'points' => 100],
            ['name' => 'Lea', 'points' => 99],
            ['name' => 'Orpa', 'points' => 98],
            ['name' => 'Abel', 'points' => 97],
            ['name' => 'Achsa', 'points' => 97],
            ['name' => 'Samuel', 'points' => 95],
            ['name' => 'Kaleb', 'points' => 94],
            ['name' => 'Isaak', 'points' => 93],
            ['name' => 'Quartus', 'points' => 93],
            ['name' => 'Aaron', 'points' => 92],
            ['name' => 'Quirinius', 'points' => 91],
            ['name' => 'Elisabeth', 'points' => 89],
            ['name' => 'Lazarus', 'points' => 88],
            ['name' => 'Maria', 'points' => 87],
            ['name' => 'Washti', 'points' => 85],
            ['name' => 'Felix', 'points' => 84],
            ['name' => 'Rehabeam', 'points' => 82],
            ['name' => 'Festus', 'points' => 81],
            ['name' => 'Obadja', 'points' => 80],
            ['name' => 'Thomas', 'points' => 78],
            ['name' => 'Wanja', 'points' => 77],
            ['name' => 'Tamar', 'points' => 76],
            ['name' => 'Chuza', 'points' => 74],
            ['name' => 'Barnabas', 'points' => 73],
            ['name' => 'Naomi', 'points' => 73],
            ['name' => 'Kezia', 'points' => 72],
            ['name' => 'Chloë', 'points' => 71],
            ['name' => 'Demas', 'points' => 70],
            ['name' => 'Phoebe', 'points' => 69],
            ['name' => 'Jakobus', 'points' => 68],
            ['name' => 'Noah', 'points' => 67],
            ['name' => 'Elia', 'points' => 66],
            ['name' => 'Elischeba', 'points' => 66],
            ['name' => 'Bartimäus', 'points' => 65],
            ['name' => 'Zacharias', 'points' => 64],
            ['name' => 'Fortunatus', 'points' => 63],
            ['name' => 'Gomer', 'points' => 62],
            ['name' => 'Paulus', 'points' => 61],
            ['name' => 'Debora', 'points' => 60],
            ['name' => 'Jael', 'points' => 59],
            ['name' => 'Sara', 'points' => 58],
            ['name' => 'Zippora', 'points' => 57],
            ['name' => 'Hiskia', 'points' => 56],
            ['name' => 'Batseba', 'points' => 54],
            ['name' => 'Priszilla', 'points' => 53],
            ['name' => 'Damaris', 'points' => 52],
            ['name' => 'Xerxes', 'points' => 51],
            ['name' => 'Urija', 'points' => 50],
            ['name' => 'Cornelius', 'points' => 49],
            ['name' => 'Basemat', 'points' => 49],
            ['name' => 'Usa', 'points' => 48],
            ['name' => 'Isebel', 'points' => 47],
            ['name' => 'Abigail', 'points' => 46],
            ['name' => 'Machlon', 'points' => 45],
        ];

        foreach ($leaderboard as $entry) {
            $user = User::where('name', $entry['name'])->first();
            $user->firstLeaderboard()->create([
                'points' => $entry['points'],
            ]);
        }

        for ($i = 1; $i < 10; $i++) {
            User::create([
                'name' => 'Operator_' . $i,
                'email' => 'operator' . $i . '@example.com',
                'password' => 'Markus9.30-' . $i,
                'role' => 'operator',
            ]);
        }
    }
}
