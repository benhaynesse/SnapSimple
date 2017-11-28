<?php


namespace App\Controllers;

class HomeController extends BaseController{

    public function index($request, $response){

        $user = [
            array('image' => 'https://www.findchatfriends.com/profile/photo/5a1318194ec6d.jpg',
            'likes' => 50,
            'dislikes' => 30,),
            array('image' => 'https://www.findchatfriends.com/profile/photo/5a1336d04595f.jpg',
            'likes' => 121,
            'dislikes' => 7,),
            array('image' => 'https://i.ytimg.com/vi/ruPuuhWqB8c/maxresdefault.jpg',
            'likes' => 121,
            'dislikes' => 7,),
            array('image' => 'https://www.findchatfriends.com/profile/photo/5a1336d04595f.jpg',
            'likes' => 121,
            'dislikes' => 7,),
        ];

        return $this->view->render($response, 'home.twig', [
            'users' => $user,
        ]);

    }

}