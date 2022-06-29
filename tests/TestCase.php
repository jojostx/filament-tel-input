<?php

namespace Jojostx\FilamentTelInput\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Jojostx\FilamentTelInput\FilamentTelInputServiceProvider;
use Orchestra\Testbench\TestCase as Orchestra;

class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        Factory::guessFactoryNamesUsing(
            fn (string $modelName) => 'Jojostx\\FilamentTelInput\\Database\\Factories\\'.class_basename($modelName).'Factory'
        );
    }

    protected function getPackageProviders($app)
    {
        return [
            FilamentTelInputServiceProvider::class,
        ];
    }

    public function getEnvironmentSetUp($app)
    {
        config()->set('database.default', 'testing');

        /*
        $migration = include __DIR__.'/../database/migrations/create_filament-tel-input_table.php.stub';
        $migration->up();
        */
    }
}
