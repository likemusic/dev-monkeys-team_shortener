<?php

return [
    'code' => [
//        'chars' => env('SHORTENER_CODE_CHARS', '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ'),
        'chars' => env('SHORTENER_CODE_CHARS', 'яфй'),
        'min_length' => env('SHORTENER_CODE_MIN_LENGTH', 6),
    ]
];
