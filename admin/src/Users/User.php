<?php
namespace Admin\Users;
use mysqli;

class User{
    public $mysqli;
    public $id;
    public $username;
    public $email;
    public $password;
    public function __construct()
    {
        $this->mysqli = new mysqli('localhost', 'root', '', 'srblog');

        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }
    }
    public function prepare($data=[]) 
    {
        if(array_key_exists('id', $data)) {
            $this->id = $data['id'];
        }

        if(array_key_exists('username', $data)) {
            $this->username = $data['username'];
        }
        if(array_key_exists('email', $data)) {
            $this->email = $data['email'];
        }
        if(array_key_exists('password', $data)) {
            $this->passsword = $data['password'];
        }
    }
        
        public function store()
        {
            $query="INSERT INTO `users`( `username`, `email`, `password`) VALUES ('" . $this->username . "','" . $this->email . "','" . md5($this->passsword) . "')";
            $result = $this->mysqli->query($query);
            if ($result) {
                $_SESSION['message'] = '<h2 style="text-align:center; color:green; padding-top: 20px; margin-bottom:0">You\'re Registered succedfully. Please Login </h2>';
            } else {
                $_SESSION['message'] = '<h2 style="text-align:center; color:red; margin-bottom:10px">Oops! Something wrong to register now. Please try again.</h2>';
            }
    
            header('location:login.php'); 
        }

        public function getUserByEmail($email) {

            $query = "SELECT * FROM  users WHERE `email`='" . $email . "'";

            $result = $this->mysqli->query($query);

            // print_r($result);
            // die;

            $users = $result->fetch_all(MYSQLI_ASSOC);

            return count($users);
        }

        public function getUserByUsername($username) {

            $query = "SELECT * FROM  users WHERE `username`='". $username. "'";

            $result = $this->mysqli->query($query);

            $users =$result->fetch_all(MYSQLI_ASSOC);

            // $user = ;

            return count($users);
        }

        public function validateUser($data)
        {
            $status = true;
            if ($data['password'] != $data['confirm_password']) {
                $status = false;
                $_SESSION['message'] = '<h2 style="text-align:center; color:red; padding-top: 20px; margin-bottom:0">Password doesn\'t matched!</h2>';;
            }else if(strlen($data['password']) < 6){
                $status = false;
                $_SESSION['message'] = '<h2 style="text-align:center; color:red; padding-top: 20px; margin-bottom:0">Password length must atleast 6 character</h2>';
            } else if($this->getUserByEmail($data['email'])) {
                $status = false;
                $_SESSION['message'] = '<h2 style="text-align:center; color:red; padding-top: 20px; margin-bottom:0">This email is already exist!</h2>';
            } else if($this->getUserByUsername($data['username'])) {
                $status = false;
                $_SESSION['message'] = '<h2 style="text-align:center; color:red; padding-top: 20px; margin-bottom:0">This username is already taken!</h2>';
            }

            return $status;
        }
        public function login($data){
            $query = "SELECT * FROM  users WHERE `username`='". $data['username']. "' limit 1";

            $result = $this->mysqli->query($query);

            $user = $result->fetch_assoc();
            
            if(!empty($user)) {
                if(md5($data['password']) == $user['password']) {
                    $_SESSION['user'] = $user;
                    $_SESSION['message'] = '<h2 style="text-align:center; color:green; margin-bottom:10px">You\'re successfully logged in.</h2>';
                    header('location:../posts/index.php');
                } else {
                    $_SESSION['message'] = '<h2 style="text-align:center; color:red; padding-top: 20px; margin-bottom:0">Invalid password!</h2>';
                    header('location:login.php');
                }

            } else {
                $_SESSION['message'] = '<h2 style="text-align:center; color:red; padding-top: 20px; margin-bottom:0">Invalid username!</h2>';
                header('location:login.php'); 
            }

        }
        public function show($id)
        {
            $query = "SELECT * FROM  users WHERE `id`=" . $id;
    
            $result = $this->mysqli->query($query);
    
            $user = $result->fetch_assoc();
    
            return $user;
        }
    }
