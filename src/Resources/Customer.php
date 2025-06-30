<?php

namespace Mattitja\BokioApiLaravel\Resources;

use Mattitja\BokioApiLaravel\BokioClient;

class Customer
{
    public function __construct(
        protected BokioClient $client
    ) {}

    /**
     * Get a list of all customers.
     */
    public function all(int $page = 1, int $pageSize = 25): object
    {
        return $this->client->get('customers', [
            'page' => $page,
            'pageSize' => $pageSize,
        ]);
    }

    public function get(string $customerId): object
    {
        return $this->client->get('customers/'.$customerId);
    }
}
