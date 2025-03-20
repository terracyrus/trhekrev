<?php

namespace App\Observers;

use App\Enums\AuditVisibility;
use App\Models\AuditLog;
use App\Models\GamechangerAction;
use App\Notifications\GamechangerActivated;
use Illuminate\Support\Facades\Auth;

class GamechangerActionObserver
{
    /**
     * Handle the GamechangerAction "created" event.
     */
    public function created(GamechangerAction $gamechangerAction): void
    {
        $description = "Gamechanger '{$gamechangerAction->gamechanger->name}' wurde durch Gruppe '{$gamechangerAction->requestedBy->name}' auf ";
        if ($gamechangerAction->gamechanger->name === 'Neustart!') {
            $users = $gamechangerAction->requestedBy->getPlayers();
            foreach ($users as $user) {
                $user->notify(new GamechangerActivated($gamechangerAction->gamechanger, $gamechangerAction->requestedBy, $user->isImmune()));
            }
            $description .= 'alle';
        } elseif ($gamechangerAction->gamechanger->name === 'Sicherheit!') {
            $description .= 'auf sich selbst';
        } elseif ($gamechangerAction->targetUser) {
            $gamechangerAction->targetUser->notify(new GamechangerActivated($gamechangerAction->gamechanger, $gamechangerAction->requestedBy));
            $description .= $gamechangerAction->targetUser->name;
        }

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'Gamechanger erstellt',
            'description' => $description . ' ausgeführt.',
            'visibility' => AuditVisibility::OPERATOR->value,
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
