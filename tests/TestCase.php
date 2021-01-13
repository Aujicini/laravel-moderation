<?php

namespace Aujicini\Moderation\Test;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Schema;
use Orchestra\Testbench\TestCase as Orchestra;
use Aujicini\Moderation\ModerationServiceProvider;

abstract class TestCase extends Orchestra
{
    public function setUp(): void
    {
        parent::setUp();
        $this->setUpDatabase($this->app);
    }

    /**
     * Get the package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array
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
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
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
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function setUpDatabase($app)
    {
        include_once __DIR__.'/../database/migrations/2021_01_03_000002_create_ipbans_table.php';
        include_once __DIR__.'/../database/migrations/2021_01_03_000003_add_banned_columns.php';
        
        (new \CreateIpbansTable())->up();
        (new \AddBannedColumns())->up();
    }
}
