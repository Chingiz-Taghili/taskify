<?php

namespace App\Providers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Allow superadmin for all abilities
        Gate::before(function (User $user, string $ability) {
            return $user->hasRole('superadmin') ? true : null;
        });

        // Set Carbon as the default date implementation for Laravel
        Date::use(Carbon::class);
    }
}
