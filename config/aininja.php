<?php

// config for IanRothmann/AINinja
return [
    'url' => env('AININJA_URL', 'https://api2.aininja.dev'),
    'token' => env('AININJA_TOKEN'),
    'should_cache' => env('AININJA_SHOULD_CACHE', false),
    'should_mock' => env('AININJA_SHOULD_MOCK', false),
    'cache_minutes' => env('AININJA_CACHE_MINUTES', 60),
    'verify_ssl' => env('AININJA_VERIFY_SSL', true),
    'timeout' => env('AININJA_TIMEOUT', 600),
];
