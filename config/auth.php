<?php

return [

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    // 👇 Définition des guards pour chaque type d'utilisateur
    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],

        'gerant' => [
            'driver' => 'session',
            'provider' => 'gerants',
        ],

        'client' => [
            'driver' => 'session',
            'provider' => 'clients',
        ],

        'agent' => [
            'driver' => 'session',
            'provider' => 'agents',
        ],
    ],

    // 👇 Définition des providers pour chaque modèle
    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', App\Models\User::class),
        ],

        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Administrateur::class,
        ],

        'gerants' => [
            'driver' => 'eloquent',
            'model' => App\Models\Gerant::class,
        ],

        'clients' => [
            'driver' => 'eloquent',
            'model' => App\Models\Client::class,
        ],

        'agents' => [
            'driver' => 'eloquent',
            'model' => App\Models\Agent::class,
        ],
    ],

    // 👇 Si tu veux permettre la réinitialisation de mot de passe par type d'utilisateur
    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],

        'admins' => [
            'provider' => 'admins',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'gerants' => [
            'provider' => 'gerants',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'clients' => [
            'provider' => 'clients',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),
];
