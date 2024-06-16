<?php

require "models/book.php";
$message = array();
$error = array();
$config = require 'Core/config.php';
$conn = new Database($config);

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    
    if (isset($_POST["_method"])) {
        $id = $_POST['id'];
        Book::return_book($conn, $id);

        // require "models/borrow.php";
        Header("Location: /borrow");
        exit();
    }

    $user_email = $_POST['email'];
    $book_title = $_POST['book_title'];
    $book_author = $_POST['book_author'];
    $return_date = $_POST["return_date"];


    //validation and sanitization goes here

    $status = Book::borrow($conn, $book_title, $book_author, $user_email, $return_date);
    
    if ($status){
        $error["borrow"] = $status;
    }
    else {
        $message["borrow"] = "borrowing successfull";
    }

    dprint($error["borrow"] ?? $message["borrow"]);
} else {
    // $books = Book::get_borrows($conn);
    // dprint($books);
}

require "models/borrow.php";