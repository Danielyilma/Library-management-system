<?php

class Book {
    public $id = NULL;
    public $title = NULL;
    public $author = NULL;
    public $poster = NULL;
    public $amount = NULL;

    public function __construct($title = NULL, $author = NULL, $poster = NULL, $amount = NULL) {
        $this->id = $id;
        $this->title = $title;
        $this->author = $author;
        $this->poster = $poster;
        $this->amount = $amount;
    }

    public function store($conn){
        $query = 'INSERT INTO book (title, author, poster, amount) value (:title, :author, :poster, :amount)';
        $conn->query($query, [
            'title' => $this->title,
            'author' => $this->author,
            'poster' => $this->poster,
            'amount' => $this->amount
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
        $query = "SELECT * FROM book WHERE title =:title or author=:author";

        $stmt = $conn->query($query, [
            'title' => $title,
            'author' => $author,
        ]);
        
        $book = $stmt->fetch();

        if ($book == FALSE) {
            return "book not found";
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

        require "mail.php";
        $mail = new Mail();
        $mail->sender("daniel.yilma@aastustudent.edu.et", "12345678");
        $mail->reciever("deathland2352@gmail.com");

        $mail->borrow_mail($user, [
            "title" => $title,
            "BDate" => $borrowDate,
            "RDate" => $return_date
        ]);

        $mail->send();
    }

    public static function get_borrows($conn){
        $query = 'SELECT * FROM borrow ORDER BY borrow_date ASC';
        $stmt = $conn->query($query, []);
        return $stmt->fetchall();
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

        require "mail.php";
        $mail = new Mail();
        $mail->sender("daniel.yilma@aastustudent.edu.et", "12345678");
        $mail->reciever("deathland2352@gmail.com");

        $mail->return_mail($user, [
            "title" => $book['title'],
            "RDate" => $borrow['return_date']
        ]);

        $mail->send();

        return $stmt;
    }
}