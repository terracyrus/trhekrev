<?php

namespace Database\Seeders;

use App\Models\Discipline;
use App\Models\DisciplineResult;
use App\Models\User;
use Illuminate\Database\Seeder;

class DisciplineResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $disciplines = Discipline::all();
        $users = User::where('role', 'user')->get();

        foreach ($disciplines as $discipline) {
            foreach ($users as $user) {
                DisciplineResult::factory()->create([
                    'user_id' => $user,
                    'discipline_id' => $discipline,
                    'points' => $discipline->type === 'points' ? rand(0, 1000) : rand(0, 3600),
                ]);
            }
        }
    }
}
