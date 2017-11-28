<?php


//First Route
$app->get('/', 'HomeController:index')->setName('home');


//Sign In Route
$app->get('/auth/signin', 'AuthenticationController:getSignIn')->setName('auth.signin');

//Register Routes
$app->get('/auth/register', 'AuthenticationController:getRegisterUser')->setName('auth.register');
$app->post('/auth/register', 'AuthenticationController:postRegisterUser');

//Logout Route
$app->get('/auth/logout', 'AuthenticationController:logout')->setName('auth.logout');




