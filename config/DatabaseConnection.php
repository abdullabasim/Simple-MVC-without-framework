<?php

namespace config;

use PDO;
use PDOException;

class DatabaseConnection
{
    private static $instance;
    private $connection;

    private function __construct()
    {
        $config = require 'config.php';
        $databaseConfig = $config['database'];

        try {
            $dsn = "mysql:host={$databaseConfig['host']};dbname={$databaseConfig['dbname']};charset=utf8mb4";
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ];

            $this->connection = new PDO($dsn, $databaseConfig['username'], $databaseConfig['password'], $options);
        } catch (PDOException $e) {

            die("Database connection failed: " . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
