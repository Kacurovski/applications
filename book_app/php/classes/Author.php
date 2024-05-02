<?php

class Author
{
    private $name;
    private $surname;
    private $bio;

    public function getName()
    {
        return $this->name;
    }

    public function getSurname()
    {
        return $this->surname;
    }

    public function getBio()
    {
        return $this->bio;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    public function setBio($bio)
    {
        $this->bio = $bio;
    }

    private function setMessage($message, $type)
    {
        $_SESSION['message'] = [
            'content' => $message,
            'type' => $type,
        ];
    }

    public function selectAllAuthors()
    {
        $pdo = DB::connect();
        $sql = "SELECT * FROM author WHERE is_deleted = :is_deleted";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['is_deleted' => false]);
        return $stmt->fetchAll();
    }

    public function addAuthor($params)
    {
        $pdo = DB::connect();
        $params['name'] = ucfirst($params['name']);
        $params['surname'] = ucfirst($params['surname']);
        $params['bio'] = ucfirst($params['bio']);
        $existingAuthors = $this->selectAllAuthors();
        foreach ($existingAuthors as $existingAuthor) {
            if (strtolower($existingAuthor['name']) === strtolower($params['name']) && strtolower($existingAuthor['surname']) === strtolower($params['surname'])) {
                $this->setMessage('Author with this name and surname already exists', 'warning');
                return;
            }
        }
        $sql = "INSERT INTO author (name, surname, bio) VALUES (:name, :surname, :bio)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute($params)) {
            $this->setMessage('Author successfully added', 'success');
        } else {
            $this->setMessage('Something went wrong.', 'danger');
        }
    }

    public function editAuthor($id)
    {
        $pdo = DB::connect();
        $this->name = ucfirst($this->name);
        $this->surname = ucfirst($this->surname);
        $this->bio = ucfirst($this->bio);
        $existingAuthors = $this->selectAllAuthors();
        foreach ($existingAuthors as $existingAuthor) {
            if ($existingAuthor['id'] != $id && strtolower($existingAuthor['name']) === strtolower($this->name) && strtolower($existingAuthor['surname']) === strtolower($this->surname)) {
                $this->setMessage('Author with this name and surname already exists', 'warning');
                return;
            }
        }
        $sql = 'UPDATE author SET name = :name, surname = :surname, bio = :bio WHERE id = :id';
        $stmt = $pdo->prepare($sql);
        $params = [
            'name' => $this->name,
            'surname' => $this->surname,
            'bio' => $this->bio,
            'id' => $id
        ];
        if ($stmt->execute($params)) {
            $this->setMessage('Author successfully updated', 'success');
        } else {
            $this->setMessage('Something went wrong', 'danger');
        }
    }

    public function deleteAuthor($id) {
        $pdo = DB::connect();
        $sql = "UPDATE author SET is_deleted = true WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute(['id' => $id])) {
            $this->setMessage('Author successfully marked as deleted', 'success');
        } else {
            $this->setMessage('Something went wrong.', 'danger');
        }
    }
}
