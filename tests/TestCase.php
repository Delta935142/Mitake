<?php

namespace Delta935142\Mitake\Tests;

use Illuminate\Foundation\Application;
use Delta935142\Mitake\Providers\MitakeServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    /**
     * @param  Application  $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            MitakeServiceProvider::class,
        ];
    }
}