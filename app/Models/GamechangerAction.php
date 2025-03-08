<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GamechangerAction extends Model
{
    use HasFactory;

    protected $fillable = ['gamechanger_id', 'requested_by', 'executed_by', 'target_user'];

    public function gamechanger(): BelongsTo
    {
        return $this->belongsTo(Gamechanger::class);
    }

    public function requestedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'requested_by');
    }

    public function executedBy()
    {
        return $this->belongsTo(User::class, 'executed_by');
    }

    public function targetUser()
    {
        return $this->belongsTo(User::class, 'target_user');
    }
}
