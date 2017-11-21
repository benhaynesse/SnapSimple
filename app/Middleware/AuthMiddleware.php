<?php


namespace App\Middleware;

use \App\Tokens\Token;

class AuthMiddleware extends BaseMiddleware{

    public function __invoke($request, $response, $next){        
        
        //Check is user is not signed in
        if(!$this->container->auth->check()){
            $this->container->flash->addMessage('danger', 'You do not have access! Go sign in');
            return $response->withRedirect($this->container->router->pathFor('auth.signin'));
        }      
       
        
        $response = $next($request, $response);
        return $response;
    }

}