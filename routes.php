<?php

$routes = new Route();

// routes for get method
$routes->get('/', 'controllers/home.php');
$routes->get('/login', 'controllers/login.php');
$routes->get('/signup', 'controllers/signup.php');

// routes for post method
$routes->post('/login', 'controllers/login.php');

// routes for put method

// routes for delete method


$url = parse_url($_SERVER['REQUEST_URI'])['path'];

$routes->route($url);
