<?php

class Auth {
    private UserTable $userTable;

    public function __construct(UserTable $userTable) {
        $this->userTable = $userTable;
    }

    public function isLoggedIn(): bool
    {
        return isset($_SESSION['user_id']);
    }

    public function getRole(): ?string
    {
        return $_SESSION['role'] ?? null;
    }

    public function registerUser($username, $password): bool
    {
        return $this->registerUserWithGivenRole($username, $password, UserTable::$USER);
    }

    // should be visible only from administrator panel
    public function registerUserWithGivenRole($username, $password, $role): bool
    {
        $salt = self::generateSalt();
        $hashedPassword = self::hashPassword($password, $salt);

        $this->userTable->addUser($username, $hashedPassword, $salt, $role);

        $createdUser = $this->userTable->getUserByUsername($username);
        $this->setSession($createdUser);

        return isset($createdUser);
    }

    public function authenticateUser($username, $password): bool
    {
        $userFromDb = $this->userTable->getUserByUsername($username);

        if ($userFromDb) {
            $salt = $userFromDb['salt'];
            $passwordWithSalt = $password . $salt;

            $storedHashedPassword = $userFromDb['password'];

            if (password_verify($passwordWithSalt, $storedHashedPassword)) {
                $this->setSession($userFromDb);
                return true;
            }
        }
        return false;
    }

    private static function hashPassword($password, $salt): string
    {
        $passwordWithSalt = $password . $salt; // password_hash() with PASSWORD_ARGON2ID doesn't support salt option
        return password_hash($passwordWithSalt, PASSWORD_ARGON2ID);
    }

    private static function generateSalt(): string
    {
        $length = 16;
        $salt = base64_encode(random_bytes($length));

        return substr($salt, 0, $length);
    }

    private function setSession($userFromDb): void
    {
        $_SESSION['username'] = $userFromDb['username'];
        $_SESSION['role'] = $userFromDb['role'];
    }
}
