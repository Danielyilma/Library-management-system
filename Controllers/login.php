<?php

$config = require 'Core/config.php';
$connection = new Database($config);


if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    $email = htmlentities($_POST['email']);
    $password = htmlentities($_POST['password']);


    $query = 'select * from users where email = :email';
    $user = $connection->query($query, ['email' => $email])->fetch();

    if (password_verify($password, $user['password'])) {
        login($user);
        header("Location: /");
        exit();
    }
    
}

require 'views/login.php';

