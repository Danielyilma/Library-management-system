<?php

require 'models/book.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $config = require 'Core/config.php';
    $connection = new Database($config);

    $title = $_POST['btitle'];
    $author = $_POST['bauthor'];
    $poster = upload($_FILES['bpicture'], 'views/static/images/');
    $amount = $_POST['bamount'];

    $book = new Book($title, $author, $poster, $amount);

    $book->store($connection);
    Header("Location: /");
}
require 'views/addbook.php';