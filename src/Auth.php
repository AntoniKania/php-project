<?php

class Auth {
    private UserTable $userTable;

    public function __construct(UserTable $userTable) {
        $this->userTable = $userTable;
    }
    public function registerUser($username, $password) {
        $salt = self::generateSalt();
        $hashedPassword = self::hashPassword($password, $salt);

        $this->userTable->registerUser($username, $hashedPassword, $salt);
    }

    public function authenticateUser($username, $password) {
        $userFromDb = $this->userTable->getUserByUsername($username);

        if ($userFromDb) {
            $salt = $userFromDb['salt'];
            $passwordWithSalt = $password . $salt;

            $storedHashedPassword = $userFromDb['password'];

            if (password_verify($passwordWithSalt, $storedHashedPassword)) {
                $_SESSION['user_id'] = $userFromDb['userId'];
                $_SESSION['username'] = $userFromDb['username'];
                $_SESSION['role'] = $userFromDb['role'];
                echo "login successful";
            } else {
                echo "Invalid username or password";
            }
        } else {
            echo "Invalid username or password";
        }
    }

    private static function hashPassword($password, $salt) {
        $passwordWithSalt = $password . $salt; // password_hash() with PASSWORD_ARGON2ID doesn't support salt option
        return password_hash($passwordWithSalt, PASSWORD_ARGON2ID);
    }

    private static function generateSalt() {
        $length = 16;
        $salt = base64_encode(random_bytes($length));

        return substr($salt, 0, $length);
    }
}
