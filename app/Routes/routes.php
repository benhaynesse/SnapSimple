<?php

//Test Route used for debugging templates
$app->get('/test', function($request, $response){
    return $this->view->render($response, 'post/components/imagepreview.twig');
});

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
    
    //Add Post Form
    $this->get('/post/add', 'PostController:getAddPost')->setName('post.add');
    $this->post('/post/add', 'PostController:postAddPost');


})->add(new \App\Middleware\AuthMiddleware($container));




