<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Livewire\Livewire;

class RemoveImmunity implements ShouldQueue
{
    use Queueable;

    protected User $user;

    /**
     * Create a new job instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Remove immunity
        $this->user->update(['immunity_until' => null]);

        // Trigger Livewire refresh
        Livewire::dispatch('refreshImmunity');
    }
}
