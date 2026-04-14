<?php

return [
    'defaults' => [
        'guard' => 'api',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'api' => [
            'driver' => 'jwt',
            'provider' => 'users',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,

    /**
     * JWT Configuration
     */
    'secret' => env('JWT_SECRET', 'secret'),
    'keys' => [
        'public' => env('JWT_PUBLIC_KEY'),
        'private' => env('JWT_PRIVATE_KEY'),
    ],

    'ttl' => env('JWT_TTL', 60), // Token expiration time in minutes
    'refresh_ttl' => env('JWT_REFRESH_TTL', 20160), // Refresh token expiration time in minutes (14 days)
    
    'algorithm' => env('JWT_ALGORITHM', 'HS256'),
    'required_claims' => ['iss', 'iat', 'exp', 'nbf', 'sub', 'jti'],
    'leeway' => env('JWT_LEEWAY', 0),
    'blacklist_enabled' => env('JWT_BLACKLIST_ENABLED', true),
    'blacklist_grace_period' => env('JWT_BLACKLIST_GRACE_PERIOD', 10),
    'show_bearer_in_authorization_header' => true,
    'providers' => [
        'jwt' => Tymon\JwtAuth\Providers\JwtProvider::class,
        'auth' => Tymon\JwtAuth\Providers\AuthProvider::class,
        'storage' => Tymon\JwtAuth\Providers\StorageProvider::class,
    ],
];
