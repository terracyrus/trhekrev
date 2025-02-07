<?php

namespace Database\Seeders;

use App\Models\Discipline;
use Illuminate\Database\Seeder;

class DisciplineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $timeDisciplines = [
            'Eh1.1 Erste Hilfe',
            'Eh1.2 Erste Hilfe',
            'Eh3 Erste Hilfe',
            'Eh4 Erste Hilfe',
            'FF1 Feuer und Food',
            'FF2 Feuer und Food',
            'FF3.1 Feuer und Food',
            'FF3.2 Feuer und Food',
            'FF3.3 Feuer und Food',
            'O1 Orientierung',
            'P1 Pioniertechnik',
            'P2 Pioniertechnik',
            'P3 Pioniertechnik',
            'P4 Pioniertechnik',
        ];

        $pointsDisciplines = [
            'N1.2 Natur',
            'N2 Natur',
            'N3 Natur',
            'O2 Orientierung',
            'O3 Orientierung',
        ];

        foreach ($timeDisciplines as $timeDiscipline) {
            Discipline::create([
                'name' => $timeDiscipline,
                'type' => 'time',
                'order' => random_int(0, 1),
            ]);
        }

        foreach ($pointsDisciplines as $pointDiscipline) {
            Discipline::create([
                'name' => $pointDiscipline,
                'type' => 'point',
                'order' => random_int(0, 1),
            ]);
        }
    }
}
