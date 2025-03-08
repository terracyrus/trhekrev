<?php

namespace App\Models;

use App\Enums\FirstLeaderboardPoints;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FirstLeaderboard extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'points'];

    public static function reset(User $request_user): void
    {
        $users = $request_user->getPlayers();

        // Get immune users
        $immuneUsers = $users->filter(fn ($user) => $user->isImmune());

        // Get non-immune users and their points
        $nonImmuneUsers = $users->reject(fn ($user) => $user->isImmune());
        $nonImmunePoints = $nonImmuneUsers->pluck('firstLeaderboard.points')->shuffle();

        // Shuffle points only among non-immune users
        $i = 0;
        foreach ($nonImmuneUsers as $user) {
            if (isset($nonImmunePoints[$i])) {
                FirstLeaderboard::updateOrCreate(
                    ['user_id' => $user->id],
                    ['points' => $nonImmunePoints[$i]]
                );
                $i++;
            }
        }

        // Immune users keep their points
        foreach ($immuneUsers as $user) {
            FirstLeaderboard::updateOrCreate(
                ['user_id' => $user->id],
                ['points' => $user->firstLeaderboard->points ?? FirstLeaderboardPoints::MIN->value]
            );
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
