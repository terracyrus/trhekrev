<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gamechanger extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'min_disciplines', 'effect', 'icon'];

    public function actions()
    {
        return $this->hasMany(GamechangerAction::class);
    }

    public function execute(User $request_user, ?User $target_user): void
    {
        switch ($this->name) {
            case 'Geschenk!':
                FirstLeaderboard::where('user_id', $target_user->id)
                    ->increment('points', 5);
                FirstLeaderboard::where('user_id', $request_user->id)
                    ->decrement('points', 5);
                break;
            case 'Diebstahl!':
                FirstLeaderboard::where('user_id', $target_user->id)
                    ->decrement('points', 5);
                FirstLeaderboard::where('user_id', $request_user->id)
                    ->increment('points', 5);
                break;
            case 'Gleichstellung!':
                $points = FirstLeaderboard::where('user_id', $request_user->id)->value('points');
                FirstLeaderboard::where('user_id', $target_user->id)->update(['points' => $points]);
                break;
            case 'Sicherheit!':
                // t.b.d.
                break;
            case 'Identitätsklau!':
                $points1 = FirstLeaderboard::where('user_id', $request_user->id)->value('points');
                $points2 = FirstLeaderboard::where('user_id', $target_user->id)->value('points');
                FirstLeaderboard::where('user_id', $request_user->id)->update(['points' => $points2]);
                FirstLeaderboard::where('user_id', $target_user->id)->update(['points' => $points1]);
                break;
            case 'Neustart!':
                FirstLeaderboard::reset($request_user);
                break;
        }
    }
}
