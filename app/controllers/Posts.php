<?php
class Posts extends Controller{
    public function __construct()
    {
        if (!isLoggedIn()){
            redirect('users/login');
        }
        // connecting to the model
        $this->postModel = $this->Model('Post');

    }

    public function index(){
        // Get posts from db
        $posts = $this->postModel->getPosts();

        $data = [
            'posts' => $posts
        ];

        $this->View('posts/index', $data);
    }

    public function add(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            // Sanitize POST array
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'title' => trim(($_POST['title'])),
                'body' => trim(($_POST['body'])),
                'user_id' => $_SESSION['user_id'],
                'title_err' => '',
                'body_err' => '',
            ];

            // Validate the data
            if (empty($data['title']))
                $data['title_err'] = 'Please enter title';
            if (empty($data['body']))
                $data['body_err'] = 'Please enter body text';

            //Make sure no errors
            if (empty($data['title_err']) && empty($data['body_err'])){
                // Validated
                if ($this->postModel->addPost($data)){
                    flashMessage('post_message', 'Post Added');
                    redirect('posts');
                }
            }else
                $this->View('posts/add', $data);

        }else{
            $data = [
                'title' => '',
                'body' => ''
            ];

            $this->View('posts/add', $data);
        }

    }

    public function show($id){
        $post= $this->postModel-getPostById($id);

        $data = [];

        $this->View('posts/show', $data);
    }
}