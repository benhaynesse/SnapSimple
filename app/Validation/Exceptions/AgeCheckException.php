<?php

namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class AgeCheckException extends ValidationException{

    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Incorrect Age, You must be over 18',
        ],
    ];

}