<?php

require "models/book.php";
$config = require 'Core/config.php';
$conn = new Database($config);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id = $_POST['id'];
    Book::return_book($conn, $id);

    // require "models/borrow.php";
    Header("Location: /borrow_record");
    exit();

} else {
    if (isset($_GET["search"])) {
        $query = $_GET['query'];
        $borrows = Book::search_record($conn, $query);
    } else {
        $borrows = Book::get_borrows($conn);
    }
}




require "views/borrow_records.php";