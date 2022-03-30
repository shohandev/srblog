<?php
include_once '../../../vendor/autoload.php';

use Admin\Post\Post;

session_start();

$post = new post();
// print_r($_FILES);
// die;
if (isset($_FILES['cover_photo']['name']) && !empty($_FILES['cover_photo']['name'])) {

    $old_post = $post->show($_POST['id']);

    $old_cover_photo = $old_post['cover_photo'];

    if(!empty($old_cover_photo)) {
        unlink("../../../images/".$old_cover_photo);
    }


    $errors = array();
    $image_name = time() . $_FILES['cover_photo']['name'];
    $image_type = $_FILES['cover_photo']['type'];
    $image_tmp_name = $_FILES['cover_photo']['tmp_name'];
    $image_size = $_FILES['cover_photo']['size'];
    $test = explode('.', $image_name);
    $file_extension = strtolower(end($test));

    $format = array('jpeg', 'jpg', 'png','webp');


    if (in_array($file_extension, $format) === false) {
        $errors[] = 'Wrong Format';
    }
    if (empty($errors)==true) {
        move_uploaded_file($image_tmp_name, "../../../images/".$image_name);
        $_POST['cover_photo'] = $image_name;
    }
}

$post-> prepare ($_POST);
$post-> update();
?>