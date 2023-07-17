<?php
namespace App\Controllers;

use App\Models\User;

class AuthController extends BaseController
{
    public function login()
    {
        // Check if the user is already logged in
        if (isset($_SESSION['user'])) {
            $this->redirect('');
        }

        // Load the login view
        $this->render('login');
    }

    public function authenticate()
    {
        // Get the form data
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($username) || empty($password)) {
            $_SESSION['error_login_message'] = 'Please fill in all the required fields.';
            $this->redirect('login');

        }

        // Validate the credentials
        $userModel = new User();
        $user = $userModel->getUserByUsername($username);

        if ($user && password_verify($password, $user['password'])) {
            // Authentication successful
            $_SESSION['user'] = $user;
            $this->redirect('');

        } else {
            $_SESSION['error_login_message'] = 'Authentication failed.';
            $this->redirect('login');

        }
    }

    public function logout()
    {
        // Destroy the session and redirect to login
        session_destroy();
        $this->redirect('login');

    }

    public function showRegistrationForm()
    {
        // Load the registration form view
        $this->render('register');
    }

    public function register()
    {
        // Get the form data
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($username) || empty($password) || strlen($username) > 255 || strlen($password) > 255) {
            $_SESSION['error_register_message'] = 'Incorrect Input.';
            $this->redirect('register');

        }


        // Create a new user
        $userModel = new User();
        $result = $userModel->createUser($username, $password);

        if (!$result) {
            $_SESSION['error_register_message'] = 'User Not created!';
            $this->redirect('register');

        }

        // Redirect to the login page
        $_SESSION['success_register_message'] = 'User created successfully.';
        $this->redirect('login');

    }
}
