<?php

class Database {
    private $pdo;

    public function __construct() {
        $dsn = 'sqlite:' . __DIR__ . '/database.db';
        $this->pdo = new PDO($dsn);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getConnection() {
        return $this->pdo;
    }
}
