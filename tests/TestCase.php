<?php

namespace Smpita\ConfigAs\Tests;

use Illuminate\Support\Facades\Config;
use Orchestra\Testbench\TestCase as Orchestra;
use Smpita\ConfigAs\ConfigAs;
use Smpita\ConfigAs\Tests\Stubs\ClassStub;

class TestCase extends Orchestra
{
    protected function getPackageProviders($app)
    {
        return [];
    }

    public function getEnvironmentSetUp($app)
    {
        ConfigAs::flush();
        Config::set('database.default', 'testing');
        Config::set('testing', [
            'array' => ['foo'],
            'bool' => true,
            'class' => new ClassStub(),
            'float' => 123.456,
            'int' => 123,
            'nullable' => null,
            'string' => 'foo',
        ]);
    }
}
