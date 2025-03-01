<?php

namespace App\Observers;

use App\Enums\AuditVisibility;
use App\Models\AuditLog;
use App\Models\DisciplineResult;

class DisciplineResultObserver
{
    /**
     * Handle the DisciplineResult "created" event.
     */
    public function created(DisciplineResult $disciplineResult): void
    {
        AuditLog::create([
            'user_id' => $disciplineResult->user_id,
            'action' => 'Neues Disziplin-Ergebnis',
            'description' => "Ergebnis für Disziplin '{$disciplineResult->discipline->name}' gespeichert.",
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
            'action' => 'Aktualisiertes Disziplin-Ergebnis',
            'description' => "Ergebnis für Disziplin '{$disciplineResult->discipline->name}' aktualisiert.",
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
