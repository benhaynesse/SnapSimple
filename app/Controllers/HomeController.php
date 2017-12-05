<?php



namespace App\Controllers;

use App\DBOs\Post;
use App\DBOs\User;

class HomeController extends BaseController{

    public function index($request, $response){

        $page      = ($request->getParam('page', 0) > 0) ? $request->getParam('page') : 1;
        $limit     = 8; // Number of posts on one page
        $skip      = ($page - 1) * $limit;
        $count     = Post::get()->count(); // Count of all available posts        

        $posts = Post::skip($skip)->take($limit)->get();        
                 
        $response = $this->view->render($response, 'home.twig', [
            'posts' => $posts,
            'pagination'    => [
                'needed'        => $count > $limit,
                'count'         => $count,
                'page'          => $page,
                'lastpage'      => (ceil($count / $limit) == 0 ? 1 : ceil($count / $limit)),
                'limit'         => $limit,
            ],
        ]);

        return $response;

    }

}