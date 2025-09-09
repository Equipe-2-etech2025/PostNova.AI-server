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

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'gemini' => [
        'api_key' => env('GEMINI_API_KEY'),
        'api_url' => env('GEMINI_API_URL'),
    ],

    'huggingface' => [
        'api_key' => env('HUGGINGFACE_API_KEY'),
    ],

    'mvola' => [
        'auth_url' => env('MVOLA_AUTH_URL', 'https://developer.mvola.mg'),
        'base_url' => env('MVOLA_BASE_URL', 'https://devapi.mvola.mg'),
        'partner_name' => env('MVOLA_PARTNER_NAME', 'PostNova.AI'),
        'partner_msisdn' => env('MVOLA_PARTNER_MSISDN'),
        'client_id' => env('MVOLA_CLIENT_ID'),
        'client_secret' => env('MVOLA_CLIENT_SECRET'),
        'scope' => env('MVOLA_SCOPE', 'EXT_INT_MVOLA_SCOPE'),
    ],

    'cloudinary' => [
        'cloud_name' => env('CLOUDINARY_CLOUD_NAME'),
        'api_key' => env('CLOUDINARY_API_KEY'),
        'api_secret' => env('CLOUDINARY_API_SECRET'),
        'url' => env('CLOUDINARY_URL'),
    ],

];
