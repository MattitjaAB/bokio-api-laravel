<?php

namespace Mattitja\BokioApiLaravel;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class BokioServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        $package
            ->name('bokio-api-laravel')
            ->hasConfigFile();
    }

    public function register(): void
    {
        parent::register();

        $this->app->singleton(BokioClient::class, function () {
            return new BokioClient(
                config('bokio.token'),
                config('bokio.company_id'),
                config('bokio.base_url', 'https://api.bokio.se'),
            );
        });
    }
}
