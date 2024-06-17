<?php

require 'models/book.php';


$config = require 'Core/config.php';
$connection = new Database($config);



if (isset($_GET['query'])) {
    $search_string = htmlentities($_GET['query']);
    $filter = htmlentities($_GET['filter']);
    $books = Book::search($connection, $search_string);
} else if (isset($_GET['genre'])) {
    $genre = htmlentities($_GET['genre']);
    $query = "SELECT * FROM book WHERE genre =:genre";
    $books = $connection->query($query, ["genre" => $genre])->fetchall();
} else {
    $books = Book::get_books($connection);
}



require 'views/home.php';