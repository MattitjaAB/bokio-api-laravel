<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Bokio API Access Token
    |--------------------------------------------------------------------------
    |
    | Your integration token from Bokio. Found in your Bokio account.
    |
    */

    'token' => env('BOKIO_TOKEN'),

    /*
    |--------------------------------------------------------------------------
    | Company ID
    |--------------------------------------------------------------------------
    |
    | You can find this in the Bokio web URL when logged into your company.
    |
    */

    'company_id' => env('BOKIO_COMPANY_ID'),

    /*
    |--------------------------------------------------------------------------
    | Bokio API Base URL
    |--------------------------------------------------------------------------
    |
    | You normally don't need to change this.
    |
    */

    'base_url' => env('BOKIO_BASE_URL', 'https://api.bokio.se'),
];
