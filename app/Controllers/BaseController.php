<?php


namespace App\Controllers;

//Default Class for controllers
class BaseController{

    protected $container;

    public function __construct($container){
        $this->container = $container;
    }

    public function __get($property){

        //Can just call property in child class instead of using $this->container
        if($this->container->{$property}){
            return $this->container->{$property};
        }else{
            echo "Not a valid property in the Base Controller";
            die();
        }

       
    }

}