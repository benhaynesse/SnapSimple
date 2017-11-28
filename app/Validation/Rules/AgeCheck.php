<?php

namespace App\Validation\Rules;


use Respect\Validation\Rules\AbstractRule;

class AgeCheck extends AbstractRule{

    public function validate($input){    
        //Check DB to see if email address already exists.    
        return $input > 18 && $input < 100;
    }

}