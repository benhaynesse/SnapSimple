<?php

//Set up where images are uploaded 
$container['upload_directory'] = __DIR__ . '/../public/uploads';

//Set up access to Illuminate
$container['db'] = function($container) use ($capsule){
    return $capsule;
};

$container['auth'] = function($container){
    return new \App\Models\Auth\AuthModel;
};

$container['flash'] = function($container){
    return new \Slim\Flash\Messages;
};


//Set up the validation for the inputs. Lets us use Respect Validation
$container['validator'] = function($container){
    return new \App\Validation\Validator;
};

$container['csrf'] = function(){
    return new \Slim\Csrf\Guard;
};