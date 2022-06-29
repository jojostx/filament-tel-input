<?php

namespace Jojostx\FilamentTelInput\Commands;

use Illuminate\Console\Command;

class FilamentTelInputCommand extends Command
{
    public $signature = 'filament-tel-input';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
