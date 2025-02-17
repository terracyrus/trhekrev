<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OverallLeaderboard extends Model
{
    protected $fillable = ['user_id', 'total_points'];

    /**
     * Aktualisiert die Gesamtpunkte für alle Benutzer.
     */
    public static function updateOverallLeaderboard()
    {
        $users = User::all();

        foreach ($users as $user) {
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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getOverallLeaderboard(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->orderBy('points', 'desc')->get();
    }
}
