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

        // return $userResult->points;
    }

    /**
     * Check if a user has an entry in this discipline and return their ranking.
     *
     * @param  int  $disciplineId
     * @param  int  $userId
     * @return int The user's rank or 0 if they have no entry.
     */
    public function rank(User $user): int
    {
        $inRanking = $this->results->where('user_id', $user->id)->first();

        return $inRanking === null ? 0 : $this->results
            ->where('points', $this->sortTableFor('points'), $this->points($user))
            ->count() + 1;
    }

    public function getLeaderboard(): \Illuminate\Database\Eloquent\Collection
    {
        $query = $this->results()
            ->join('users', 'discipline_results.user_id', '=', 'users.id')
            ->orderBy('discipline_results.points', $this->sortTableFor('db'))
            ->select('users.name', 'discipline_results.points');

        // Check if it's a time-based discipline
        if ($this->isTime()) {
            $query->selectRaw('
                FLOOR(discipline_results.points / 60) AS minutes,
                FLOOR(discipline_results.points % 60) AS seconds
            ');
        }

        return $query->get()->map(function ($result) {
            if ($this->isTime()) {
                $result->formatted_points = sprintf('%02d:%02d', $result->minutes, $result->seconds);
                unset($result->minutes, $result->seconds); // Clean up unnecessary fields
            } else {
                $result->formatted_points = (string) $result->points; // Keep points as-is if not time-based
            }

            return $result;
        });
    }

    public function sortTableFor(string $type = 'db'): string
    {
        return match ($type) {
            'db' => $this->order ? 'desc' : 'asc',
            'points' => $this->order ? '>' : '<',
            'text' => $this->order ? 'gross nach klein' : 'klein nach gross',
            default => '',
        };
    }

    public function isTime(): bool
    {
        return $this->type === 'time';
    }
}
