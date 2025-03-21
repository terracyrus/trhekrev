<?php

namespace Database\Seeders;

use App\Models\FirstLeaderboard;
use App\Models\User;
use Illuminate\Database\Seeder;

class FirstLeaderboardSeeder extends Seeder
{
    public function run()
    {
        FirstLeaderboard::truncate();
        $users = User::where('role', 'user')->get();

        $data = [];

        foreach ($users as $user) {
            $data[] = [
                'user_id' => $user->id,
                'points' => rand(60, 140),
            ];
        }

        FirstLeaderboard::insert($data);
    }
}
