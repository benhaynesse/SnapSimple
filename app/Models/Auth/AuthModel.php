<?php

namespace App\Models\Auth;




class AuthModel{

    public function user(){
        $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
        return 5;
    }

    public function check(){
        return isset($_SESSION['user']);
    }

    public function attempt($email, $password){

        return true;

    }

    public function signout(){
        if(isset($_SESSION['user'])){
            unset($_SESSION['user']);
        }
    }
}