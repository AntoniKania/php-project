<?php

class Credentials
{
    private string $password;
    private string $salt;

    /**
     * @param string $password
     * @param string $salt
     */
    public function __construct(string $password, string $salt)
    {
        $this->password = $password;
        $this->salt = $salt;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    public function getSalt(): string
    {
        return $this->salt;
    }




}