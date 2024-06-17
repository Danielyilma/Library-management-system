<?php

$config = require 'Core/config.php';
$conn = new Database($config);

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    require "generate_report.php";

    $report = new Report();
    $query = "SELECT users.full_name, users.email, book.title, borrow.borrow_date, borrow.return_date FROM 
    borrow JOIN users ON borrow.user_id = users.id JOIN book ON borrow.book_id = book.id";
    
    $report->generateSection($conn, "List of Borrowed Books", $query, [
        "borrower name", "Email", "book title", "Borrow date", "Return Date"
    ], 40);

    $query2 = "SELECT users.full_name, users.email, book.title, borrow.borrow_date, borrow.return_date FROM 
        users join borrow on borrow.user_id = users.id join book on borrow.book_id = book.id WHERE borrow.return_date < CURDATE();
        ";
    $report->generateSection($conn, "List of Overdue Books", $query2, [
        "borrower name", "Email", "book title", "Borrow date", "Return Date"
    ], 40);

    $query3 = "SELECT book.title, book.author, COUNT(borrow.id) AS borrow_count,
    (book.amount - COUNT(borrow.id)) AS available_count FROM book LEFT JOIN
     borrow ON book.id = borrow.book_id GROUP BY book.id, book.title, book.author, book.amount 
     ORDER BY book.title;";

    $report->generateSection($conn, "Book Inventory", $query3, [
        "Book Title", "Author", "Borrowed Count", "Available Count"
    ], 50);

    $report->output("library_report.pdf");

} else {
    $filename = "library_report.pdf";
    $filepath = $_SERVER['DOCUMENT_ROOT'] . "/views/static/reports/" . $filename;
    
    if (file_exists($filepath)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . basename($filepath) . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));
        readfile($filepath);
    }
}

Header("Location: /report");