<?php

require 'models/book.php';


$config = require 'Core/config.php';
$connection = new Database($config);



if (isset($_GET['query'])) {
    $search_string = htmlentities($_GET['query']);
    $books = Book::search($connection, $search_string);
} else {
    $books = Book::get_books($connection);
}



require 'views/home.php';