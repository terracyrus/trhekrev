<?php

namespace Database\Seeders;

use App\Models\Discipline;
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
        ]);

        Discipline::factory()->create([
            'name' => 'Bibel',
        ]);

        Discipline::factory()->create([
            'name' => 'Karten',
        ]);
    }
}
