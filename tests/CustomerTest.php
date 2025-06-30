<?php

use Illuminate\Support\Facades\Http;
use Mattitja\BokioApiLaravel\BokioClient;
use Mattitja\BokioApiLaravel\Resources\Customer;

function loadFixture(string $path): array
{
    $json = file_get_contents(__DIR__."/Responses/{$path}");

    return json_decode($json, true);
}

beforeEach(function () {
    Http::fake(function ($request) {
        if ($request->method() === 'GET' && preg_match('#/customers/\w+#', $request->url())) {
            return Http::response(loadFixture('Customer/get.200.json'), 200);
        }

        if ($request->method() === 'GET' && str_contains($request->url(), '/customers')) {
            return Http::response(loadFixture('Customer/all.200.json'), 200);
        }

        // fallback
        return Http::response([], 404);
    });

    $this->client = new BokioClient('fake-token', '123456');
});

it('can fetch a list of customers from Bokio', function () {
    $response = (new Customer($this->client))->all();

    expect($response->items)->toHaveCount(1);
    expect($response->items[0]->name)->toBe('customer 1');
});

it('can fetch a single customer from Bokio', function () {
    $customerId = '55c899c5-82b2-47fa-9c51-e35fc9b26443';
    $response = (new Customer($this->client))->get($customerId);

    expect($response->id)->toBe($customerId);
    expect($response->name)->toBe('customer 1');
});
