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
        $query = 'UPDATE books set title = :title, author = :author, poster = :poster, amount = :amount';
        $conn->query($query, [
            'title' => $this->title,
            'author' => $this->author,
            'poster' => $this->poster,
            'amount' => $this->amount
        ]); 
    }

    public static function get_books($conn) {
        $query = 'SELECT * FROM book';
        $stmt = $conn->query($query, []);
        return $stmt->fetchall();
    }

    public static function search($conn, $string) {
        $query = "SELECT * FROM book WHERE title LIKE :query OR author LIKE :query OR id LIKE :query";
        $stmt = $conn->query($query, [
            'query' => '%' . $string . '%',
            'query' => '%' . $string . '%',
            'query' => '%' . $string . '%'
        ]);

        return $stmt->fetchall();
    }

}