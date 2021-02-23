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

    'twitter' => [
        'screen_name' => env('TWITTER_SCREEN_NAME'),
        'consumer' => [
            'key' => env('TWITTER_CONSUMER_KEY'),
            'secret' => env('TWITTER_CONSUMER_SECRET')
        ],
        'access' => [
            'token' => env('TWITTER_ACCESS_TOKEN'),
            'secret' => env('TWITTER_ACCESS_SECRET')
        ]
    ],

    'discord' => [
        'api_url' => env('DISCORD_API_URL', 'https://discord.com/api'),
        'client_id' => env('DISCORD_CLIENT_ID'),
        'client_secret' => env('DISCORD_CLIENT_SECRET'),
        'redirect_url' => env('DISCORD_REDIRECT_URL'),
        'guild_id' => env('DISCORD_GUILD_ID'),
        'notify_channel_id' => env('DISCORD_NOTIFY_CHANNEL_ID'),
        'bot_token' => env('DISCORD_BOT_TOKEN'),
        'cache_expire' => 30,
        'invite_code' => env('DISCORD_INVITE_CODE'),
        'cdn_base_url' => env('DISCORD_CDN_BASE_URL', 'https://cdn.discordapp.com/'),
    ],

    'twitch' => [
        'api_url' => env('TWITCH_API_URL', 'https://api.twitch.tv/helix'),
        'identify_url' => env('TWITCH_IDENTIFY_URL', 'https://id.twitch.tv'),
        'client_id' => env('TWITCH_CLIENT_ID'),
        'client_secret' => env('TWITCH_CLIENT_SECRET'),
        'redirect_url' => env('TWITCH_REDIRECT_URL'),
        'cache_expire' => 30,
    ],

    'oengus' => [
        'api_url' => env('OENGUS_API_URL'),
        'cache_expire' => 60
    ],

];
