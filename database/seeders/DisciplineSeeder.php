<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Discipline;
use Illuminate\Database\Seeder;

class DisciplineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $firstAid = Category::where('name', 'Erste Hilfe')->first();

        Discipline::create([
            'name' => 'Eh1.1',
            'type' => 'point',
            'order' => 1,
            'category_id' => $firstAid->id,
        ]);

        Discipline::create([
            'name' => 'Eh1.2',
            'type' => 'time',
            'order' => 0,
            'category_id' => $firstAid->id,
        ]);

        Discipline::create([
            'name' => 'Eh2',
            'type' => 'time',
            'order' => 0,
            'category_id' => $firstAid->id,
        ]);

        Discipline::create([
            'name' => 'Eh3',
            'type' => 'time',
            'order' => 0,
            'category_id' => $firstAid->id,
        ]);

        $fireAndFood = Category::where('name', 'Feuer und Food')->first();

        Discipline::create([
            'name' => 'FF1',
            'type' => 'time',
            'order' => 0,
            'category_id' => $fireAndFood->id,
        ]);

        Discipline::create([
            'name' => 'FF2',
            'type' => 'point',
            'order' => 1,
            'category_id' => $fireAndFood->id,
        ]);

        Discipline::create([
            'name' => 'FF3.1',
            'type' => 'point',
            'order' => 1,
            'category_id' => $fireAndFood->id,
        ]);

        Discipline::create([
            'name' => 'FF3.2',
            'type' => 'point',
            'order' => 1,
            'category_id' => $fireAndFood->id,
        ]);

        Discipline::create([
            'name' => 'FF3.3',
            'type' => 'point',
            'order' => 1,
            'category_id' => $fireAndFood->id,
        ]);

        $jungschar = Category::where('name', 'Jungschar')->first();

        Discipline::create([
            'name' => 'J2.1',
            'type' => 'point',
            'order' => 0,
            'category_id' => $jungschar->id,
        ]);

        Discipline::create([
            'name' => 'J2.2',
            'type' => 'point',
            'order' => 1,
            'category_id' => $jungschar->id,
        ]);

        Discipline::create([
            'name' => 'J2.3',
            'type' => 'time',
            'order' => 0,
            'category_id' => $jungschar->id,
        ]);

        Discipline::create([
            'name' => 'J3',
            'type' => 'time',
            'order' => 0,
            'category_id' => $jungschar->id,
        ]);

        $natur = Category::where('name', 'Natur')->first();

        Discipline::create([
            'name' => 'N1.1',
            'type' => 'time',
            'order' => 0,
            'category_id' => $natur->id,
        ]);

        Discipline::create([
            'name' => 'N2',
            'type' => 'point',
            'order' => 1,
            'category_id' => $natur->id,
        ]);

        Discipline::create([
            'name' => 'N3',
            'type' => 'time',
            'order' => 0,
            'category_id' => $natur->id,
        ]);

        $orientierung = Category::where('name', 'Orientierung')->first();

        Discipline::create([
            'name' => 'O1',
            'type' => 'time',
            'order' => 0,
            'category_id' => $orientierung->id,
        ]);

        Discipline::create([
            'name' => 'O2',
            'type' => 'time',
            'order' => 0,
            'category_id' => $orientierung->id,
        ]);

        Discipline::create([
            'name' => 'O3',
            'type' => 'time',
            'order' => 0,
            'category_id' => $orientierung->id,
        ]);

        $pioniertechnik = Category::where('name', 'Pioniertechnik')->first();

        Discipline::create([
            'name' => 'P1',
            'type' => 'points',
            'order' => 1,
            'category_id' => $pioniertechnik->id,
        ]);

        Discipline::create([
            'name' => 'P2',
            'type' => 'time',
            'order' => 0,
            'category_id' => $pioniertechnik->id,
        ]);

        Discipline::create([
            'name' => 'P3',
            'type' => 'time',
            'order' => 0,
            'category_id' => $pioniertechnik->id,
        ]);

        Discipline::create([
            'name' => 'P4.1',
            'type' => 'time',
            'order' => 0,
            'category_id' => $pioniertechnik->id,
        ]);

        Discipline::create([
            'name' => 'P4.2',
            'type' => 'time',
            'order' => 0,
            'category_id' => $pioniertechnik->id,
        ]);
    }
}
