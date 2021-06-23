<?php

namespace Delta935142\Mitake\Providers;

use Illuminate\Support\ServiceProvider;

class MitakeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        /*$this->app->singleton('mitake', function ($app) {
            return new Newsletter();
        });*/
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
