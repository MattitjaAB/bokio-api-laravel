<?php

use Illuminate\Validation\ValidationException;
use Mattitja\BokioApiLaravel\Validation\CustomerValidator;

it('validates minimal required customer data', function () {
    $data = [
        'name' => 'Test AB',
        'type' => 'company',
        'address' => [
            'line1' => 'Gata 1',
            'city' => 'Ort',
            'postalCode' => '12345',
            'country' => 'SE',
        ],
    ];

    $validated = CustomerValidator::validate($data);

    expect($validated['name'])->toBe('Test AB');
});

it('throws exception when required fields are missing', function () {
    $this->expectException(ValidationException::class);

    CustomerValidator::validate([]);
});
