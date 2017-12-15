<?php


//Set Up Our Controllers

$container['TestController'] = function($container){
    return new \App\Controllers\Test($container);
};

$container['HomeController'] = function($container){
    return new \App\Controllers\HomeController($container);
};

$container['PostController'] = function($container){
    return new \App\Controllers\Post\PostController($container);
};

$container['AuthenticationController'] = function($container){
    return new \App\Controllers\Auth\AuthenticationController($container);
};

$container['UserController'] = function($container){
    return new \App\Controllers\User\UserController($container);
};