<?php

require 'Core/Route.php';
require 'Core/Database.php';
require 'Core/Middleware/Auth.php';
require 'Core/Middleware/Guest.php';


function dprint($vara) {
    echo "<pre>";
    var_dump($vara);
    echo "</pre>";
    die();
}

function login($user) {
    $_SESSION['user'] = $user;
    session_regenerate_id(true);
}

function logout(){
    session_unset();
    session_destroy();
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

function upload($file, $path){
    $filename = $path . uniqid() . $file['name'];
    move_uploaded_file($file['tmp_name'], $filename);
    return $filename;
}