<?php


namespace App\Middleware;

class OldInputMiddleware extends BaseMiddleware{

    public function __invoke($request, $response, $next){        
        
        $old = isset($_SESSION['old']) ? $_SESSION['old'] : null;
        $this->container->view->getEnvironment()->addGlobal('old', $old);
        $_SESSION['old'] = $request->getParams();

        $response = $next($request, $response);
        return $response;
    }

}