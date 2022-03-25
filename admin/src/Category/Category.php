<?php
namespace Admin\Category;
use mysqli;

class Category{
    public $mysqli;
    public $id;
    public $category;
    public function __construct()
    {
        $this->mysqli = new mysqli('localhost', 'root', '', 'srblog');

        if ($this->mysqli->connect_error) {
            die("Connection failed: " . $this->mysqli->connect_error);
        }
    }

    public function prepare($data = array())
    {
        if (array_key_exists('id', $data)) {
            $this->id = $data['id'];
        }
        if (array_key_exists('category', $data)) {
            $this->category = $data['category'];
        }
    }
    
    public function store()
    {
        $query="INSERT INTO `category`( `category`, `created_at`) VALUES ('" . $this->mysqli->real_escape_string($this->category) . "','" . date('Y-m-d H:i:s') . "')";
        $result = $this->mysqli->query($query);
        // echo $query;
        // die;

        if ($result) {
            $_SESSION['message'] = '<h2 style="text-align:center; color:green; margin-bottom:10px">Category added successfully</h2>';
        } else {
            $_SESSION['message'] = '<h2 style="text-align:center; color:red; margin-bottom:10px">Oops! Something wrong to add category. Please try again.</h2>';
        }

        header('location:index.php'); 
    }
    public function index ()
    {
        $query = "SELECT * FROM category ";

        $result = $this->mysqli->query($query);

        $categories = $result->fetch_all(MYSQLI_ASSOC);

        return $categories;
    }
    public function show($id)
    {
        $query = "SELECT * FROM  category WHERE `id`=" . $id;

        $result = $this->mysqli->query($query);

        $category = $result->fetch_assoc();

        return $category;
    }
    public function update()
    {
        $query = "UPDATE `category` SET `category`='" . $this->mysqli->real_escape_string($this->category) . "',`updated_at`='" . date('Y-m-d H:i:s') . "' WHERE `id`=". $this->id;
        $result = $this->mysqli->query($query);
        // print_r($query);
        // die;

        if ($result) {
            $_SESSION['message'] = '<h2 style="text-align:center; color:green; margin-bottom:10px">Category has been updated successfully</h2>';
        } else {
            $_SESSION['message'] = '<h2 style="text-align:center; color:red; margin-bottom:10px">Oops! Something wrong to update category. Please try again.</h2>';
        }

        header('location:index.php');
    }
    public function delete($id)
    {
        $query = "DELETE FROM  category WHERE `id`=" . $id;

        $result = $this->mysqli->query($query);

        if ($result) {
            $_SESSION['message'] = '<h2 style="text-align:center; color:green; margin-bottom:10px">Your category has been deleted successfully.</h2>';
        } else {
            $_SESSION['message'] = '<h2 style="text-align:center; color:red; margin-bottom:10px">Oops! Something wrong to delete category. Please try again.</h2>';
        }

        header('location:index.php');
    }
}
