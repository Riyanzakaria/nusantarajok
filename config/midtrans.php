<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Midtrans Payment Gateway Configuration
    |--------------------------------------------------------------------------
    | Midtrans is the payment gateway used for this application.
    | Register at https://dashboard.midtrans.com to get your API keys.
    | For sandbox testing, use the sandbox credentials below.
    */

    'server_key'  => env('MIDTRANS_SERVER_KEY', ''),
    'client_key'  => env('MIDTRANS_CLIENT_KEY', ''),
    'environment' => env('MIDTRANS_ENVIRONMENT', 'sandbox'), // 'sandbox' or 'production'
    'snap_url'    => env('MIDTRANS_ENVIRONMENT', 'sandbox') === 'production'
        ? 'https://app.midtrans.com/snap/snap.js'
        : 'https://app.sandbox.midtrans.com/snap/snap.js',
    'api_url'     => env('MIDTRANS_ENVIRONMENT', 'sandbox') === 'production'
        ? 'https://api.midtrans.com'
        : 'https://api.sandbox.midtrans.com',
];
