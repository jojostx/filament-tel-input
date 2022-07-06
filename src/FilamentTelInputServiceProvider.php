<?php

namespace Jojostx\FilamentTelInput;

use Filament\PluginServiceProvider;

class FilamentTelInputServiceProvider extends PluginServiceProvider
{
    public static string $name = 'filament-tel-input';

    /**
     * @var string[]
     */
    protected array $beforeCoreScripts = [
        'filament-tel-input' => __DIR__ . '/../dist/js/filament-tel-input.js',
    ];

    /**
     * @var string[]
     */
    protected array $styles = [
        'filament-tel-input' => __DIR__ . '/../dist/css/filament-tel-input.css',
    ];

    public function boot()
    {
        $this->bootLoaders();
        $this->bootPublishing();
    }

    protected function bootPublishing()
    {
        if (! $this->app->runningInConsole()) {
            return;
        }

        $this->publishes([
            __DIR__ . '/../dist/images/vendor/intl-tel-input/flags.png' => public_path('filament/assets/images/vendor/filament-tel-input/flags.png'),
        ], 'filament-tel-input-flags');

        $this->publishes([
            __DIR__ . '/../dist/images/vendor/intl-tel-input/flags@2x.png' => public_path('filament/assets/images/vendor/filament-tel-input/flags@2x.png'),
        ], 'filament-tel-input-flags');
    }

    protected function bootLoaders()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'filament-jsoneditor');
    }
}
