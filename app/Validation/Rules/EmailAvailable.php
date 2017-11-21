<?php

namespace App\Validation\Rules;

use App\DBOs\User;
use Respect\Validation\Rules\AbstractRule;

class EmailAvailable extends AbstractRule{

    public function validate($input){    
        //Check DB to see if email address already exists.    
        return User::where('email', $input)->count() === 0;
    }

}