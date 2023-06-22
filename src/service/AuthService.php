<?php

class AuthService {
    private UserTable $userTable;

    public function __construct(UserTable $userTable) {
        $this->userTable = $userTable;
    }

    public function registerUser($username, $password): bool
    {
        return $this->registerUserWithGivenRole($username, $password, User::$USER);
    }

    // should be visible only from administrator panel
    public function registerUserWithGivenRole($username, $password, $role): bool
    {
        $salt = self::generateSalt();
        $hashedPassword = self::hashPassword($password, $salt);

        $this->userTable->addUser($username, $hashedPassword, $salt, $role);

        $createdUser = $this->userTable->getUserByUsername($username);
        $this->setSession($createdUser);

        return $createdUser != null;
    }

    public function authenticateUser($username, $password): bool
    {
        $credentials = $this->userTable->getCredentialsByUsername($username);

        if ($credentials) {
            $salt = $credentials->getSalt();
            $passwordWithSalt = $password . $salt;

            $storedHashedPassword = $credentials->getPassword();

            if (password_verify($passwordWithSalt, $storedHashedPassword)) {
                $this->setSession($this->userTable->getUserByUsername($username));
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

    private function setSession($user): void
    {
        $_SESSION['user_id'] = $user->getId();
        $_SESSION['username'] = $user->getUsername();
        $_SESSION['role'] = $user->getRole();
    }
}
