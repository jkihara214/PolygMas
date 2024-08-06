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
        $cookieName = request()->is('admin*') ? 'session.cookie_admin' : 'session.cookie';
        config(['session.cookie' => config($cookieName)]);
    }
}
