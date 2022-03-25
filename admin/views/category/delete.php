<?php
include_once '../../../vendor/autoload.php';

use Admin\Category\Category;

session_start();

$category = new category();
$old_category = $category->show($_GET['id']);

$old_category = $old_category;

$category = $category->delete($_GET['id']);
