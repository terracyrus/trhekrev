<?php

namespace Database\Seeders;

use App\Models\Discipline;
use App\Models\DisciplineResult;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role' => 'user',
        ]);

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'admin',
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Operator',
            'email' => 'operator@example.com',
            'role' => 'operator',
        ]);

        Discipline::factory()->create([
            'name' => 'Puzzle',
            'type' => 'time',
        ]);

        Discipline::factory()->create([
            'name' => 'Bibel',
            'type' => 'time',
        ]);

        Discipline::factory()->create([
            'name' => 'Karten',
            'type' => 'points',
        ]);

        DisciplineResult::factory()->create([
            'user_id' => 1,
            'discipline_id' => 3,
            'points' => 100,
        ]);

        DisciplineResult::factory()->create([
            'user_id' => 1,
            'discipline_id' => 2,
            'points' => 100,
        ]);

        DisciplineResult::factory()->create([
            'user_id' => 1,
            'discipline_id' => 1,
            'points' => 100,
        ]);

        DisciplineResult::factory()->create([
            'user_id' => 3,
            'discipline_id' => 3,
            'points' => 300,
        ]);

        DisciplineResult::factory()->create([
            'user_id' => 2,
            'discipline_id' => 3,
            'points' => 200,
        ]);

    }
}
