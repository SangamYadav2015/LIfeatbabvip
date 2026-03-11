<?php
namespace App\Providers;

use App\Auth\CustomPasswordBrokerManager;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton('auth.password', function ($app) {
            return new CustomPasswordBrokerManager($app);
        });
    }

    public function boot()
    {
       
    }
}
