<?php
class Pages extends Controller {
    function __construct()
    {

    }

    function index(){
        if(isLoggedIn())
            redirect('posts');

        $data =[
            'title' => "Share your thoughts",
            'description' => 'Simple and clear MVC PHP Framework'
        ];
        $this->View('pages/index', $data);
    }

    function about(){
        $data =[
            'title' => "About US",
            'description' => "APP to share thoughts with other users"
        ];

        $this->View('pages/about', $data);
    }
}