<?php

namespace App\Validation\Rules;


use Respect\Validation\Rules\AbstractRule;

class ValidUsername extends AbstractRule{

    public function validate($input){    
        //Check DB to see if valid username
        //Checks length 3 - 15 characters {{{3,15}}}
        //Allows letters number under-score, dash and full stop {{[a-z0-9_-.]}}
        //Case in-sensitive  {{i}}
        return preg_match('/^[a-z0-9_.-]{3,15}$/i', $input);
    }

}