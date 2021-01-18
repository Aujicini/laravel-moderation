<?php

namespace Aujicini\Moderation;

use Illuminate\Support\ServiceProvider;

class ModerationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void Returns nothing.
     */
    public function boot()
    {
        $this->registerRoutesMacro();
        $this->registerMigrations();
        $this->registerPublishing();
    }

    /**
     * Register the application services.
     *
     * @return void Returns nothing.
     */
    public function register()
    {
        $this->configure();
    }

    /**
     * Register routes macro.
     *
     * @return void Returns nothing.
     */
    protected function registerRoutesMacro()
    {
        $router = $this->app['router'];
        $router->macro('ban', function () use ($router) {
            $router->get('/moderation/ban/{id}',
                'Aujicini\Moderation\Http\Controllers\BanController@ban')->name('ban.user');
            $router->get('/moderation/ipban/{id}',
                'Aujicini\Moderation\Http\Controllers\BanController@ipban')->name('ipban.user');
            $router->get('/moderation/unban/{id}',
                'Aujicini\Moderation\Http\Controllers\BanController@unban')->name('unban.user');
        });
    }

    /**
     * Setup the configuration for Moderation.
     *
     * @return void Returns nothing.
     */
    protected function configure()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/moderation.php', 'moderation'
        );
    }

    /**
     * Register the package migrations.
     *
     * @return void Returns nothing.
     */
    protected function registerMigrations()
    {
        if (Moderation::$runsMigrations && $this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        }
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void Returns nothing.
     */
    protected function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/moderation.php' => $this->app->configPath('moderation.php'),
            ], 'moderation-config');
            $this->publishes([
                __DIR__.'/../database/migrations' => $this->app->databasePath('migrations'),
            ], 'moderation-migrations');
        }
    }
}
