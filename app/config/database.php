<?php
return [
    'default' => env('DB_CONNECTION', 'sqlite'),

    'migrations' => 'migrations',

    'connections' => [

        'testing' => [
            'driver' => 'sqlite',
            'database' => ':memory:',
        ],

        'sqlite' => [
            'driver'    => 'sqlite',
            'database'  => env('DB_DATABASE', '/Users/Inkovskiy/Sites/Page Analyzer/database/database.sqlite'),
            'prefix'   => env('DB_PREFIX', '')
        ],

    ],
];
