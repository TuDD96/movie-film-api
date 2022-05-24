<?php

declare(strict_types=1);

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
        'region' => env('SES_REGION', 'us-east-1'),
    ],

    'facebook' => [
        'client_id' => env('FACEBOOK_ID'),
        'client_secret' => env('FACEBOOK_SECRET'),
        'redirect' => env('FACEBOOK_URL'),
    ],
    'google' => [
        'client_id' => env('GOOGLE_ID'),
        'client_secret' => env('GOOGLE_SECRET'),
        'redirect' => env('GOOGLE_URL'),
    ],
    'twitter' => [
        'client_id' => env('TWITTER_ID'),
        'client_secret' => env('TWITTER_SECRET'),
        'redirect' => env('TWITTER_URL'),
    ],
    'line' => [
        'client_id' => env('LINE_ID'),
        'client_secret' => env('LINE_SECRET'),
        'redirect' => env('LINE_URL'),
    ],
    'apple' => [
        'app_links' => [
            'app_id' => [
                'TS9RGKKRC4.jp.co.comiceria.staging',
                'TS9RGKKRC4.jp.co.comiceria.production',
            ]
        ]
    ]
];
