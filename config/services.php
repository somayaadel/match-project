<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
     */
    'facebook' => [
        'client_id' => '786220085309385', //Facebook API
        'client_secret' => '1dc8bc6ea55fac3a2fb857c6f1f78456', //Facebook Secret
        'redirect' => 'https://matching.reaya.xyz/callback',
    ],
    'google' => [
        'client_id' => 'http://872179673510-63d6ta56a8fvf3dcdj9r47rscepi4iba.apps.googleusercontent.com',
        'client_secret' => 'uTrkDorFgCVp1hJJ0yRTNKzr',
        'redirect' => 'https://matching.reaya.xyz/google/callback',
    ],

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

];
