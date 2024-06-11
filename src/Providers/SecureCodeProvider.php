<?php

namespace Smarg2847\SecureCode\Providers;

use Illuminate\Support\ServiceProvider;

/**
 * class SecureCodeProvider
 * This class registers the package within Laravel.
 *
 * @package Smarg2847\SecureCode\Providers
 */
class SecureCodeProvider extends ServiceProvider
{
    /**
     * Register the application services.
     */
    public function register(): void
    {
        // Merge the package configuration with the Laravel application's configuration.
        $this->mergeConfigFrom(__DIR__ . '/../../config/securecode.php', 'securecode');

    }
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Publish the package configuration file to the Laravel application.
        $this->publishes([
            __DIR__ . '/../../config/securecode.php' => config_path('securecode.php'),
        ], 'config');

        // Publish the package's migrations.
        $this->publishes([
            __DIR__.'/../../database/migrations' => database_path('migrations'),
        ], 'securecode-migrations');

    }
}
