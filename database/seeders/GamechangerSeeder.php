<?php

namespace Database\Seeders;

use App\Models\Gamechanger;
use Illuminate\Database\Seeder;

class GamechangerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $gamechangers = [
            [
                'name' => 'Geschenk!',
                'min_disciplines' => 7,
                'effect' => 'Einen Benutzer bestimmen und dieser schenkt 5 Punkte im FirstLeaderboard.',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a5 5 0 0 0-5 5c0 1.28.38 2.47 1.02 3.5H5v3h14v-3h-3.02A5.012 5.012 0 0 0 17 7a5 5 0 0 0-5-5zm0 2a3 3 0 0 1 3 3c0 .96-.38 1.84-1 2.5H10a3 3 0 0 1-1-2.5 3 3 0 0 1 3-3zM5 14v6h14v-6H5zm2 2h10v2H7v-2z"/></svg>',
            ],
            [
                'name' => 'Diebstahl!',
                'min_disciplines' => 8,
                'effect' => 'Einen Benutzer bestimmen und 5 Punkte stehlen.',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M9 3L5 9h14l-4-6H9zm-4 8v5l5 6V14H5zm14 0h-5v8l5-6v-5z"/></svg>',
            ],
            [
                'name' => 'Gleichstellung!',
                'min_disciplines' => 9,
                'effect' => 'Einen Benutzer bestimmen und die Punkte gleichstellen.',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M6 6h12v2H6zm0 5h12v2H6zm0 5h12v2H6z"/></svg>',
            ],
            [
                'name' => 'Identitätsklau!',
                'min_disciplines' => 10,
                'effect' => 'Einen Benutzer bestimmen und mit diesem im FirstLeaderboard die Punkte tauschen.',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm-1 15h-2v-2h2zm4 0h-2v-2h2zm-4-4h-2v-2h2zm4 0h-2v-2h2z"/></svg>',
            ],
            [
                'name' => 'Sicherheit!',
                'min_disciplines' => 11,
                'effect' => 'Der Benutzer wird für 15 Minuten vor Gamechanger geschützt.',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L3 7v5c0 5 3.84 9.32 9 10 5.16-.68 9-5 9-10V7l-9-5zm0 2.18l7 3.82v4.52c0 4-2.88 7.5-7 8.15-4.12-.65-7-4.15-7-8.15V8l7-3.82zM11 10h2v6h-2zm0 8h2v2h-2z"/></svg>',
            ],
            [
                'name' => 'Neustart!',
                'min_disciplines' => 12,
                'effect' => 'Die FirstLeaderboard wird neu erstellt.',
                'icon' => '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2a10 10 0 0 0-9 5.37l1.45 1.45A8 8 0 1 1 4 12H2a10 10 0 1 0 10-10z"/></svg>',
            ],
        ];

        foreach ($gamechangers as $gamechanger) {
            Gamechanger::create($gamechanger);
        }
    }
}
