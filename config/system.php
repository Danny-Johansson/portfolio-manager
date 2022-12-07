<?php

return [
    'first_name' => env('FIRST_NAME', 'John'),
    'last_name' => env('LAST_NAME', 'Doe'),
    'follow_up_spacing' => env('FOLLOW_UP_SPACING', 5),
    'follow_up_times' => env('FOLLOW_UP_SPACING', 3),
    'demo_mode' => env('DEMO_MODE',false),
    'email' => env('DEFAULT_EMAIL','demo@demo.demo'),
    'phone' => env('DEFAULT_PHONE','12345678'),
    'banned_phrases' => [
        'www',
        'http',
        'https',
        "script",
        "<",
        ">",
        "[",
        "]",
        "drop table",
        ";",
        "|",
    ],
];
