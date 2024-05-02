<?php

class User
{
    private $name;
    private $surname;
    private $email;
    private $password;

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setSurname(string $surname)
    {
        $this->surname = $surname;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function selectAllUsers()
    {

        $pdo = DB::connect();

        $sql = "SELECT * FROM user WHERE is_deleted = :is_deleted";

        $stmt = $pdo->prepare($sql);

        $stmt->execute(['is_deleted' => false]);

        return $stmt->fetchAll();
    }

    private function getUserByEmail($email)
    {
        $pdo = DB::connect();
        $stmt = $pdo->prepare('SELECT * FROM user WHERE email = :email');
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function authenticate()
    {
        $pdo = DB::connect();

        $statement = $pdo->prepare('SELECT * FROM user WHERE email = :email');
        $statement->bindParam(':email', $this->email);
        $statement->execute();

        $user = $statement->fetch();

        if (!empty($user) && password_verify($this->password, $user['password'])) {
            unset($user['password']);
            return $user;
        }

        return false;
    }

    public function registerUser()
    {
        $pdo = DB::connect();
        $existingUserWithEmail = $this->getUserByEmail($this->email);

        if ($existingUserWithEmail) {
            $_SESSION['message'] = ['content' => 'Email is already taken', 'type' => 'danger'];
            return false; 
        }

        $sql = "INSERT INTO user (name, surname, email, password) 
            VALUES (:name, :surname, :email, :password)";

        $stmt = $pdo->prepare($sql);

        $params = [
            'name' => $this->name,
            'surname' => $this->surname,
            'email' => $this->email,
            'password' => $this->password,
        ];

        if ($stmt->execute($params)) {
            $_SESSION['message'] = ['content' => 'Registration successful', 'type' => 'success'];
            return true; 
        } else {
            $_SESSION['message'] = ['content' => 'Something went wrong', 'type' => 'danger'];
            return false;
        }
    }
}
?>
