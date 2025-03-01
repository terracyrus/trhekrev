<?php

namespace Database\Seeders;

use App\Models\FirstLeaderboard;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        for ($i = 0; $i < 10; $i++) {
            $user = User::create([
                'role' => 'user',
                'name' => 'User_' . $i,
                'email' => 'user' . $i . '@example.com',
                'password' => 'password',
            ]);

            FirstLeaderboard::create([
                'user_id' => $user->id,
                'points' => rand(70, 110),
            ]);
        }

        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'admin',
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Operator',
            'email' => 'operator@example.com',
            'role' => 'operator',
            'password' => 'operator',
        ]);
    }
}
