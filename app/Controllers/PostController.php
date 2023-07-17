<?php

namespace App\Controllers;

use App\Models\Post;
use App\Models\Comment;

class PostController extends BaseController
{
    public function index()
    {
        // Get data from the model
        $postModel = new Post();
        $posts = $postModel->getAllPosts();

        // Load the view
        $this->render('home', ['posts' => $posts]);
    }

    public function create()
    {
        // Check if the user is logged in
        if (!isset($_SESSION['user']))
            $this->redirect("login");



        // Load the create post view
        $this->render('create_post');
    }

    public function store()
    {
        $postModel = new Post();

        // Check if the user is logged in
        if (!isset($_SESSION['user']))
            $this->redirect("login");


        // Validate form data
        $title = $_POST['title'] ?? '';
        $content = $_POST['content'] ?? '';

        if (empty($title) || empty($content)) {
            $_SESSION['error_createPost_message'] = 'Please fill in all the required fields.';
            $this->redirect("create");

        }

        if (strlen($title) < 3 || strlen($content) < 3 || strlen($title) > 255) {
            $_SESSION['error_createPost_message'] = 'Incorrect Input.';
            $this->redirect("create-post");

        }

        // Handle image upload
        $imagePath = $this->uploadImage();

        // Store the post in the database
        $authorId = $_SESSION['user']['id'];
        $postModel->createPost($title, $content, $imagePath, $authorId);

        $_SESSION['success_message'] = 'Post created successfully.';
        // Redirect to the home page
        $this->redirect("/");

    }

    public function show($postId)
    {
        // Get the post details from the model
        $postModel = new Post();
        $post = $postModel->getPostById($postId);

        $commentModel = new Comment();
        $comments = $commentModel->getCommentsByPostId($postId);

        // Render the post details view
        $this->render('post_details', ['post' => $post, 'comments' => $comments]);
    }

    private function uploadImage()
    {
        $imagePath = '';
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imageTmpPath = $_FILES['image']['tmp_name'];
            $imageFileName = $_FILES['image']['name'];

            // Validate image file
            $allowedExtensions = ['jpg', 'jpeg', 'png'];
            $fileExtension = pathinfo($imageFileName, PATHINFO_EXTENSION);

            if (!in_array($fileExtension, $allowedExtensions)) {
                $_SESSION['error_createPost_message'] = 'Invalid image file format. Only JPG, JPEG, and PNG files are allowed!';
                $this->redirect("create");

            }

            $imagePath = 'uploads/' . $imageFileName;
            move_uploaded_file($imageTmpPath, __DIR__ . '/../../public/uploads/' . $imageFileName);
        }
        return $imagePath;
    }
}
