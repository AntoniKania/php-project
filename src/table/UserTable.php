<?php

require_once '../config.php';

class UserTable {
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

    public function getCredentialsByUsername($username): ?Credentials
    {
        $query = "SELECT password, salt FROM user WHERE username = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$username]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new Credentials(
            $row['password'],
            $row['salt']
        );
    }
    public function getUserByUsername($username): ?User
    {
        $query = "SELECT id, username, role FROM user WHERE username = ?";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute([$username]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        return new User(
            $row['id'],
            $row['username'],
            $row['role']
        );

    }

    public function getAllUsers(): ?array
    {
        $query = "SELECT id, username, role FROM user";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $users = [];
        foreach ($rows as $row) {
            $user = new User(
                $row['id'],
                $row['username'],
                $row['role']
            );
            $users[] = $user;
        }

        return $users ?: null;
    }

    public function deleteUser($id): bool
    {
        $query = "DELETE FROM user WHERE id = ?";
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute([$id]);
    }
}