<?php
namespace Admin\Post;
use mysqli;

class Post{
    public $mysqli;
    public $id;
    public $title;
    public $summary;
    public $body;
    public $cover_photo;
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

        if(array_key_exists('title', $data)) {
            $this->title = $data['title'];
        }
        if(array_key_exists('summary', $data)) {
            $this->summary = $data['summary'];
        }
        if(array_key_exists('body', $data)) {
            $this->body = $data['body'];
        }
        if(array_key_exists('cover_photo', $data)) {
            $this->cover_photo = $data['cover_photo'];
        }
    }

    public function store()
    {
        $query="INSERT INTO `post`( `title`, `summary`, `body`,`cover_photo`) VALUES ('" . $this->mysqli->real_escape_string($this->title) . "','" . $this->mysqli->real_escape_string($this->summary) . "','" . $this->mysqli->real_escape_string($this->body) . "','" . $this->cover_photo . "')";
        $result = $this->mysqli->query($query);
        // echo $query;
        // die;

        if ($result) {
            $_SESSION['message'] = '<h2 style="text-align:center; color:green; margin-bottom:10px">Your Article has been posted successfully</h2>';
        } else {
            $_SESSION['message'] = '<h2 style="text-align:center; color:red; margin-bottom:10px">Oops! Something wrong to post your article. Please try again.</h2>';
        }

        header('location:index.php'); 
    }
    public function index ()
    {
        $query = "SELECT * FROM post ";

        $result = $this->mysqli->query($query);

        $posts = $result->fetch_all(MYSQLI_ASSOC);

        return $posts;
    }
    public function show($id)
    {
        $query = "SELECT * FROM  post WHERE `id`=" . $id;

        $result = $this->mysqli->query($query);

        $post = $result->fetch_assoc();

        return $post;
    }
    public function update()
    {
        $query = "UPDATE `post` SET `title`='" . $this->mysqli->real_escape_string($this->title) . "',`summary`='" . $this->mysqli->real_escape_string($this->summary) . "',`body`='" . $this->mysqli->real_escape_string($this->body) . "',`cover_photo`='" . $this->cover_photo . "',`updated_at`='" . date('Y-m-d H:i:s') . "' WHERE `id`=". $this->id;
        $result = $this->mysqli->query($query);

        if ($result) {
            $_SESSION['message'] = '<h2 style="text-align:center; color:green; margin-bottom:10px">Your Post has been updated successfully</h2>';
        } else {
            $_SESSION['message'] = '<h2 style="text-align:center; color:red; margin-bottom:10px">Oops! Something wrong to update your post. Please try again.</h2>';
        }

        header('location:index.php');
    }
    public function delete($id)
    {
        $query = "DELETE FROM  post WHERE `id`=" . $id;

        $result = $this->mysqli->query($query);

        if ($result) {
            $_SESSION['message'] = '<h2 style="text-align:center; color:green; margin-bottom:10px">Your post has been deleted successfully.</h2>';
        } else {
            $_SESSION['message'] = '<h2 style="text-align:center; color:red; margin-bottom:10px">Oops! Something wrong to delete post. Please try again.</h2>';
        }

        header('location:index.php');
    }
}
