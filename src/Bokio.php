<?php

namespace Mattitja\BokioApiLaravel;

use Mattitja\BokioApiLaravel\Resources\Customer;

class Bokio
{
    public function __construct(protected BokioClient $client) {}

    public function customers(): Customer
    {
        return new Customer($this->client);
    }
}
