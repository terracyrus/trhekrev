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
            ['name' => 'Aaron', 'password' => '2Mo4.14', 'points' => 112],
            ['name' => 'Abigail', 'password' => '1Sa25.3', 'points' => 66],
            ['name' => 'Barnabas', 'password' => 'Apg4.36', 'points' => 93],
            ['name' => 'Batseba', 'password' => '2Sa11.3', 'points' => 116],
            ['name' => 'Cornelius', 'password' => 'Apg10.1', 'points' => 119],
            ['name' => 'Chloë', 'password' => '1Ko1.11', 'points' => 91],
            ['name' => 'David', 'password' => '1Sa18.1', 'points' => 115],
            ['name' => 'Debora', 'password' => 'Rich4.4', 'points' => 80],
            ['name' => 'Elia', 'password' => '1Kö17.1', 'points' => 86],
            ['name' => 'Elisabeth', 'password' => 'Luk1.5', 'points' => 109],
            ['name' => 'Festus', 'password' => 'Apg25.1', 'points' => 101],
            ['name' => 'Phoebe', 'password' => 'Röm16.1', 'points' => 89],
            ['name' => 'Gideon', 'password' => 'Rich6.11', 'points' => 130],
            ['name' => 'Gomer', 'password' => 'Hos1.3', 'points' => 82],
            ['name' => 'Hiskia', 'password' => '2Kö18.1', 'points' => 76],
            ['name' => 'Hanna', 'password' => '1Sa1.20', 'points' => 123],
            ['name' => 'Isaak', 'password' => '1Mo21.3', 'points' => 113],
            ['name' => 'Isebel', 'password' => '1Kö16.31', 'points' => 67],
            ['name' => 'Jakobus', 'password' => 'Mat4.21', 'points' => 88],
            ['name' => 'Jael', 'password' => 'Rich4.17', 'points' => 117],
            ['name' => 'Kaleb', 'password' => '4Mo13.30', 'points' => 94],
            ['name' => 'Kezia', 'password' => 'Hio42.14', 'points' => 92],
            ['name' => 'Lazarus', 'password' => 'Joh11.1', 'points' => 108],
            ['name' => 'Lea', 'password' => '1Mo29.16', 'points' => 99],
            ['name' => 'Machlon', 'password' => 'Rut1.2', 'points' => 61],
            ['name' => 'Maria', 'password' => 'Luk1.27', 'points' => 83],
            ['name' => 'Noah', 'password' => '1Mo6.9', 'points' => 87],
            ['name' => 'Naomi', 'password' => 'Rut1.2', 'points' => 114],
            ['name' => 'Obadja', 'password' => '1Kö18.3', 'points' => 100],
            ['name' => 'Orpa', 'password' => 'Rut1.4', 'points' => 118],
            ['name' => 'Paulus', 'password' => 'Apg9.4', 'points' => 81],
            ['name' => 'Priszilla', 'password' => 'Apg18.2', 'points' => 73],
            ['name' => 'Quartus', 'password' => 'Röm16.23', 'points' => 103],
            ['name' => 'Quirinius', 'password' => 'Luk2.2', 'points' => 111],
            ['name' => 'Rehabeam', 'password' => '1Kö11.43', 'points' => 102],
            ['name' => 'Rahel', 'password' => '1Mo29.6', 'points' => 110],
            ['name' => 'Samuel', 'password' => '1Sam3.4', 'points' => 125],
            ['name' => 'Sara', 'password' => '1Mo17.15', 'points' => 78],
            ['name' => 'Thomas', 'password' => 'Joh20.24', 'points' => 98],
            ['name' => 'Tamar', 'password' => '1Mo38.6', 'points' => 95],
            ['name' => 'Urija', 'password' => '2Sa11.3', 'points' => 121],
            ['name' => 'Usa', 'password' => '2Sa6.3', 'points' => 68],
            ['name' => 'Wanja', 'password' => 'Esr10.36', 'points' => 97],
            ['name' => 'Washti', 'password' => 'Est1.9', 'points' => 104],
            ['name' => 'Xerxes', 'password' => 'Esr4.6', 'points' => 71],
            ['name' => 'Zacharias', 'password' => 'Luk1.5', 'points' => 65],
            ['name' => 'Zippora', 'password' => '2Mo2.21', 'points' => 77],
            ['name' => 'Abel', 'password' => '1Mo4.2', 'points' => 107],
            ['name' => 'Achsa', 'password' => 'Jos15.16', 'points' => 106],
            ['name' => 'Bartimäus', 'password' => 'Mark10.46', 'points' => 85],
            ['name' => 'Basemat', 'password' => '1Mo26.34', 'points' => 69],
            ['name' => 'Chuza', 'password' => 'Luk8.3', 'points' => 74],
            ['name' => 'Damaris', 'password' => 'Apg17.34', 'points' => 72],
            ['name' => 'Demas', 'password' => 'Kol4.14', 'points' => 70],
            ['name' => 'Elischeba', 'password' => '2Mo6.23', 'points' => 120],
            ['name' => 'Esra', 'password' => 'Esr7.1', 'points' => 105],
            ['name' => 'Felix', 'password' => 'Apg23.24', 'points' => 84],
            ['name' => 'Fortunatus', 'password' => '1Kor16.17', 'points' => 63],
            ['name' => 'Gabriel', 'password' => 'Dan8.16', 'points' => 64],
            ['name' => 'Goliat', 'password' => '1Sam17.4', 'points' => 79],
            ['name' => 'Haggit', 'password' => '2Sam3.4', 'points' => 96],
            ['name' => 'Habakuk', 'password' => 'Hab1.1', 'points' => 122],
            ['name' => 'Iddo', 'password' => '1Kö4.14', 'points' => 62],
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
