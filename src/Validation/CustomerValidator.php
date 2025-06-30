<?php

namespace Mattitja\BokioApiLaravel\Validation;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class CustomerValidator
{
    public static function validate(array $data): array
    {
        $validator = Validator::make($data, [
            'name' => 'required|string',
            'type' => 'required|string',
            'vatNumber' => 'nullable|string',
            'orgNumber' => 'nullable|string',
            'paymentTerms' => 'nullable|string',
            'language' => 'nullable|string|in:sv,en',
            'contactsDetails' => 'nullable|array',
            'contactsDetails.*.name' => 'required_with:contactsDetails|string',
            'contactsDetails.*.email' => 'nullable|email',
            'contactsDetails.*.phone' => 'nullable|string',
            'contactsDetails.*.isDefault' => 'boolean',
            'address' => 'required|array',
            'address.line1' => 'required|string',
            'address.line2' => 'nullable|string',
            'address.city' => 'required|string',
            'address.postalCode' => 'required|string',
            'address.country' => 'required|string|size:2',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
        }

        return $validator->validated();
    }
}
