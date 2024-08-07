<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Passwords\PasswordBrokerManager;
use Illuminate\Support\Facades\Password;

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

        $this->app->bind('auth.password.admin', function ($app) {
            return (new PasswordBrokerManager($app))->broker('admins');
        });
    }
}
