<?php

namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class SafeImageException extends ValidationException{

    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Not a safe image',
        ],
    ];

}