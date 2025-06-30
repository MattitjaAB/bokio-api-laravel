<?php

namespace Mattitja\BokioApiLaravel\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Mattitja\BokioApiLaravel\Bokio
 */
class Bokio extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \Mattitja\BokioApiLaravel\Bokio::class;
    }
}
