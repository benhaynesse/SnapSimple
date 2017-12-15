<?php

namespace App\Validation\Exceptions;

use Respect\Validation\Exceptions\ValidationException;

class CheckGenderException extends ValidationException{

    public static $defaultTemplates = [
        self::MODE_DEFAULT => [
            self::STANDARD => 'Hmm, something went wrong',
        ],
    ];

}