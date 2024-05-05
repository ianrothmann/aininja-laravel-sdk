<?php

namespace IanRothmann\AINinja\Commands;

use Illuminate\Console\Command;

class AINinjaCommand extends Command
{
    public $signature = 'aininja-laravel-sdk';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
