<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OverallLeaderboard extends Model
{
    protected $fillable = ['user_id', 'total_points'];

    /**
     * Aktualisiert die Gesamtpunktzahl aller Benutzer basierend auf den Disziplin-Ergebnissen.
     */
    public static function updateOverallLeaderboard()
    {
        // Alle Benutzer mit Ergebnissen abrufen
        $userPoints = DisciplineResult::selectRaw('user_id, SUM(points) as total_points')
            ->groupBy('user_id')
            ->get();

        foreach ($userPoints as $user) {
            OverallLeaderboard::updateOrCreate(
                ['user_id' => $user->user_id],
                ['total_points' => $user->total_points]
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
