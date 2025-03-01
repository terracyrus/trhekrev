<?php

namespace App\Providers;

use App\Models\DisciplineResult;
use App\Models\GamechangerAction;
use App\Models\User;
use App\Observers\DisciplineResultObserver;
use App\Observers\GamechangerActionObserver;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // add Gates for roles
        Gate::define('admin-access', fn (User $user) => $user->isAdmin());
        Gate::define('operator-access', fn (User $user) => $user->isOperatorOrAdmin());
        Gate::define('user', fn (User $user) => $user->role === 'user');

        // Add Observers
        GamechangerAction::observe(GamechangerActionObserver::class);
        DisciplineResult::observe(DisciplineResultObserver::class);
    }
}
