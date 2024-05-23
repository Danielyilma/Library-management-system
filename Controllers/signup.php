<?php


$config = require 'Core/config.php';
$connection = new Database($config);

$error = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = htmlentities($_POST['name']);
    $email = htmlentities($_POST['email']);
    $phone_number = htmlentities($_POST['phone_number']);
    $password = htmlentities($_POST['password']);

    if (empty($name) && !filter_var($name, FILTER_SANITIZE_STRING)){
        $error['name'] = 'Name should only contain one or more string character';
    }

    if (empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error['email'] = 'Wrong email, please provide approprate email address';
    }

    if (empty($phone_number) && preg_match('/^\d+$/', $phone_number)){
        $error['phone'] = 'phone number must be digits';
    }

    if (empty($password)){
        $error['password'] = 'password field is required';
    }

    // dprint(empty($error));
    if (empty($error)){
        $query = 'INSERT INTO users (full_name, email, phone_number, password) VALUES (:name, :email, :phone_no, :password)';
        $connection->query($query, [
            'name' => $name,
            'email' => $email,
            'phone_no' => $phone_number,
            'password' => password_hash($password, PASSWORD_BCRYPT)
        ]);
        header("Location: /login");
        exit();
    }
}



require 'views/signup.php';
