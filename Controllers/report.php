<?php

require "models/book.php";
$config = require 'Core/config.php';
$conn = new Database($config);

$borrows = Book::get_borrows($conn);
$overdueBorrrow = Book::overdue_borrows($conn);

$query = "SELECT book.id, book.title, book.author, COUNT(borrow.id) AS borrow_count,
    (book.amount - COUNT(borrow.id)) AS available_count FROM book LEFT JOIN
     borrow ON book.id = borrow.book_id GROUP BY book.id, book.title, book.author, book.amount 
     ORDER BY book.title;";

$books = $conn->query($query, [])->fetchall();




require "views/report.php";