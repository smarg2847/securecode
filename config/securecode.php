<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Secure Code valid characters
    |--------------------------------------------------------------------------
    |
    */

    'valid_characters' => env('VALID_CHARACTERS', '0123456789'),
    /*
    |--------------------------------------------------------------------------
    | Secure Code Rules limits
    |--------------------------------------------------------------------------
    |
    */
    'secure_code_length' => env('SECURE_CODE_LENGTH', 6),
    'character_repeat_limit' => env('CHARACTER_REPEAT_LIMIT', 3),
    'sequence_limit' => env('SEQUENCE_LIMIT', 3),
    'minimum_unique_characters'  => env('MINIMUM_UNIQUE_CHARACTERS', 3),
];
