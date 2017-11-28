<?php

namespace App\Validation\Rules;

use App\DBOs\User;
use Respect\Validation\Rules\AbstractRule;

class FacebookIdAvailable extends AbstractRule{

    public function validate($input){    
        //Check DB to see if email address already exists.    
        return User::where('facebook_id', $input)->count() === 0;
    }

}