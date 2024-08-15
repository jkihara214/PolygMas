<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Passwords\PasswordBrokerManager;
use Illuminate\Support\Facades\Password;
use App\Services\GeminiService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(GeminiService::class, function ($app) {
            return new GeminiService();
        });
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
