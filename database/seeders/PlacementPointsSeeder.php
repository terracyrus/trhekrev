<?php

namespace Database\Seeders;

use App\Models\PlacementPoints;
use Illuminate\Database\Seeder;

class PlacementPointsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = [
            ['placement_start' => 1, 'placement_end' => 1, 'points' => 15],
            ['placement_start' => 2, 'placement_end' => 2, 'points' => 14],
            ['placement_start' => 3, 'placement_end' => 3, 'points' => 13],
            ['placement_start' => 4, 'placement_end' => 4, 'points' => 12],
            ['placement_start' => 5, 'placement_end' => 9, 'points' => 11],
            ['placement_start' => 10, 'placement_end' => 14, 'points' => 10],
            ['placement_start' => 15, 'placement_end' => 19, 'points' => 9],
            ['placement_start' => 20, 'placement_end' => 24, 'points' => 8],
            ['placement_start' => 25, 'placement_end' => 29, 'points' => 7],
            ['placement_start' => 30, 'placement_end' => 34, 'points' => 6],
            ['placement_start' => 35, 'placement_end' => 39, 'points' => 5],
            ['placement_start' => 40, 'placement_end' => 50, 'points' => 4],
        ];

        foreach ($data as $entry) {
            PlacementPoints::create($entry);
        }
    }
}
