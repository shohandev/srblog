<?php
include_once '../../../vendor/autoload.php';

use Admin\Category\Category;
session_start();

$category = new Category();

$category->prepare($_POST);
// print_r($_POST);
// die;
$category-> store();

?>