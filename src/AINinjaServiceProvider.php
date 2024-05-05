<?php

namespace IanRothmann\AINinja;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use IanRothmann\AINinja\Commands\AINinjaCommand;

class AINinjaServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('aininja-laravel-sdk')
            ->hasConfigFile('aininja')
            ->hasCommand(AINinjaCommand::class);
    }
}
