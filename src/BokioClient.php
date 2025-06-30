<?php

namespace Mattitja\BokioApiLaravel;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class BokioClient
{
    public PendingRequest $request;

    public function __construct(
        private string $accessToken,
        private string $companyId,
        private string $baseUrl = 'https://api.bokio.se'
    ) {
        $this->request = Http::acceptJson()
            ->asJson()
            ->withToken($this->accessToken)
            ->baseUrl("{$this->baseUrl}/companies/{$this->companyId}");
    }

    public function get(string $endpoint, array $query = []): object
    {
        return $this->request
            ->get($endpoint, $query)
            ->throw()
            ->object();
    }

    public function post(string $endpoint, array $data = []): object
    {
        return $this->request
            ->post($endpoint, $data)
            ->throw()
            ->object();
    }

    public function put(string $endpoint, array $data = []): object
    {
        return $this->request
            ->put($endpoint, $data)
            ->throw()
            ->object();
    }

    public function delete(string $endpoint): bool
    {
        return $this->request
            ->delete($endpoint)
            ->throw()
            ->ok();
    }

    public function contents(string $endpoint, array $query = []): string
    {
        return $this->request
            ->get($endpoint, $query)
            ->throw()
            ->body();
    }
}
