<?php


namespace App\Controllers;

use App\DBOs\Post;

class HomeController extends BaseController{

    public function index($request, $response){


        //Fetch Most Popular Users for home page
        $popular = Post::orderBy('score', 'DESC')->take(4)->get();    
        $recent = Post::orderBy('created_at','DESC')->take(4)->get();
             
        $response = $this->view->render($response, 'home.twig', [
            'posts' => [
                'popular' => $popular,
                'recent' => $recent
            ]        
        ]);        

        return $response;        

    }

}