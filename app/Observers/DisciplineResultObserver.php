<?php

namespace App\Observers;

use App\Enums\AuditVisibility;
use App\Models\AuditLog;
use App\Models\DisciplineResult;
use App\Models\Gamechanger;
use App\Notifications\GamechangerUnlocked;
use App\Notifications\UserQualified;
use Illuminate\Support\Facades\Cache;

class DisciplineResultObserver
{
    /**
     * Handle the DisciplineResult "created" event.
     */
    public function created(DisciplineResult $disciplineResult): void
    {
        $user = $disciplineResult->user;

        // Cache für abgeschlossene Kategorien löschen
        Cache::forget("user_{$user->id}_completed_all_categories");

        if ($user->hasCompletedAllCategories() && ! $user->qualified) {
            // Benutzer als qualifiziert markieren
            $user->update(['qualified' => true]);

            // 🎉 Benachrichtigung für die Qualifikation senden
            $user->notify(new UserQualified);
        }

        // 🔎 Gamechanger-Prüfung: Gibt es neue Gamechanger für diesen Benutzer?
        $newGamechangers = Gamechanger::where('min_disciplines', '=', $user->completedDisciplines())->get();

        if ($newGamechangers->isNotEmpty()) {
            foreach ($newGamechangers as $gamechanger) {
                // 🏆 Benachrichtigung über neue Gamechanger
                $user->notify(new GamechangerUnlocked($gamechanger));
            }
        }

        AuditLog::create([
            'user_id' => $disciplineResult->user_id,
            'action' => 'Neues Posten-Ergebnis',
            'description' => "Ergebnis für Posten '{$disciplineResult->discipline->name}' gespeichert.",
            'visibility' => AuditVisibility::USER->value,
        ]);
    }

    /**
     * Handle the DisciplineResult "updated" event.
     */
    public function updated(DisciplineResult $disciplineResult): void
    {
        AuditLog::create([
            'user_id' => $disciplineResult->user_id,
            'action' => 'Aktualisiertes Posten-Ergebnis',
            'description' => "Ergebnis für Posten '{$disciplineResult->discipline->name}' aktualisiert.",
            'visibility' => AuditVisibility::USER->value,
        ]);
    }

    /**
     * Handle the DisciplineResult "deleted" event.
     */
    public function deleted(DisciplineResult $disciplineResult): void
    {
        //
    }

    /**
     * Handle the DisciplineResult "restored" event.
     */
    public function restored(DisciplineResult $disciplineResult): void
    {
        //
    }

    /**
     * Handle the DisciplineResult "force deleted" event.
     */
    public function forceDeleted(DisciplineResult $disciplineResult): void
    {
        //
    }
}
