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

    public function getAllResultsOfDiscipline()
    {
        return $this->where('discipline_id', $this->discipline_id)->get();
    }
}
