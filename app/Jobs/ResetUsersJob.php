<?php

namespace App\Jobs;

use App\Models\FirstLeaderboard;
use App\Models\User;
use Database\Seeders\StartupSeeder;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;

class ResetUsersJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct() {}

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        User::where('role', 'user')->delete();
        User::where('role', 'operator')->delete();
        FirstLeaderboard::truncate();

        (new StartupSeeder)->run();

    }
}
