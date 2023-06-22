<?php

class User
{
    public static string $USER = "user";
    public static string $AUTHOR = "author";
    public static string $ADMIN = "admin";
    private int $id;
    private string $username;
    private string $role;

    public function __construct($id, $username, $role)
    {
        $this->id = $id;
        $this->username = $username;
        $this->role = $role;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getRole(): string
    {
        return $this->role;
    }
}