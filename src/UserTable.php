<?php

class UserTable {
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function registerUser($username, $hashedPassword, $salt) {
        $query = "INSERT INTO user (username, password, salt) VALUES (?, ?, ?)";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$username, $hashedPassword, $salt]);
    }

    public function getUserByUsername($username) {
        $query = "SELECT * FROM user WHERE username = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}