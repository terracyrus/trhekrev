<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlacementPoints extends Model
{
    use HasFactory;

    protected $fillable = ['placement_start', 'placement_end', 'points'];

    /**
     * Holt die Punkte für eine gegebene Platzierung.
     */
    public static function getPointsForPlacement(int $placement): int
    {
        $rule = self::where(function ($query) use ($placement) {
            $query->where('placement_start', '<=', $placement)
                ->where('placement_end', '>=', $placement);
        })
            ->orWhere('placement_start', $placement) // Falls es eine einzelne Platzierung ist
            ->first();

        return $rule ? $rule->points : 0; // 0 Punkte, wenn keine Regel gefunden
    }
}
