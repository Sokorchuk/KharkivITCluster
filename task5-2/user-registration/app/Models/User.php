<?php
namespace App\Models;

use PDO;

class User {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function register($email, $password, $token) {
        $stmt = $this->db->prepare("INSERT INTO users (email, password, token) VALUES (:email, :password, :token)");
        $stmt->execute([
            ':email' => $email,
            ':password' => password_hash($password, PASSWORD_DEFAULT),
            ':token' => $token,
        ]);
    }

    public function findByToken($token) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE token = :token LIMIT 1");
        $stmt->execute([':token' => $token]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function confirmUser($token) {
        $stmt = $this->db->prepare("UPDATE users SET is_confirmed = 1 WHERE token = :token");
        return $stmt->execute([':token' => $token]);
    }
}
