<?php
include_once '../../../vendor/autoload.php';

use Admin\Post\Post;

session_start();

$post = new post();
$old_post = $post->show($_GET['id']);

$old_cover_photo = $old_post['cover_photo'];

if(!empty($old_cover_photo)) {
    unlink("../../../images/".$old_cover_photo);
}
$post = $post->delete($_GET['id']);

?>