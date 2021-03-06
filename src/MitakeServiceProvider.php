<?php

namespace Delta935142\Mitake;

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
        $this->app->singleton('newsletter', function ($app) {
            return new Newsletter($app);
        });

        $this->mergeConfigFrom(
            __DIR__.'/../config/mitake.php',
            'mitake'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishing();
    }

    protected function publishing()
    {
        if (! function_exists('config_path')) {
            return;
        }

        $this->publishes([
            __DIR__.'/../config/mitake.php' => config_path('mitake.php'),
        ], 'config');
    }
}
