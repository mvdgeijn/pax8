<?php

return [
    'url' => [
        'login' => 'https://login.pax8.com',
        'api'   => 'https://api.pax8.com'
    ],

    'client' => [
        'id' => env('PAX8_CLIENT_ID'),
        'secret' => env('PAX8_CLIENT_SECRET')
    ]
];
