<?php

require 'Route.php';

function dprint($vara) {
    echo "<pre>";
    var_dump($vara);
    echo "</pre>";
    die();
}