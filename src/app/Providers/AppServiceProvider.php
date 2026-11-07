<?php

namespace App\Providers;

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
        \Illuminate\Support\Facades\Gate::define('manage-tasks', fn (\App\Models\User $user) => $user->isAdmin());
        \Illuminate\Support\Facades\Gate::define('view-user-progress', fn (\App\Models\User $user) => $user->isAdmin());
        \Illuminate\Support\Facades\Gate::define('manage-roles', fn (\App\Models\User $user) => $user->isSuperAdmin());
    }
}
