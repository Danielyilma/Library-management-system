<?php

require 'Core/container.php';

Container::bind('db', function (){
    $config = require 'Core/config.php';
    $connection = new Database($config);

    return $connection;
});

