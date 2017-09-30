<?php

return [
    'default' => env('DB_DEFAULT', 'sqlite'),

    'connections' => [

        'sqlite_testing' => [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ],

        'sqlite' => [
            'driver'    => 'sqlite',
            'database'  => env('DB_DATABASE', '/Users/Inkovskiy/Sites/Page Analyzer/database/database.sqlite'),
            'prefix'    => ''
        ],

    ],
];
