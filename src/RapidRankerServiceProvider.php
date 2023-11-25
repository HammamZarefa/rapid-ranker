<?php

namespace HammamZarefa\RapidRanker;

use Illuminate\Support\ServiceProvider;

class RapidRankerServiceProvider extends ServiceProvider
{
    public function register()
    {


    }

    public function boot()
    {
        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations')
        ], 'migrations');

        // Routes
        $this->loadRoutesFrom(__DIR__ . '/Routes/routes.php');
    }
}