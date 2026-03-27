<?php

namespace App\Providers;

use App\Models\Team;
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
        Gate::define('manage-role', function (User $user, User $target) {
            return $user->outranks($target);
        });

        Gate::define('create-team', function (User $user): bool {
            return $user->can('manage teams');
        });

        Gate::define('manage-team', function (User $user, Team $team): bool {
            if ($user->can('manage teams')) {
                return true;
            }

            return $team->users()
                ->where('users.id', $user->id)
                ->wherePivotIn('role', ['owner', 'admin'])
                ->exists();
        });
    }
}
