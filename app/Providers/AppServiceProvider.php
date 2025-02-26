<?php

namespace App\Providers;

use App\Models\User;
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
        Gate::define('admin-access', fn (User $user) => $user->role === 'admin');
        Gate::define('operator-access', fn (User $user) => in_array($user->role, ['admin', 'operator']));
        Gate::define('user', fn (User $user) => $user->role === 'user');
    }
}
