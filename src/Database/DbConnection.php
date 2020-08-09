<?php

namespace Tribe\Database;

use PDO;

class DbConnection
{
    private static ?DbConnection $instance = null;

    private PDO $conn;
    private string $host = 'tribe-mysql';
    private string $userName = 'tribe';
    private string $password = 'tribe';
    private string $database = 'tribe';

    private function __construct()
    {
        $this->conn = new PDO("mysql:host={$this->host};dbname={$this->database}",
            $this->userName,
            $this->password,
            [PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"]
        );
        $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance(): DbConnection
    {
        if(!self::$instance) {
            self::$instance = new DbConnection();
        }

        return self::$instance;
    }

    public function getConnection(): PDO
    {
        return $this->conn;
    }
}