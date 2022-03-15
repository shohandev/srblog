<?php
include_once '../../../vendor/autoload.php';

use Admin\Users\User;

session_start();

$user = new User();

$user->prepare($_POST);



$validation = $user->validateUser($_POST);


if ($validation) {
    $user->store();
} else {
    header('location:register.php');
}
