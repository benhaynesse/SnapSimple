<?php

//Route Grop For Unauthenticated Users Only
$app->group('', function () {    
    
    //Sign In Route
    $this->get('/auth/signin', 'AuthenticationController:getSignIn')->setName('auth.signin');

    //Register Routes
    $this->get('/auth/register', 'AuthenticationController:getRegisterUser')->setName('auth.register');
    $this->post('/auth/register', 'AuthenticationController:postRegisterUser');

})->add(new \App\Middleware\GuestMiddleware($container));