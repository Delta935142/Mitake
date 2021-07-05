<?php

namespace Delta935142\Mitake\Tests;

use Illuminate\Foundation\Application;
use Delta935142\Mitake\MitakeServiceProvider;
use Orchestra\Testbench\TestCase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

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