<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Erste Hilfe',
            'abbreviation' => 'EH',
        ]);

        Category::create([
            'name' => 'Feuer und Food',
            'abbreviation' => 'FF',
        ]);

        Category::create([
            'name' => 'Jungschar',
            'abbreviation' => 'J',
        ]);

        Category::create([
            'name' => 'Natur',
            'abbreviation' => 'N',
        ]);

        Category::create([
            'name' => 'Orientierung',
            'abbreviation' => 'O',
        ]);

        Category::create([
            'name' => 'Pioniertechnik',
            'abbreviation' => 'P',
        ]);
    }
}
