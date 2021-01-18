<?php

namespace Aujicini\Moderation\Test;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\TestCase as Orchestra;
use Aujicini\Moderation\ModerationServiceProvider;

abstract class TestCase extends Orchestra
{
    /**
     * Setup the laravel test application.
     *
     * @return void Returns nothing.
     */
    public function setUp(): void
    {
        parent::setUp();
        $this->setUpDatabase($this->app);
        $this->setUpRoutes();
        User::create([
            'email' => 'test@test.com'
        ]);
    }

    /**
     * Get the package providers.
     *
     * @param  \Illuminate\Foundation\Application $app The laravel test application.
     *
     * @return array Returns a list of service providers.
     */
    protected function getPackageProviders($app)
    {
        return [
            ModerationServiceProvider::class,
        ];
    }

    /**
     * Set up the environment.
     *
     * @param \Illuminate\Foundation\Application $app The laravel test application.
     *
     * @return void Returns nothing.
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'sqlite');
        $app['config']->set('database.connections.sqlite', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);
    }

    /**
     * Set up the database.
     *
     * @param \Illuminate\Foundation\Application $app The laravel test application.
     *
     * @return void Returns nothing.
     */
    protected function setUpDatabase($app)
    {
        $app['db']->connection()->getSchemaBuilder()->create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->timestamps();
        });
        include_once __DIR__.'/../database/migrations/2021_01_03_000002_add_ip_columns.php';
        include_once __DIR__.'/../database/migrations/2021_01_03_000003_add_banned_columns.php';
        (new \AddIpColumns())->up();
        (new \AddBannedColumns())->up();
    }

    /**
     * Set up the applications routes.
     *
     * @return void Returns nothing.
     */
    protected function setUpRoutes()
    {
        $this->app['router']->ban();
        $this->app['router']->getRoutes()->refreshNameLookups();
    }
}
