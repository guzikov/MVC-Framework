<?php
/**
 * USER model
 * Created by PhpStorm.
 * User: guzepp
 * Date: 22.05.2018
 * Time: 14:50
 */

class User{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

//    User registration function
    public function register($data){
        $this->db->query("INSERT INTO users (name, email, password) VALUES (:name, :email, :password)");
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':email', $data['email']);
        $this->db->bind(':password', $data['password']);
        if ($this->db->execute())
            return true;
        else return false;
    }
//    Login User
    public function login($email, $password){
        $this->db->query('SELECT * FROM users WHERE email = :email');
        $this->db->bind(':email', $email);

        $row = $this->db->single();

        $hashed_password = $row->password;
        if (password_verify($password, $hashed_password))
            return $row;
        else
            return false;
    }
// Find user email
    public function findUserByEmail($email){
        $this->db->query("SELECT * FROM users WHERE email = :email");
        $this->db->bind(':email', $email);
        $this->db->single();

//        Checks if there some rows in DB with such email
        if ($this->db->rowCount() > 0)
            return true;
        else return false;
    }
}