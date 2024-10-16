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
        $this->mergeConfigFrom(__DIR__ . '/../config/safaricom-ussd.php', 'safaricom-ussd');

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
            __DIR__ . '/../config/safaricom-ussd.php' => config_path('safaricom-ussd.php'),
        ], 'safaricom-ussd.config');
    }
}
