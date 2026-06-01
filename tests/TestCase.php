<?php

namespace PersonaGenerator\Tests;

use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase as Orchestra;
use PersonaGenerator\PersonaGeneratorServiceProvider;

abstract class TestCase extends Orchestra
{
    /**
     * @param  Application  $app
     * @return array<int, class-string>
     */
    protected function getPackageProviders($app): array
    {
        return [
            PersonaGeneratorServiceProvider::class,
        ];
    }
}
