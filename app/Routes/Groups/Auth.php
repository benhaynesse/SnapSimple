<?php

//Route Groups For Authenticated Users Only
$app->group('', function () {
    
        $this->get('/auth/logout', 'AuthenticationController:logout')->setName('auth.logout');
        
        //Add Post Form
        $this->get('/post/add', 'PostController:getAddPost')->setName('post.add');
        $this->post('/post/add', 'PostController:postAddPost');
    
        //User Options
        $this->get('/my/account', 'UserController:getMyAccount')->setName('my.account');
    
    
})->add(new \App\Middleware\AuthMiddleware($container));