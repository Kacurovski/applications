<?php
class Comment
{
    private $content;

    public function getContent()
    {
        return $this->content;
    }

    public function setTitle($content)
    {
        $this->content = $content;
    }


    public function selectAllCommentsForSingleBook($book_id)
    {
        $pdo = DB::connect();

        $sql = "SELECT bc.*, c.content, c.created_at,
                       book.title AS book_title, 
                       book.year_of_issue AS book_year,
                       book.number_of_pages AS book_pages,
                       book.image AS book_image,
                       CONCAT(author.name, ' ', author.surname) AS author_name,
                       category.title AS category_title
                FROM book_comment bc
                JOIN comment c ON bc.comment_id = c.id
                JOIN book ON bc.book_id = book.id
                JOIN author ON book.author_id = author.id
                JOIN category ON book.category_id = category.id
                WHERE bc.book_id = :book_id";

        $stmt = $pdo->prepare($sql);

        $stmt->execute(['book_id' => $book_id]);

        return $stmt->fetchAll();
    }

    public function selectApprovedCommentsForSingleBook($book_id, $user_id = null)
    {
        $pdo = DB::connect();

        $sql = "SELECT bc.*, c.content, u.name AS user_name, u.surname AS user_surname
                FROM book_comment bc
                JOIN comment c ON bc.comment_id = c.id
                LEFT JOIN user u ON bc.user_id = u.id
                WHERE (bc.is_approved = :is_approved";

        $params = ['is_approved' => true, 'book_id' => $book_id];

        if ($user_id !== null) {
            $sql .= " OR bc.user_id = :user_id";
            $params['user_id'] = $user_id;
        }

        $sql .= ") AND bc.book_id = :book_id";

        $stmt = $pdo->prepare($sql);

        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    public function addComment($content)
    {
        $pdo = DB::connect();

        $sql = "INSERT INTO comment (content) VALUES (:content)";

        $stmt = $pdo->prepare($sql);

        if ($stmt->execute(['content' => $content])) {
            $last_inserted_id = $pdo->lastInsertId();
            $_SESSION['message'] = ['content' => 'Comment successfully added', 'type' => 'success'];
            return $last_inserted_id;
        } else {
            $_SESSION['message'] = ['content' => 'Something went wrong.', 'type' => 'danger'];
            return false;
        }
    }

    public function addCommentToPivotTable($book_id, $comment_id, $user_id)
    {
        $pdo = DB::connect();

        $sql = "INSERT INTO book_comment (book_id, comment_id, user_id) VALUES (:book_id, :comment_id, :user_id)";

        $stmt = $pdo->prepare($sql);

        if ($stmt->execute(['book_id' => $book_id, 'comment_id' => $comment_id, 'user_id' => $user_id])) {
            $_SESSION['message'] = ['content' => 'Comment for the book successfully added', 'type' => 'success'];
            return true;
        } else {
            $_SESSION['message'] = ['content' => 'Something went wrong.', 'type' => 'danger'];
            return false;
        };
    }

    public function deleteComment($id)
    {
        $pdo = DB::connect();
    
        $sqlFetchBookComment = "SELECT * FROM book_comment WHERE comment_id = :id";
        $stmtFetchBookComment = $pdo->prepare($sqlFetchBookComment);
        $stmtFetchBookComment->execute(['id' => $id]);
        $bookCommentRow = $stmtFetchBookComment->fetch(PDO::FETCH_ASSOC);
    
        $sqlDeleteComment = "DELETE FROM comment WHERE id=:id";
        $stmtDeleteComment = $pdo->prepare($sqlDeleteComment);
    
        $sqlDeleteBookComment = "DELETE FROM book_comment WHERE comment_id = :id";
        $stmtDeleteBookComment = $pdo->prepare($sqlDeleteBookComment);
    
        try {
            $pdo->beginTransaction();
    
            $stmtDeleteComment->execute(['id' => $id]);
    
            if ($bookCommentRow) {
                $stmtDeleteBookComment->execute(['id' => $bookCommentRow['comment_id']]);
            }
    
            $pdo->commit();
    
            $_SESSION['message'] = ['content' => 'Comment and related records successfully deleted', 'type' => 'success'];
            return true;
        } catch (Exception $e) {
            $pdo->rollBack();
    
            $_SESSION['message'] = ['content' => 'Something went wrong: ' . $e->getMessage(), 'type' => 'danger'];
            return false;
        }
    }

    public function hasUserCommentedOnBook($user_id, $book_id)
    {
        $pdo = DB::connect();

        $sql = "SELECT COUNT(*) FROM book_comment WHERE user_id = :user_id AND book_id = :book_id";

        $stmt = $pdo->prepare($sql);

        $stmt->execute(['user_id' => $user_id, 'book_id' => $book_id]);

        $count = $stmt->fetchColumn();

        return $count > 0;
    }

    public function handleComment($comment_id, $action)
    {
        $pdo = DB::connect();

        $approved = ($action === 'approve') ? true : false;

        $is_new = false;

        $sql = "UPDATE book_comment 
                SET is_approved = :approved, is_new = :is_new 
                WHERE comment_id = :comment_id";

        $stmt = $pdo->prepare($sql);

        if ($stmt->execute(['comment_id' => $comment_id, 'approved' => $approved, 'is_new' => $is_new])) {
            $message = ($approved)
                ? '<div class="alert alert-success mt-3 h5 mb-3 w-50 m-auto"><p class="text-center m-0">Comment Successfully Approved</p></div>'
                : '<div class="alert alert-success mt-3 h5 mb-3 w-50 m-auto"><p class="text-center m-0">Comment Successfully Declined</p></div>';
        } else {
            $message = '<div class="alert alert-danger mt-3 h5 mb-3 w-50 m-auto"><p class="text-center m-0">Something went wrong.</p></div>';
        }

        return $_SESSION['message'] = $message;
    }
}
