<?php
class Category
{

    private $title;

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    private function setMessage($message, $type)
    {
        $_SESSION['message'] = [
            'content' => $message,
            'type' => $type,
        ];
    }

    public function selectAllCategories()
    {

        $pdo = DB::connect();

        $sql = "SELECT * FROM category WHERE is_deleted = :is_deleted";

        $stmt = $pdo->prepare($sql);

        $stmt->execute(['is_deleted' => false]);

        return $stmt->fetchAll();
    }

    public function updateCategory($id)
    {
        $pdo = DB::connect();
    
        $this->title = ucfirst($this->title);
    
        $existingCategories = $this->selectAllCategories();
    
        foreach ($existingCategories as $existingCategory) {
            if ($existingCategory['id'] != $id && strtolower($existingCategory['title']) === strtolower($this->title)) {
                $this->setMessage('Category with this title already exists', 'warning');
                return;
            }
        }
    
        $sql = 'UPDATE category SET title = :title WHERE id = :id';
    
        $stmt = $pdo->prepare($sql);
    
        $params = [
            'title' => $this->title,
            'id' => $id
        ];
    
        if ($stmt->execute($params)) {
            $this->setMessage('Category successfully updated', 'success');
        } else {
            $this->setMessage('Something went wrong', 'danger');
        }
    }

    public function addCategory($title)
    {
        $pdo = DB::connect();
    
        $title = ucfirst($title);
    
        $existingCategories = $this->selectAllCategories();
    
        foreach ($existingCategories as $existingCategory) {
            if (strtolower($existingCategory['title']) === strtolower($title)) {
                $this->setMessage('Category with this title already exists', 'warning');
                return;
            }
        }
    
        $sql = "INSERT INTO category (title) VALUES (:title)";
    
        $stmt = $pdo->prepare($sql);
    
        if ($stmt->execute(['title' => $title])) {
            $this->setMessage('Category successfully added', 'success');
        } else {
            $this->setMessage('Something went wrong.', 'danger');
        }
    }

    public function deleteCategory($id)
    {
        $pdo = DB::connect();

        $sql = "UPDATE category SET is_deleted = true WHERE id = :id";

        $stmt = $pdo->prepare($sql);

        if ($stmt->execute(['id' => $id])) {
            $this->setMessage('Category successfully marked as deleted', 'success');
        } else {
            $this->setMessage('Something went wrong.', 'danger');
        }
    }
}
