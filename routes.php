<?php

require 'Core/container.php';

$config = require 'Core/config.php';
$connection = new Database($config);

$routes = new Route();
// dprint($connection);


// routes for get method
$routes->get('/', 'Controllers/home.php');
$routes->get('/login', 'Controllers/login.php');
$routes->get('/signup', 'Controllers/signup.php')->access('guest');
$routes->get('/logout', 'Controllers/logout.php')->access('guest');
$routes->get('/book', 'Controllers/book.php')->access('auth');
// $routes->get('/search', 'views/searchview.php');

// routes for post method
$routes->post('/login', 'Controllers/login.php')->access('guest');
$routes->post('/signup', 'Controllers/signup.php')->access('guest');
$routes->post('/book', 'Controllers/book.php')->access('auth');

// routes for put method

// routes for delete method


$url = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes->route($url);
