<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Discipline extends Model
{
    use HasFactory;

    public function results()
    {
        return $this->hasMany(DisciplineResult::class);
    }

    public function points(User $user): int
    {
        return $this->results->where('user_id', $user->id)->first()->points;
    }

    public function rank(User $user): int
    {
        return $this->results()
            ->where('points', '>', $this->points($user))
            ->count() + 1;
    }

    public function getLeaderboard(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->results()
            ->join('users', 'discipline_results.user_id', '=', 'users.id')
            ->orderBy('discipline_results.points', 'desc')
            ->select('users.name', 'discipline_results.points')
            ->get();
    }
}
