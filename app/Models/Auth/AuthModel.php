<?php

namespace App\Models\Auth;

use App\DBOs\User;



class AuthModel{

    public function user(){
        $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
        return User::find($user);
    }

    public function check(){              
        return isset($_SESSION['user']);   
    }

    public function attempt($id){


        $user = User::where('facebook_id', $id)->first();
        
        if(!$user){
            return false;
        }
        
        $_SESSION['user'] = $user->id;
        return true;                

    }

    public function signout(){
        if(isset($_SESSION['user'])){
            unset($_SESSION['user']);
        }
    }
}