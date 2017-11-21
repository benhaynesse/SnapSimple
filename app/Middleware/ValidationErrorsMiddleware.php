<?php


namespace App\Middleware;

class ValidationErrorsMiddleware extends BaseMiddleware{

    public function __invoke($request, $response, $next){
        
        $errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : null;
        $this->container->view->getEnvironment()->addGlobal('errors', $errors);
        unset($_SESSION['errors']);
        
        $response = $next($request, $response);
        return $response;
    }

}