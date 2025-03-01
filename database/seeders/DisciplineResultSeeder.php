<?php

namespace Database\Seeders;

use App\Models\Discipline;
use App\Models\DisciplineResult;
use App\Models\OverallLeaderboard;
use App\Models\User;
use Illuminate\Database\Seeder;

class DisciplineResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::getPlayers();
        $disciplines = Discipline::all();

        foreach ($users as $user) {
            // Determine number of disciplines for each user
            $disciplineCount = $user->id === 1 ? 12 : rand(7, 13);

            // Select random unique disciplines for the user
            $selectedDisciplines = $disciplines->random($disciplineCount);

            foreach ($selectedDisciplines as $discipline) {
                DisciplineResult::create([
                    'user_id' => $user->id,
                    'discipline_id' => $discipline->id,
                    'points' => $discipline->type === 'points' ? rand(0, 1000) : rand(0, 3600),
                ]);
            }
        }

        // Update overall leaderboard
        OverallLeaderboard::updateOverallLeaderboard();
    }
}
