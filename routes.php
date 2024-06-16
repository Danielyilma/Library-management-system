<?php

$config = require 'Core/config.php';
$connection = new Database($config);


$routes = new Route();
// dprint($connection);


// routes for get method
$routes->get('/', 'Controllers/home.php');
$routes->get('/login', 'Controllers/login.php')->access('guest');
$routes->get('/signup', 'Controllers/signup.php')->access('guest');
$routes->get('/logout', 'Controllers/logout.php')->access('auth');
$routes->get('/book', 'Controllers/book.php')->access('auth');
$routes->get('/borrow', 'Controllers/borrow.php')->access('auth');
$routes->get('/borrow_record', 'Controllers/borrow_records.php')->access('auth');
$routes->get('/reset_password', 'Controllers/forgot_password.php')->access("guest");
// $routes->get('/search', 'views/searchview.php');

// routes for post method
$routes->post('/login', 'Controllers/login.php')->access('guest');
$routes->post('/signup', 'Controllers/signup.php')->access('guest');
$routes->post('/book', 'Controllers/book.php')->access('auth');
$routes->post('/borrow', 'Controllers/borrow.php')->access('auth');
$routes->post('/borrow_record', 'Controllers/borrow_records.php')->access('auth');
$routes->post('/reset_password', 'Controllers/forgot_password.php')->access("guest");

// routes for put method

// routes for delete method
$routes->delete("/borrow", 'Controllers/borrow.php')->access('auth');


$url = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes->route($url);
