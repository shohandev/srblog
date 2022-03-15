<?php
include_once '../../../vendor/autoload.php';

use Admin\Post\Post;
session_start();

$post = new Post();





$post->prepare($_POST);
$post-> store();
?>