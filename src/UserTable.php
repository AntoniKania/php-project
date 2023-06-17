<?php

class UserTable {
    public static $USER = "user";
    public static $AUTHOR = "author";
    public static $ADMIN = "admin";
    private PDO $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function addUser($username, $hashedPassword, $salt, $role): bool
    {
        $query = "INSERT INTO user (username, password, salt, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([$username, $hashedPassword, $salt, $role]);
    }

    public function getUserByUsername($username): ?array
    {
        $query = "SELECT * FROM user WHERE username = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllUsers(): ?array
    {
        $query = "SELECT * FROM user";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function deleteUser($id): bool
    {
        $query = "DELETE FROM user WHERE id = ?";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([$id]);
    }
}