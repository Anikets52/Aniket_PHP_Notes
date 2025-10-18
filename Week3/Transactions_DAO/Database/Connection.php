<?php

namespace Database;

use Exception;
use PDO;
use PDOException;

class Connection
{

    private $dsn = "mysql:host=localhost;dbname=test;charset=utf8mb4";
    private $user = "root";
    private $pass = "";
    private $pdo;

    public function getConnnection()
    {

        try {
            $this->pdo = new PDO(
                $this->dsn,
                $this->user,
                $this->pass,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
            return $this->pdo;
        } catch (PDOException $e) {
            throw new Exception("Connection Failed");
        }
    }
}
