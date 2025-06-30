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
    public function all(?int $page = null, ?int $pageSize = null): object
    {
        $query = [];

        if ($page !== null) {
            $query['page'] = $page;
        }

        if ($pageSize !== null) {
            $query['pageSize'] = $pageSize;
        }

        return $this->client->get('customers', $query);
    }

    public function get(string $customerId): object
    {
        return $this->client->get('customers/'.$customerId);
    }
}
