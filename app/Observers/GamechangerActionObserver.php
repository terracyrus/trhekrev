<?php

namespace App\Observers;

use App\Enums\AuditVisibility;
use App\Models\AuditLog;
use App\Models\GamechangerAction;
use Illuminate\Support\Facades\Auth;

class GamechangerActionObserver
{
    /**
     * Handle the GamechangerAction "created" event.
     */
    public function created(GamechangerAction $gamechangerAction): void
    {
        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Gamechanger erstellt',
            'description' => "Gamechanger '{$gamechangerAction->name}' wurde erstellt.",
            'visibility' => AuditVisibility::ADMIN->value,
        ]);
    }

    /**
     * Handle the GamechangerAction "updated" event.
     */
    public function updated(GamechangerAction $gamechangerAction): void
    {
        //
    }

    /**
     * Handle the GamechangerAction "deleted" event.
     */
    public function deleted(GamechangerAction $gamechangerAction): void
    {
        //
    }

    /**
     * Handle the GamechangerAction "restored" event.
     */
    public function restored(GamechangerAction $gamechangerAction): void
    {
        //
    }

    /**
     * Handle the GamechangerAction "force deleted" event.
     */
    public function forceDeleted(GamechangerAction $gamechangerAction): void
    {
        //
    }
}
