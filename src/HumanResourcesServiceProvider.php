<?php

namespace Inspirium\HumanResources;

use Illuminate\Support\ServiceProvider;
use Inspirium\HumanResources\Console\ImportEmployees;

class HumanResourcesServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . '/routes/web.php');

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
