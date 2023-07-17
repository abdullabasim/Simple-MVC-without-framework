<?php

namespace App\Controllers;

use App\Models\Comment;

class CommentController extends BaseController
{
    public function store($postId)
    {
        // Check if the user is logged in
        if (!isset($_SESSION['user'])) {
            $this->redirect('login');

        }

        $userId = $_SESSION['user']['id'] ?? null;
        $comment = $_POST['comment'] ?? '';

        if (empty($comment) || strlen($comment) > 500) {
            $_SESSION['error_comment_message'] = 'Incorrect input.';
            $this->redirect("post/{$postId}");

        }

        // Create a new comment
        $commentModel = new Comment();
        $commentModel->createComment($postId, $userId, $comment);

        $_SESSION['success_comment_message'] = 'Comment submitted successfully.';
        // Redirect back to the post details page
        $this->redirect("post/{$postId}");

    }
}
