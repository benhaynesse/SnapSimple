<?php

namespace App\DBOs;

use Illuminate\Database\Eloquent\Model;

class Post extends Model{

    // Required If Class Name is not the same as table name
    protected $table = "posts";

    //Needed for put and post requests. Otherwise Illuminate will reject
    protected $fillable = [
        'headline',
        'user_id',        
        'image_url',
        'looking_for',
        'commenters',
        'latitude',
        'longitude',
    ];

    

}