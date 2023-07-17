<?php

namespace App\Models;
use config\DatabaseConnection;
use PDO;

class Comment
{
    private $db;

    public function __construct()
    {
        $this->db = DatabaseConnection::getInstance()->getConnection();
    }

    public function getCommentsByPostId($postId)
    {

        $stmt = $this->db->prepare('SELECT comments.*, users.username 
                               FROM comments 
                               INNER JOIN users ON comments.user_id = users.id 
                               WHERE comments.post_id = :post_id');
        $stmt->bindParam(':post_id', $postId);
        $stmt->execute();
        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $comments;

    }

    public function createComment($postId, $userId, $comment)
    {



        $query = $this->db->prepare('INSERT INTO comments (post_id, user_id,  comment) 
                  VALUES (:post_id, :user_id,  :comment)');
     $result =   $query->execute([
            ':post_id' => $postId,
            ':user_id' => $userId,
            ':comment' => $comment,

        ]);

     return $result;
    }

    public function getCommentsCountByPostId($postId)
    {
        $stmt = $this->db->prepare('SELECT COUNT(*) as count FROM comments WHERE post_id = :post_id');
        $stmt->bindParam(':post_id', $postId);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['count'];
    }
}