<?php
include_once '../../../vendor/autoload.php';

use Admin\Users\User;

session_start();

unset($_SESSION['user']);

header("Location: login.php");