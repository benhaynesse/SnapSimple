<?php


//First Route
$app->get('/', 'HomeController:index')->setName('home');


//Route Grop For Unauthenticated Users Only
$app->group('', function () {    
    
    //Sign In Route
    $this->get('/auth/signin', 'AuthenticationController:getSignIn')->setName('auth.signin');

    //Register Routes
    $this->get('/auth/register', 'AuthenticationController:getRegisterUser')->setName('auth.register');
    $this->post('/auth/register', 'AuthenticationController:postRegisterUser');

})->add(new \App\Middleware\GuestMiddleware($container));


//Route Groups For Authenticated Users Only
$app->group('', function () {

    $this->get('/auth/logout', 'AuthenticationController:logout')->setName('auth.logout');


})->add(new \App\Middleware\AuthMiddleware($container));




