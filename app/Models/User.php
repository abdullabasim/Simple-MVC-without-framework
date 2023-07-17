<?php
namespace App\Models;

use config\DatabaseConnection;
use PDO;

class User
{
    protected $db;

    public function __construct()
    {
        $this->db = DatabaseConnection::getInstance()->getConnection();
    }

    public function getUserByUsername($username)
    {
        // Fetch the user from the database by username
        $query = $this->db->prepare('SELECT * FROM users WHERE username = :username');
        $query->execute([':username' => $username]);
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function createUser($username, $password)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);

        return $stmt->execute();
    }
}