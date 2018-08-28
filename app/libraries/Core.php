<?php
/**
 * APP Core Class
 * Creates URL and loads Core controller
 * URL format - /controller/method/params
 */

class Core{
    protected $currentController = 'Pages';
    protected $currentMethod = 'index';
    protected $params = [];

    public function __construct()
    {
//        print_r($this->getUrl());
        $url = $this->getUrl();

//        Look in the controllers path for first value (url[0] = controller name)
        if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')){
//            if exist - set as a controller
            $this->currentController = ucwords($url[0]);
//            Unset index url[0]
            unset($url[0]);
        }

//        Require the controller
        require_once ('../app/controllers/' . $this->currentController . '.php');

//        Instantiate controller class
        $this->currentController = new $this->currentController;

//        Check for method in Controller
        if (isset($url[1])){
//            Check the method in class
            if (method_exists($this->currentController, $url[1]))
                $this->currentMethod = $url[1];
            unset($url[1]);
        }

//        Get method parameters
        $this->params = $url ? array_values($url) : [];

//        Call a callback function with array of params (first attribute: array($obj, method), second is params array)
        call_user_func_array([$this->currentController, $this->currentMethod], $this->params);

    }

    public function getUrl()
    {
        if (isset($_GET['url'])){
            $url = rtrim($_GET['url'], "/"); // delete last right slash
            $url = filter_var($url, FILTER_SANITIZE_URL); //delete all the characters which should'n be in URL
            $url = explode("/", $url); // put the URL in to array
            return $url;
        }
    }
}