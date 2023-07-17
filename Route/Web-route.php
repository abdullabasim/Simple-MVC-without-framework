<?php


use Route\Router;
use App\Controllers\AuthController;
use App\Controllers\CommentController;
use App\Controllers\PostController;


$router = new Router();

$router->get('/', function () {

    $postController = new PostController();
    $postController->index();
});

$router->get('/post/{id}', function ($params) {
    $postId = $params['id'];

    $postController = new PostController();
    $postController->show($postId);
});

$router->get('/create-post', function () {
    $postController = new PostController();
    $postController->create();
});

$router->post('/create-post', function () {
    $postController = new PostController();
    $postController->store();
});

$router->post('/comment/create/{post_id}', function ($params) {
    $postId = $params['post_id'];
    $commentController = new CommentController();
    $commentController->store($postId);
});


$router->get('/login', function () {
    $authController = new AuthController();
    $authController->login();
});

$router->post('/authenticate', function () {
    $authController = new AuthController();
    $authController->authenticate();
});

$router->get('/logout', function () {
    $authController = new AuthController();
    $authController->logout();
});


$router->get('/register', function () {
    $authController = new AuthController();
    $authController->showRegistrationForm();
});

$router->post('/register', function () {
    $authController = new AuthController();
    $authController->register();
});



// Serve static files (including images)
$router->get('/public/*', function () {
    $requestedFile = $_SERVER['REQUEST_URI'];
    $filePath = __DIR__ . $requestedFile;

    if (file_exists($filePath) && !is_dir($filePath)) {
        $fileMimeType = mime_content_type($filePath);
        header("Content-Type: $fileMimeType");
        readfile($filePath);
        exit;
    } else {
        // Image not found
        header("HTTP/1.0 404 Not Found");
        exit;
    }
});

$router->run();
