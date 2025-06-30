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

        if ($request->method() === 'POST' && str_contains($request->url(), '/customers')) {
            return Http::response(loadFixture('Customer/create.201.json'), 201);
        }

        // fallback
        return Http::response([], 404);
    });

    $this->client = new BokioClient('fake-token', '123456');
    $this->customers = new Customer($this->client);
});

it('can fetch a list of customers from Bokio', function () {
    $response = $this->customers->all();

    expect($response->items[0]->name)->toBe('customer 1');
});

it('can fetch a single customer from Bokio', function () {
    $customerId = '55c899c5-82b2-47fa-9c51-e35fc9b26443';
    $response = $this->customers->get($customerId);

    expect($response->id)->toBe($customerId);
    expect($response->name)->toBe('customer 1');
});

it('can create a customer via Bokio API', function () {
    $data = [
        'name' => 'Testbolaget AB',
        'type' => 'company',
        'vatNumber' => 'SE1234567890',
        'orgNumber' => '556677-8899',
        'paymentTerms' => '30',
        'language' => 'sv',
        'contactsDetails' => [
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'phone' => '0123456789',
                'isDefault' => true,
            ],
        ],
        'address' => [
            'line1' => 'Testgatan 1',
            'line2' => null,
            'city' => 'Göteborg',
            'postalCode' => '12345',
            'country' => 'SE',
        ],
    ];

    $response = $this->customers->create($data);

    expect($response->id)->toBe('generated-id');
    expect($response->name)->toBe('Testbolaget AB');

    Http::assertSent(function ($request) use ($data) {
        return $request->method() === 'POST' &&
            str_contains($request->url(), '/customers') &&
            $request['name'] === $data['name'];
    });
});
