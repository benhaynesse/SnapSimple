<?php

namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class FacebookIdAvailableException extends ValidationException{

    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Already Registered',
        ],
    ];

}