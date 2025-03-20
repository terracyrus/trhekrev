<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OverallLeaderboard extends Model
{
    protected $fillable = ['user_id', 'total_points'];

    /**
     * Aktualisiert die Gesamtpunkte für alle Benutzer.
     */
    public static function updateOverallLeaderboard(): void
    {
        // Holt alle Benutzer mit mindestens einem Ergebnis in der Disziplinen-Tabelle
        $eligibleUsers = User::whereHas('disciplineResults')->get()
            ->filter(fn ($user) => $user->hasCompletedAllCategories());

        // Berechnet die Gesamtpunkte für jeden berechtigten Benutzer
        foreach ($eligibleUsers as $user) {
            // Alle Ergebnisse des Nutzers abrufen
            $results = DisciplineResult::where('user_id', $user->id)->get();

            // Falls der Benutzer keine Ergebnisse hat → 0 Punkte
            if ($results->isEmpty()) {
                $totalPoints = 0;
            } else {
                $totalPoints = $results->sum(fn ($result) => $result->getPointsForOverall());
            }

            self::updateOrCreate(
                ['user_id' => $user->id],
                ['total_points' => $totalPoints]
            );
        }
    }

    public static function getOverallLeaderboard(): \Illuminate\Support\Collection
    {
        // Alle Spieler mit Punkten aus beiden Leaderboards holen
        $players = User::where('role', 'user')
            ->with(['overallLeaderboard', 'firstLeaderboard'])
            ->get()
            ->map(function ($user) {
                $overallPoints = $user->overallLeaderboard->total_points ?? 0;
                $firstPoints = $user->firstLeaderboard->points ?? 0;
                $difference = abs($overallPoints - $firstPoints);
                $completedDisciplines = $user->completedDisciplines();
                $completedCategories = $user->numberCompletedCategories();

                return (object) [
                    'user' => $user,
                    'overall_points' => $overallPoints,
                    'first_points' => $firstPoints,
                    'difference' => $difference,
                    'completed_disciplines' => $completedDisciplines,
                    'completed_categories' => $completedCategories,
                ];
            })
            ->sortBy([
                fn ($a, $b) => $b->completed_categories <=> $a->completed_categories,
                fn ($a, $b) => $a->difference <=> $b->difference,
                fn ($a, $b) => $b->completed_disciplines <=> $a->completed_disciplines,
            ])
            ->values(); // Indizes nach Sortierung zurücksetzen

        // 📌 Platzierung korrekt berechnen (Platzsprünge bei Punktgleichheit)
        $previousDifference = null;
        $currentRank = 0;
        $realRank = 0;

        return $players->map(function ($player, $index) use (&$previousDifference, &$currentRank, &$realRank) {
            // Falls Punktdifferenz sich vom vorherigen Ergebnis unterscheidet, erhöhe die reale Platzierung
            if ($player->difference !== $previousDifference) {
                $realRank = $index + 1; // Reale Position
                $currentRank = $realRank; // Setze die aktuelle Platzierung
            }

            // Platzierung setzen
            $player->placement = $currentRank;

            $previousDifference = $player->difference;

            return $player;
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
