<?php

class Book {
    public $id = NULL;
    public $title = NULL;
    public $author = NULL;
    public $poster = NULL;
    public $amount = NULL;
    public $genre = NULL;

    public function __construct($title = NULL, $author = NULL, $poster = NULL, $amount = NULL, $genre = null) {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->poster = $poster;
        $this->amount = $amount;
        $this->genre = $genre;
    }

    public function store($conn){
        $query = 'INSERT INTO book (title, author, poster, amount, available, genre) value (:title, :author, :poster, :amount, :available, :genre)';
        $conn->query($query, [
            'title' => $this->title,
            'author' => $this->author,
            'poster' => $this->poster,
            'amount' => $this->amount,
            "available" => $this->amount,
            "genre" => $this->genre
        ]); 
    }

    public function update($conn) {
        $query = 'UPDATE books set title = :title, author = :author, poster = :poster, amount = :amount ordered by title';
        $conn->query($query, [
            'title' => $this->title,
            'author' => $this->author,
            'poster' => $this->poster,
            'amount' => $this->amount
        ]); 
    }

    public static function get_books($conn) {
        $query = 'SELECT * FROM book ORDER BY title ASC';
        $stmt = $conn->query($query, []);
        return $stmt->fetchall();
    }

    public static function search($conn, $string) {
        $query = "SELECT * FROM book WHERE title LIKE :query OR author LIKE :query OR id LIKE :query ORDER BY title ASC";
        $stmt = $conn->query($query, [
            'query' => '%' . $string . '%',
            'query' => '%' . $string . '%',
            'query' => '%' . $string . '%',
        ]);

        return $stmt->fetchall();
    }

    public static function borrow($conn, $title, $author, $user_email, $return_date){
        if (strtotime($return_date) < strtotime(Date("Y-m-d"))) {
            return "return date must be in future";
        }

        $query = "SELECT * FROM book WHERE title =:title or author=:author";

        $stmt = $conn->query($query, [
            'title' => $title,
            'author' => $author,
        ]);
        
        $book = $stmt->fetch();

        if ($book == FALSE) {
            return "book not found";
        }


        if ($book['available'] < 1) {
            return "book not available";
        }

        $query2 = "SELECT * FROM users WHERE email =:email";

        $stmt = $conn->query($query2, ["email" => $user_email]);
        $user = $stmt->fetch();

        if ($user == FALSE) {
            return "user not found";
        }
        
        $query3 = "INSERT INTO borrow (user_id, book_id, borrow_date, return_date) 
        VALUES (:user_id, :book_id, :borrow_date, :return_date)";

        $borrowDate = date("Y-m-d");

        $stmt = $conn->query($query3, [
            "user_id" => $user["id"],
            "book_id" => $book["id"],
            "borrow_date" => $borrowDate,
            "return_date" => date($return_date)
        ]);

        $book['available'] -= 1;
        $conn->query("UPDATE book SET available=:available WHERE id=:id", ["available" => $book['available'], "id" => $book['id']]);

        require "mail.php";
        $mail = new Mail();
        $mail->sender("daniel.yilma@aastustudent.edu.et", "12345678");
        $mail->reciever($user_email);

        $mail->borrow_mail($user, [
            "title" => $title,
            "BDate" => $borrowDate,
            "RDate" => $return_date
        ]);

        $mail->send();
    }

    public static function get_borrows($conn){
        $query = 'SELECT * FROM borrow ORDER BY borrow_date ASC';
        $query2 = "SELECT * FROM users WHERE id=:id";
        $query3 = "SELECT * FROM book WHERE id=:id";
    
        $stmt = $conn->query($query, []);
        $borrows = $stmt->fetchall();

        foreach ($borrows as &$borrow) {
            $borrow['user'] = $conn->query($query2, ["id" => $borrow['user_id']])->fetch();
            $borrow['book'] = $conn->query($query3, ["id" => $borrow['book_id']])->fetch();
        }
        return $borrows;
    }

    public static function return_book($conn, $id) {
        $query = "SELECT * FROM borrow WHERE id=:id";
        $query2 = "SELECT * FROM users WHERE id =:id";
        $query3 = "SELECT * FROM book WHERE id=:id";

        $borrow = $conn->query($query, ["id" => $id])->fetch();
        if ($borrow == FALSE) {
            return "book not found";
        }

        $user = $conn->query($query2, ["id" => $borrow['user_id']])->fetch();
        $book = $conn->query($query3, ["id" => $borrow['book_id']])->fetch();

        $query4 = 'DELETE FROM borrow WHERE id =:id';
        $stmt = $conn->query($query4, ["id" => $id]);

        $book['available'] += 1;
        $conn->query("UPDATE book SET available=:available WHERE id=:id", ["available" => $book['available'], "id" => $book['id']]);

        require "mail.php";
        $mail = new Mail();
        $mail->sender("daniel.yilma@aastustudent.edu.et", "12345678");
        $mail->reciever($user['email']);

        $mail->return_mail($user, [
            "title" => $book['title'],
            "RDate" => $borrow['return_date']
        ]);

        $mail->send();

        return $stmt;
    }

    public static function search_record($conn, $constraint) {
        $query = "SELECT * FROM users WHERE full_name LIKE :full_name or email LIKE :email";
        $query2 = "SELECT * FROM borrow WHERE user_id=:user_id";
        $query3 = "SELECT * FROM book WHERE id=:id";
        $constraint = '%' . $constraint . '%';
        $user = $conn->query($query, [
            'full_name' => $constraint,
            "email" => $constraint
        ])->fetch();
        
        $id = $user["id"];
        $borrows = $conn->query($query2, ["user_id" => $id])->fetchall();


        foreach ($borrows as &$borrow) {
            $borrow['user'] = $user;
            $borrow['book'] = $conn->query($query3, ["id" => $borrow['book_id']])->fetch();
        }
        return $borrows;
    }

    public static function overdue_borrows($conn) {
        $query = "SELECT users.full_name, users.email, book.title, book.author, borrow.borrow_date, borrow.return_date FROM 
        users join borrow on borrow.user_id = users.id join book on borrow.book_id = book.id WHERE borrow.return_date < CURDATE();
        ";

        return $conn->query($query, [])->fetchall();
    }
}