<?php
include_once '../../../vendor/autoload.php';

use Admin\Users\User;

session_start();

if($_POST['username'] && $_POST['password']) {
    $user = new User();
    $user->login($_POST);
} else {
    $_SESSION['message'] = '<h2 style="text-align:center; color:red; padding-top: 20px; margin-bottom:0">Please enter username and password!</h2>';
    header('location:login.php'); 
}



