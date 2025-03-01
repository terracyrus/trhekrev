<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DisciplineResult extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'discipline_id', 'points'];

    /**
     * Get the placement (ranking) of a user in a specific discipline.
     */
    public static function getPlacement($userId, $disciplineId)
    {
        $rankedUsers = self::where('discipline_id', $disciplineId)
            ->orderByDesc('points')  // Higher points = better rank
            ->pluck('user_id')
            ->toArray();

        $placement = array_search($userId, $rankedUsers);

        return $placement !== false ? $placement + 1 : null; // Return 1-based rank
    }

    public function discipline()
    {
        return $this->belongsTo(Discipline::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getAllResultsOfDiscipline()
    {
        return $this->where('discipline_id', $this->discipline_id)->get();
    }

    /**
     * Gibt die Punkte basierend auf der Platzierung zurück.
     *
     * @return int
     */
    public function getPointsForOverall()
    {
        $placement = $this->getPlacement($this->user_id, $this->discipline_id);

        return PlacementPoints::getPointsForPlacement($placement);
    }
}
