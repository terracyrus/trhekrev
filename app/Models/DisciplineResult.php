<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class DisciplineResult extends Model
{
    use HasFactory;

    public function discipline()
    {
        return $this->belongsTo(Discipline::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function hasScoreInDiscipline(User $user): bool
    {
        $results = self::where(Discipline::class, $this->discipline())->where(User::class, $user)
            ->orderBy('points', 'desc')
            ->pluck('user_id')
            ->toArray();

        // Find the user's rank (array index + 1 because rank starts at 1)
        $rank = array_search($user->id, $results);

        return $rank !== false ? $rank + 1 : null;
    }
}
