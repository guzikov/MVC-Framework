<?php

/**
 * Class Main Controller
 */

class Controller{
//    Load model
    public function Model($model){
//        Require for model file
        require_once '../app/models/' . $model . ".php";
//      Return new model instance
        return new $model;
    }

//Load view
    public function View($view, $data = []){
//        Check if view file exists
        if (file_exists("../app/views/" . $view . ".php"))
            require_once ('../app/views/' . $view . '.php');
        else
//            if view file doesn't exist
            die("The view file does not found");
    }
}