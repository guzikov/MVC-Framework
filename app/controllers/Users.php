<?php
/**
 * Users controller class
 * Created by PhpStorm.
 * User: guzepp
 * Date: 22.05.2018
 * Time: 12:19
 */

class Users extends Controller {
    public function __construct()
    {
//        Call the USER Model
        $this->userModel = $this->Model('User');
    }

//    This function checks if it is POST request or opens registration form
    public function register(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){

            //SANITIZE POST ARRAY
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

//            Validate email
            if (empty($data['email'])){
                $data['email_err'] = "Please enter email";
            } elseif ($this->userModel->findUserByEmail($data['email']))
                $data['email_err'] = "This email is already taken";
            //            Validate name
            if (empty($data['name'])){
                $data['name_err'] = "Please enter name";
            }
            //            Validate password
            if (empty($data['password'])){
                $data['password_err'] = "Please enter password";
            } elseif (strlen($data['password']) < 6){
                $data['password_err'] = "Password must be at least 6 characters";
            }
            //            Validate password_confirm
            if (empty($data['confirm_password'])){
                $data['confirm_password_err'] = "Please confirm password";
            } elseif ($data['password'] != $data['confirm_password'])
                $data['confirm_password_err'] = "Passwords do not much";

//          Make sure all errors are empty
            if (empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err'])
                && empty($data['confirm_password_err'])){
//                Validate

//                Hash the password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

//              Register the user
                if ($this->userModel->register($data)){
                    flashMessage('register_success', 'You are registered and can log in');
                    redirect('users/login');
                }
                else die ('Something goes wrong');
            } else{
//                Load view with errors
                $this->View('users/register', $data);
            }
        } else{
            //            INIT data
            $data = [
                'name' => '',
                'email' => '',
                'password' => '',
                'confirm_password' => '',
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
//            Load view
            $this->View('users/register', $data);
        }

    }

//    Login Form
//    This function checks if it is POST request or opens registration form

    public function login(){
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            //Process form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'email_err' => '',
                'password_err' => '',
            ];

            //            Validate login email
            if (empty($data['email'])){
                $data['email_err'] = "Please enter email";
            }

            //            Validate login password
            if (empty($data['password'])){
                $data['password_err'] = "Please enter password";
            }

            // check for user/email
            if ($this->userModel->findUserByEmail($data['email'])) {
                //USER found
            } else
                $data['email_err'] = "No user with such email";

            //          Make sure all errors are empty
            if (empty($data['email_err']) && empty($data['password_err'])){
//                Validate
                // check and set logged in user
                $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                if ($loggedInUser){
                    //create session
                    $this->createUserSession($loggedInUser);
                }else{
                    $data['password_err'] = "Password Incorrect";

                    $this->View('users/login', $data);
                }

            } else{
//                Load view with errors
                $this->View('users/login', $data);
            }

        } else{
            //            INIT data
            $data = [
                'email' => '',
                'password' => '',
                'email_err' => '',
                'password_err' => ''
            ];
//            Load view
            $this->View('users/login', $data);
        }

    }

    public function createUserSession($user){
        $_SESSION['user_id'] = $user->id;
        $_SESSION['user_email'] =$user->email;
        $_SESSION['user_name'] = $user->name;
        redirect('posts');
    }

    public function logout(){
        unset($_SESSION['user_id']);
        unset($_SESSION['user_name']);
        unset($_SESSION['user_email']);
        session_destroy();
        redirect('users/login');
    }


}
