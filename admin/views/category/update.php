<?php
include_once '../../../vendor/autoload.php';

use Admin\Category\Category;

session_start();

$category = new category();
// print_r($_POST);
// die;
if (isset($data['Category'])) {

    $old_category = $Category->show($_POST['id']);

}

$category-> prepare ($_POST);
$category-> update();
