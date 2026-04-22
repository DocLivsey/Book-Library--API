<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // Set to false in production
        'db' => [
            'host' => 'localhost',
            'dbname' => 'book_library',
            'user' => 'root',
            'pass' => '',
        ],
        'redis' => [
            'host' => 'localhost',
            'port' => 6379,
        ],
    ],
];