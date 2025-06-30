# Bokio API Wrapper for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/mattitjaab/bokio-api-laravel.svg?style=flat-square)](https://packagist.org/packages/mattitjaab/bokio-api-laravel)
[![Tests](https://img.shields.io/github/actions/workflow/status/mattitjaab/bokio-api-laravel/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/mattitjaab/bokio-api-laravel/actions?query=workflow%3Arun-tests+branch%3Amain)
[![Code Style](https://img.shields.io/github/actions/workflow/status/mattitjaab/bokio-api-laravel/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/mattitjaab/bokio-api-laravel/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/mattitjaab/bokio-api-laravel.svg?style=flat-square)](https://packagist.org/packages/mattitjaab/bokio-api-laravel)

A simple and elegant Laravel wrapper for the [Bokio API](https://bokio.se). This package allows you to interact with Bokio programmatically using clean, Laravel-friendly syntax.

## Features

- Handles authentication using integration token and company ID
- Easily fetch customers, create invoices, and more
- Extensible and testable design using Laravel's HTTP client

## Installation

Install the package via Composer:

```bash
composer require mattitjaab/bokio-api-laravel
```

Publish the configuration file:

```bash
php artisan vendor:publish --tag="bokio-api-laravel-config"
```

This will create a `config/bokio.php` file where you can define:

```php
return [
    'token' => env('BOKIO_TOKEN'),
    'company_id' => env('BOKIO_COMPANY_ID'),
];
```

Make sure to set your `.env` file accordingly:

```dotenv
BOKIO_TOKEN=your-token-here
BOKIO_COMPANY_ID=your-company-id
```

## Usage

You can resolve the Bokio client using the service container:

```php
$bokio = app(\Mattitja\BokioApiLaravel\Bokio::class);

// Fetch all customers
$customers = $bokio->customers()->all();

// Create a customer
$bokio->customers()->create([
    'name' => 'New Company AB',
    'type' => 'company',
    'address' => [
        'line1' => 'Main Street 1',
        'city' => 'Stockholm',
        'postalCode' => '11122',
        'country' => 'SE',
    ],
]);
```

## Testing

Run the test suite with:

```bash
composer test
```

## Contributing

Contributions are welcome! Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover a security vulnerability, please follow [our security policy](../../security/policy).

## License

This package is open-sourced software licensed under the [MIT license](LICENSE.md).
