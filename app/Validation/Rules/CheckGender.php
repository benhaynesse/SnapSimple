<?php

namespace App\Validation\Rules;


use Respect\Validation\Rules\AbstractRule;

class CheckGender extends AbstractRule{

    public function validate($input){    
                 
        return strcmp($input, 'Male') || strcmp($input,'Female');
    }

}