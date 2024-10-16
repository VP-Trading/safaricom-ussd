<?php

namespace Vptrading\SafaricomUssd;

use Illuminate\Support\ServiceProvider;

class SafaricomUssdServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'vptrading');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'vptrading');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/safaricom-ussd.php', 'safaricom-ussd');

        // Register the service the package provides.
        $this->app->singleton('safaricom-ussd', function ($app) {
            return new SafaricomUssd;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['safaricom-ussd'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/safaricom-ussd.php' => config_path('safaricom-ussd.php'),
        ], 'safaricom-ussd.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/vptrading'),
        ], 'safaricom-ussd.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/vptrading'),
        ], 'safaricom-ussd.assets');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/vptrading'),
        ], 'safaricom-ussd.lang');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
