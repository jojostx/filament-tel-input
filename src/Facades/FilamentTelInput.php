<?php

namespace Jojostx\FilamentTelInput\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Jojostx\FilamentTelInput\FilamentTelInput
 */
class FilamentTelInput extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'filament-tel-input';
    }
}
