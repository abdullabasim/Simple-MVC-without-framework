<?php

namespace App\Models;

use config\DatabaseConnection;
use PDO;

class Post
{
    protected $db;

    public function __construct()
    {
        $this->db = DatabaseConnection::getInstance()->getConnection();
    }

    public function getAllPosts()
    {
        // Fetch all posts from the database with the author's username and count of comments
        $query = $this->db->query('SELECT p.*, u.username AS author_name, COUNT(c.id) AS comments_count
                                   FROM posts p
                                   INNER JOIN users u ON p.author_id = u.id
                                   LEFT JOIN comments c ON p.id = c.post_id
                                   GROUP BY p.id
                                   ORDER BY p.id DESC');
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPostById($postId)
    {
        $stmt = $this->db->prepare("SELECT p.*, u.username AS author_name
                               FROM posts p
                               INNER JOIN users u ON p.author_id = u.id WHERE p.id = :postId");
        $stmt->bindParam(':postId', $postId);
        $stmt->execute();

        // Fetch the post details from the database
        $post = $stmt->fetch(PDO::FETCH_ASSOC);

        return $post;
    }

    public function createPost($title, $content,$imagePath, $authorId)
    {
        // Create a new post in the database
        $query = $this->db->prepare('INSERT INTO posts (title, content,image, author_id) VALUES(:title, :content ,:image, :author_id)');
        $query->execute([
            ':title' => $title,
            ':content' => $content,
            ':image' => $imagePath,

            ':author_id' => $authorId
        ]);
    }
}