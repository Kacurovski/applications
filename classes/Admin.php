<?php

class Admin
{
    private $username;
    private $password;


    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function authenticate()
    {
        $pdo = DB::connect();
        
        $statement = $pdo->prepare('SELECT * FROM admins WHERE username = :username');
        $statement->bindParam(':username', $this->username);
        $statement->execute();
    
        $admin = $statement->fetch();

        if (!empty($admin) && password_verify($this->password, $admin['password'])) {
            return true;
        }
    
        return false;
    }
}