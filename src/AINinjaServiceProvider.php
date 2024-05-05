<?php

namespace IanRothmann\AINinja;

use IanRothmann\AINinja\Commands\AINinjaCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

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
