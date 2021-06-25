<?php

namespace Leekman\AuthenticateAsAnyone;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Support\ServiceProvider;

class AuthenticateAsAnyoneServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/auth-as-anyone.php', 'AuthAsAnyone');
        $this->loadViewsFrom(__DIR__.'/views', 'authenticate-as-anyone');

        include __DIR__.'/routes.php';
    }

    /**
     * Bootstrap services.
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function boot()
    {
        $this->app->make(AuthenticateAsAnyoneController::class);
        $this->publishes([
            __DIR__.'/config/auth-as-anyone.php' => config_path('auth-as-anyone.php')
        ]);
    }
}
