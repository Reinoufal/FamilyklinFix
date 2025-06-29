<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Filament Path
    |--------------------------------------------------------------------------
    |
    | The path where Filament will be accessible from. Feel free to change this
    | to anything you like.
    |
    */

    'path' => 'admin',

    /*
    |--------------------------------------------------------------------------
    | Other Filament Configuration Options
    |--------------------------------------------------------------------------
    */
    'auth' => [
        'guard' => 'web',
    ],

    'middleware' => [
        'auth' => [
            'verify' => true,
        ],
    ],

    'pages' => [
        'namespace' => 'App\\Filament\\Pages',
    ],

    'resources' => [
        'namespace' => 'App\\Filament\\Resources',
    ],

    'widgets' => [
        'namespace' => 'App\\Filament\\Widgets',
    ],
];