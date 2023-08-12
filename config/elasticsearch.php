<?php

return [
    'hosts' => [
        'elasticsearch:9200',
    ],

    'prefix_index' => 'mysql-server.fullcycle.',

    'authentication' => [
        'username' => env('ELASTICSEARCH_USERNAME', ''),
        'password' => env('ELASTICSEARCH_PASSWORD', ''),
    ]
];
