<?php

namespace Database\Seeders;

use App\Models\FirstLeaderboard;
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
            ['name' => 'Aaron', 'password' => '2Mo4.14', 'points' => 92],
            ['name' => 'Abigail', 'password' => '1Sa25.3', 'points' => 46],
            ['name' => 'Barnabas', 'password' => 'Apg4.36', 'points' => 73],
            ['name' => 'Batseba', 'password' => '2Sa11.3', 'points' => 54],
            ['name' => 'Cornelius', 'password' => 'Apg10.1', 'points' => 49],
            ['name' => 'Chloë', 'password' => '1Ko1.11', 'points' => 71],
            ['name' => 'David', 'password' => '1Sa18.1', 'points' => 105],
            ['name' => 'Debora', 'password' => 'Rich4.4', 'points' => 60],
            ['name' => 'Elia', 'password' => '1Kö17.1', 'points' => 66],
            ['name' => 'Elisabeth', 'password' => 'Luk1.5', 'points' => 89],
            ['name' => 'Festus', 'password' => 'Apg25.1', 'points' => 81],
            ['name' => 'Phoebe', 'password' => 'Röm16.1', 'points' => 69],
            ['name' => 'Gideon', 'password' => 'Rich6.11', 'points' => 108],
            ['name' => 'Gomer', 'password' => 'Hos1.3', 'points' => 62],
            ['name' => 'Hiskia', 'password' => '2Kö18.1', 'points' => 56],
            ['name' => 'Hanna', 'password' => '1Sa1.20', 'points' => 103],
            ['name' => 'Isaak', 'password' => '1Mo21.3', 'points' => 93],
            ['name' => 'Isebel', 'password' => '1Kö16.31', 'points' => 47],
            ['name' => 'Jakobus', 'password' => 'Mat4.21', 'points' => 68],
            ['name' => 'Jael', 'password' => 'Rich4.17', 'points' => 59],
            ['name' => 'Kaleb', 'password' => '4Mo13.30', 'points' => 94],
            ['name' => 'Kezia', 'password' => 'Hio42.14', 'points' => 72],
            ['name' => 'Lazarus', 'password' => 'Joh11.1', 'points' => 88],
            ['name' => 'Lea', 'password' => '1Mo29.16', 'points' => 99],
            ['name' => 'Machlon', 'password' => 'Rut1.2', 'points' => 45],
            ['name' => 'Maria', 'password' => 'Luk1.27', 'points' => 87],
            ['name' => 'Noah', 'password' => '1Mo6.9', 'points' => 67],
            ['name' => 'Naomi', 'password' => 'Rut1.2', 'points' => 73],
            ['name' => 'Obadja', 'password' => '1Kö18.3', 'points' => 80],
            ['name' => 'Orpa', 'password' => 'Rut1.4', 'points' => 98],
            ['name' => 'Paulus', 'password' => 'Apg9.4', 'points' => 61],
            ['name' => 'Priszilla', 'password' => 'Apg18.2', 'points' => 53],
            ['name' => 'Quartus', 'password' => 'Röm16.23', 'points' => 93],
            ['name' => 'Quirinius', 'password' => 'Luk2.2', 'points' => 91],
            ['name' => 'Rehabeam', 'password' => '1Kö11.43', 'points' => 82],
            ['name' => 'Rahel', 'password' => '1Mo29.6', 'points' => 100],
            ['name' => 'Samuel', 'password' => '1Sam3.4', 'points' => 95],
            ['name' => 'Sara', 'password' => '1Mo17.15', 'points' => 58],
            ['name' => 'Thomas', 'password' => 'Joh20.24', 'points' => 78],
            ['name' => 'Tamar', 'password' => '1Mo38.6', 'points' => 76],
            ['name' => 'Urija', 'password' => '2Sa11.3', 'points' => 50],
            ['name' => 'Usa', 'password' => '2Sa6.3', 'points' => 48],
            ['name' => 'Wanja', 'password' => 'Esr10.36', 'points' => 77],
            ['name' => 'Washti', 'password' => 'Est1.9', 'points' => 85],
            ['name' => 'Xerxes', 'password' => 'Esr4.6', 'points' => 51],
            ['name' => 'Zacharias', 'password' => 'Luk1.5', 'points' => 64],
            ['name' => 'Zippora', 'password' => '2Mo2.21', 'points' => 57],
            ['name' => 'Abel', 'password' => '1Mo4.2', 'points' => 97],
            ['name' => 'Achsa', 'password' => 'Jos15.16', 'points' => 97],
            ['name' => 'Bartimäus', 'password' => 'Mark10.46', 'points' => 65],
            ['name' => 'Basemat', 'password' => '1Mo26.34', 'points' => 49],
            ['name' => 'Chuza', 'password' => 'Luk8.3', 'points' => 74],
            ['name' => 'Damaris', 'password' => 'Apg17.34', 'points' => 52],
            ['name' => 'Demas', 'password' => 'Kol4.14', 'points' => 70],
            ['name' => 'Elischeba', 'password' => '2Mo6.23', 'points' => 66],
            ['name' => 'Esra', 'password' => 'Esr7.1', 'points' => 101],
            ['name' => 'Felix', 'password' => 'Apg23.24', 'points' => 84],
            ['name' => 'Fortunatus', 'password' => '1Kor16.17', 'points' => 63],
            ['name' => 'Gabriel', 'password' => 'Dan8.16', 'points' => 62],
            ['name' => 'Goliat', 'password' => '1Sam17.4', 'points' => 79],
            ['name' => 'Haggit', 'password' => '2Sam3.4', 'points' => 96],
            ['name' => 'Habakuk', 'password' => 'Hab1.1', 'points' => 102],
            ['name' => 'Iddo', 'password' => '1Kö4.14', 'points' => 86],
        ];

        foreach ($users as $user) {
            $created = User::create([
                'name' => $user['name'],
                'email' => $user['name'] . '@example.com',
                'password' => $user['password'],
                'role' => 'user',
            ]);

            FirstLeaderboard::create([
                'user_id' => $created->id,
                'points' => $user['points'],
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

        User::create([
            'name' => 'Viewer',
            'email' => 'viewer@example',
            'password' => 'viewer',
            'role' => 'viewer',
        ]);
    }
}
