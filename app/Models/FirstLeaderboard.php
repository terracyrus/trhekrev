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
        FirstLeaderboard::truncate();
        $users = $request_user->getPlayers();

        foreach ($users as $user) {
            FirstLeaderboard::create([
                'user_id' => $user->id,
                'points' => rand(FirstLeaderboardPoints::MIN->value, FirstLeaderboardPoints::MAX->value), // Zufällige Initialpunkte
            ]);
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
