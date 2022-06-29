<?php

namespace Jojostx\FilamentTelInput;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Jojostx\FilamentTelInput\Commands\FilamentTelInputCommand;

class FilamentTelInputServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('filament-tel-input')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_filament-tel-input_table')
            ->hasCommand(FilamentTelInputCommand::class);
    }
}
