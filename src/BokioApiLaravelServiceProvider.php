<?php

namespace Mattitja\BokioApiLaravel;

use Mattitja\BokioApiLaravel\Commands\BokioApiLaravelCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class BokioApiLaravelServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('bokio-api-laravel')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_bokio_api_laravel_table')
            ->hasCommand(BokioApiLaravelCommand::class);
    }
}
