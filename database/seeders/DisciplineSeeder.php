<?php

namespace Database\Seeders;

use App\Enums\DisciplineType;
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
            'name' => 'EH1.1',
            'type' => DisciplineType::POINT->value,
            'order' => DisciplineType::POINT->getOrder(),
            'category_id' => $firstAid->id,
        ]);

        Discipline::create([
            'name' => 'EH1.2',
            'type' => DisciplineType::TIME->value,
            'order' => DisciplineType::TIME->getOrder(),
            'category_id' => $firstAid->id,
        ]);

        Discipline::create([
            'name' => 'EH2',
            'type' => DisciplineType::TIME->value,
            'order' => DisciplineType::TIME->getOrder(),
            'category_id' => $firstAid->id,
        ]);

        Discipline::create([
            'name' => 'EH3',
            'type' => DisciplineType::TIME->value,
            'order' => DisciplineType::TIME->getOrder(),
            'category_id' => $firstAid->id,
        ]);

        $fireAndFood = Category::where('name', 'Feuer und Food')->first();

        Discipline::create([
            'name' => 'FF1',
            'type' => DisciplineType::TIME->value,
            'order' => DisciplineType::TIME->getOrder(),
            'category_id' => $fireAndFood->id,
        ]);

        Discipline::create([
            'name' => 'FF2',
            'type' => DisciplineType::POINT->value,
            'order' => DisciplineType::POINT->getOrder(),
            'category_id' => $fireAndFood->id,
        ]);

        Discipline::create([
            'name' => 'FF3.1',
            'type' => DisciplineType::POINT->value,
            'order' => DisciplineType::POINT->getOrder(),
            'category_id' => $fireAndFood->id,
        ]);

        Discipline::create([
            'name' => 'FF3.2',
            'type' => DisciplineType::POINT->value,
            'order' => DisciplineType::POINT->getOrder(),
            'category_id' => $fireAndFood->id,
        ]);

        Discipline::create([
            'name' => 'FF3.3',
            'type' => DisciplineType::POINT->value,
            'order' => DisciplineType::POINT->getOrder(),
            'category_id' => $fireAndFood->id,
        ]);

        $jungschar = Category::where('name', 'Jungschar')->first();

        Discipline::create([
            'name' => 'J1.1',
            'type' => DisciplineType::TIME->value,
            'order' => DisciplineType::TIME->getOrder(),
            'category_id' => $jungschar->id,
        ]);

        Discipline::create([
            'name' => 'J1.2',
            'type' => DisciplineType::POINT->value,
            'order' => DisciplineType::POINT->getOrder(),
            'category_id' => $jungschar->id,
        ]);

        Discipline::create([
            'name' => 'J2.1',
            'type' => DisciplineType::POINT->value,
            'order' => DisciplineType::POINT->getOrder(0),
            'category_id' => $jungschar->id,
        ]);

        Discipline::create([
            'name' => 'J2.2',
            'type' => DisciplineType::POINT->value,
            'order' => DisciplineType::POINT->getOrder(),
            'category_id' => $jungschar->id,
        ]);

        Discipline::create([
            'name' => 'J2.3',
            'type' => DisciplineType::TIME->value,
            'order' => DisciplineType::TIME->getOrder(),
            'category_id' => $jungschar->id,
        ]);

        Discipline::create([
            'name' => 'J3',
            'type' => DisciplineType::TIME->value,
            'order' => DisciplineType::TIME->getOrder(),
            'category_id' => $jungschar->id,
        ]);

        Discipline::create([
            'name' => 'J4',
            'type' => DisciplineType::TIME->value,
            'order' => DisciplineType::TIME->getOrder(),
            'category_id' => $jungschar->id,
        ]);

        $natur = Category::where('name', 'Natur')->first();

        Discipline::create([
            'name' => 'N1.1',
            'type' => DisciplineType::TIME->value,
            'order' => DisciplineType::TIME->getOrder(),
            'category_id' => $natur->id,
        ]);

        Discipline::create([
            'name' => 'N1.2',
            'type' => DisciplineType::POINT->value,
            'order' => DisciplineType::POINT->getOrder(),
            'category_id' => $natur->id,
        ]);

        Discipline::create([
            'name' => 'N2',
            'type' => DisciplineType::POINT->value,
            'order' => DisciplineType::POINT->getOrder(),
            'category_id' => $natur->id,
        ]);

        Discipline::create([
            'name' => 'N3',
            'type' => DisciplineType::TIME->value,
            'order' => DisciplineType::TIME->getOrder(),
            'category_id' => $natur->id,
        ]);

        $orientierung = Category::where('name', 'Orientierung')->first();

        Discipline::create([
            'name' => 'O1.1',
            'type' => DisciplineType::TIME->value,
            'order' => DisciplineType::TIME->getOrder(),
            'category_id' => $orientierung->id,
        ]);

        Discipline::create([
            'name' => 'O2.1',
            'type' => DisciplineType::TIME->value,
            'order' => DisciplineType::TIME->getOrder(),
            'category_id' => $orientierung->id,
        ]);

        Discipline::create([
            'name' => 'O3.1',
            'type' => DisciplineType::TIME->value,
            'order' => DisciplineType::TIME->getOrder(),
            'category_id' => $orientierung->id,
        ]);

        Discipline::create([
            'name' => 'O1.2',
            'type' => DisciplineType::TIME->value,
            'order' => DisciplineType::TIME->getOrder(),
            'category_id' => $orientierung->id,
        ]);

        Discipline::create([
            'name' => 'O2.2',
            'type' => DisciplineType::TIME->value,
            'order' => DisciplineType::TIME->getOrder(),
            'category_id' => $orientierung->id,
        ]);

        Discipline::create([
            'name' => 'O3.2',
            'type' => DisciplineType::TIME->value,
            'order' => DisciplineType::TIME->getOrder(),
            'category_id' => $orientierung->id,
        ]);

        Discipline::create([
            'name' => 'O1.3',
            'type' => DisciplineType::TIME->value,
            'order' => DisciplineType::TIME->getOrder(),
            'category_id' => $orientierung->id,
        ]);

        Discipline::create([
            'name' => 'O2.3',
            'type' => DisciplineType::TIME->value,
            'order' => DisciplineType::TIME->getOrder(),
            'category_id' => $orientierung->id,
        ]);

        Discipline::create([
            'name' => 'O3.3',
            'type' => DisciplineType::TIME->value,
            'order' => DisciplineType::TIME->getOrder(),
            'category_id' => $orientierung->id,
        ]);

        $pioniertechnik = Category::where('name', 'Pioniertechnik')->first();

        Discipline::create([
            'name' => 'P1',
            'type' => DisciplineType::POINT->value,
            'order' => DisciplineType::POINT->getOrder(),
            'category_id' => $pioniertechnik->id,
        ]);

        Discipline::create([
            'name' => 'P2',
            'type' => DisciplineType::TIME->value,
            'order' => DisciplineType::TIME->getOrder(),
            'category_id' => $pioniertechnik->id,
        ]);

        Discipline::create([
            'name' => 'P3',
            'type' => DisciplineType::POINT->value,
            'order' => DisciplineType::POINT->getOrder(),
            'category_id' => $pioniertechnik->id,
        ]);

        Discipline::create([
            'name' => 'P4.1',
            'type' => DisciplineType::TIME->value,
            'order' => DisciplineType::TIME->getOrder(),
            'category_id' => $pioniertechnik->id,
        ]);

        Discipline::create([
            'name' => 'P4.2',
            'type' => DisciplineType::TIME->value,
            'order' => DisciplineType::TIME->getOrder(),
            'category_id' => $pioniertechnik->id,
        ]);
    }
}
