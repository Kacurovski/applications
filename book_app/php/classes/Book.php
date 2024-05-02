<?php
class Book
{
    private $title;
    private $author_id;
    private $year_of_issue;
    private $number_of_pages;
    private $category_id;
    private $image;

    public function getTitle()
    {
        return $this->title;
    }

    public function getAuthorId()
    {
        return $this->author_id;
    }

    public function getYearOfIssue()
    {
        return $this->year_of_issue;
    }

    public function getNumberOfPages()
    {
        return $this->number_of_pages;
    }

    public function getCategoryId()
    {
        return $this->category_id;
    }

    public function getImage()
    {
        return $this->image;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setAuthorId($author_id)
    {
        $this->author_id = $author_id;
    }

    public function setYearOfIssue($year_of_issue)
    {
        $this->year_of_issue = $year_of_issue;
    }

    public function setNumberOfPages($number_of_pages)
    {
        $this->number_of_pages = $number_of_pages;
    }

    public function setCategoryId($category_id)
    {
        $this->category_id = $category_id;
    }

    public function setImage($image)
    {
        $this->image = $image;
    }

    private function setMessage($message, $type)
    {
        $_SESSION['message'] = [
            'content' => $message,
            'type' => $type,
        ];
    }

    public function selectAllBooks()
    {
        $pdo = DB::connect();

        $sql = "SELECT 
        book.id as book_id,
        book.title as book_title,
        book.image as book_image,
        book.number_of_pages as book_pages,
        book.year_of_issue as book_year,
        CONCAT(author.name, ' ', author.surname) as author_name,
        category.title as category_title,
        book.author_id as author_id,
        book.category_id as category_id
    FROM 
        book
    JOIN 
        author ON book.author_id = author.id
    JOIN 
        category ON book.category_id = category.id
    WHERE 
        book.is_deleted = :is_deleted";

        $stmt = $pdo->prepare($sql);

        $stmt->execute(['is_deleted' => false]);

        return $stmt->fetchAll();
    }

    public function selectSingleBook($id)
    {
        $pdo = DB::connect();

        $sql = 'SELECT 
        book.id as book_id,
        book.title as book_title,
        book.image as book_image,
        book.number_of_pages as book_pages,
        book.year_of_issue as book_year,
        CONCAT(author.name, " ", author.surname) as author_name,
        author.bio as author_bio,
        category.title as category_title
    FROM 
        book
    JOIN 
        author ON book.author_id = author.id
    JOIN 
        category ON book.category_id = category.id
    WHERE 
        book.id = :id';

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function addBook($params)
    {
        $pdo = DB::connect();
    
        $params['title'] = ucfirst($params['title']);
    
        $existingBooks = $this->selectAllBooks();
    
        foreach ($existingBooks as $existingBook) {
            if (strtolower($existingBook['book_title']) === strtolower($params['title'])) {
                $this->setMessage('Book with this title already exists', 'warning');
                return;
            }
        }
    
        $sql = "INSERT INTO book (title, author_id, year_of_issue, number_of_pages, category_id, image) VALUES (:title, :author_id, :year_of_issue, :number_of_pages, :category_id, :image)";
    
        $stmt = $pdo->prepare($sql);
    
        if ($stmt->execute($params)) {
            $this->setMessage('Book successfully added', 'success');
        } else {
            $this->setMessage('Something went wrong.', 'danger');
        };
    }
    

    public function editBook($id)
    {
        $pdo = DB::connect();
    
        $this->title = ucfirst($this->title);
    
        $existingBooks = $this->selectAllBooks();
    
        foreach ($existingBooks as $existingBook) {
            if ($existingBook['book_id'] != $id && strtolower($existingBook['book_title']) === strtolower($this->title)) {
                $this->setMessage('Book with this title already exists', 'warning');
                return;
            }
        }
    
        $sql = 'UPDATE book SET title = :title, author_id = :author_id, year_of_issue = :year_of_issue, number_of_pages = :number_of_pages, category_id = :category_id, image = :image WHERE id = :id';
    
        $stmt = $pdo->prepare($sql);
    
        $params = [
            'title' => $this->title,
            'author_id' => $this->author_id,
            'year_of_issue' => $this->year_of_issue,
            'number_of_pages' => $this->number_of_pages,
            'category_id' => $this->category_id,
            'image' => $this->image,
            'id' => $id
        ];
    
        if ($stmt->execute($params)) {
            $this->setMessage('Book successfully updated', 'success');
        } else {
            $this->setMessage('Something went wrong', 'danger');
        };
    }

    public function deleteBook($id)
    {
        $pdo = DB::connect();
    
        $sqlFetchCommentIds = "SELECT comment_id FROM book_comment WHERE book_id = :id";
        $stmtFetchCommentIds = $pdo->prepare($sqlFetchCommentIds);
        $stmtFetchCommentIds->execute(['id' => $id]);
        $commentIds = $stmtFetchCommentIds->fetchAll(PDO::FETCH_COLUMN);
    
        $sqlDeletePrivateNotes = "DELETE FROM private_notes WHERE book_id = :id";
        $stmtDeletePrivateNotes = $pdo->prepare($sqlDeletePrivateNotes);
    
        $sqlDeleteBookComments = "DELETE FROM book_comment WHERE book_id = :id";
        $stmtDeleteBookComments = $pdo->prepare($sqlDeleteBookComments);
    
        $sqlDeleteComments = "DELETE FROM comment WHERE id IN (" . implode(',', array_fill(0, count($commentIds), '?')) . ")";
        $stmtDeleteComments = $pdo->prepare($sqlDeleteComments);
    
        $sqlUpdateBook = "UPDATE book SET is_deleted = true WHERE id = :id";
        $stmtUpdateBook = $pdo->prepare($sqlUpdateBook);
    
        try {
            $pdo->beginTransaction();
    
            $stmtDeletePrivateNotes->execute(['id' => $id]);
            $stmtDeleteBookComments->execute(['id' => $id]);
    
            if (!empty($commentIds)) {
                $stmtDeleteComments->execute($commentIds);
            }
    
            $stmtUpdateBook->execute(['id' => $id]);
    
            $pdo->commit();
    
            $this->setMessage('Book and related records successfully deleted', 'success');
        } catch (Exception $e) {
            $pdo->rollBack();
    
            $this->setMessage('Something went wrong: ' . $e->getMessage(), 'danger');
        }
    }
    
    public function selectPrivateNotes($book_id, $user_id)
    {
        $pdo = DB::connect();

        $sql = 'SELECT
            private_notes.id as note_id,
            private_notes.note_text,      
            book.id as book_id,
            user.id as user_id
        FROM
            private_notes
        INNER JOIN
            book ON private_notes.book_id = book.id
        INNER JOIN
            user ON private_notes.user_id = user.id
        WHERE
            book.id = :book_id
        AND
            user.id = :user_id';

        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            'book_id' => $book_id,
            'user_id' => $user_id,
        ]);
        return $stmt->fetchAll();
    }

    public function addPrivateNote($user_id, $book_id, $note_text)
    {
        $pdo = DB::connect();

        $sql = 'INSERT INTO private_notes (book_id, user_id, note_text) VALUES (:book_id, :user_id, :note_text)';

        $stmt = $pdo->prepare($sql);

        $params = [
            'book_id' => $book_id,
            'user_id' => $user_id,
            'note_text' => $note_text,
        ];

        if ($stmt->execute($params)) {
            return $pdo->lastInsertId();
        } else {
            return false;
        }
    }


    public function updatePrivateNotes($note_text, $id)
    {

        $pdo = DB::connect();

        $sql = 'UPDATE private_notes SET note_text = :note_text WHERE id = :id';

        $stmt = $pdo->prepare($sql);

        $params = [
            'note_text' => $note_text,
            'id' => $id
        ];

        if ($stmt->execute($params)) {               
            return true;      
        } else {
            return false;
        }
    }

    public function deletePrivateNotes($id)
    {
        $pdo = DB::connect();

        $sql = 'DELETE FROM private_notes WHERE id = :id';

        $stmt = $pdo->prepare($sql);

        if ($stmt->execute(['id' => $id])) {            
            return true;
        } else {            
            return false;
        }
    }
}
?>
