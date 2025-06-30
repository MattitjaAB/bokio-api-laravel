<?php

namespace Mattitja\BokioApiLaravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Mattitja\BokioApiLaravel\BokioApiLaravel
 */
class BokioApiLaravel extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Mattitja\BokioApiLaravel\BokioApiLaravel::class;
    }
}
