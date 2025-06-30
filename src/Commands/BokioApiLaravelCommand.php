<?php

namespace Mattitja\BokioApiLaravel\Commands;

use Illuminate\Console\Command;

class BokioApiLaravelCommand extends Command
{
    public $signature = 'bokio-api-laravel';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
