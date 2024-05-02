<?php

class Admin
{
    private $email;
    private $password;


    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function authenticate()
    {
        $pdo = DB::connect();
        
        $statement = $pdo->prepare('SELECT * FROM administrator WHERE email = :email');
        $statement->bindParam(':email', $this->email);
        $statement->execute();
    
        $admin = $statement->fetch();

        if (!empty($admin) && password_verify($this->password, $admin['password'])) {
            return true;
        }
    
        return false;
    }
}