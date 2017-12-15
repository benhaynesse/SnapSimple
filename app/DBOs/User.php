<?php

namespace App\DBOs;

use Illuminate\Database\Eloquent\Model;

class User extends Model{

    // Required If Class Name is not the same as table name
    protected $table = "users";

    //Needed for put and post requests. Otherwise Illuminate will reject
    protected $fillable = [
        'name',
        'email',    
        'gender',    
        'age',
        'facebook_id'
    ];

    

}