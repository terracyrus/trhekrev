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
}
