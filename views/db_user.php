<?php
$servername = "localhost";
$username = "root";
$password = "MYSQLRoot1)0";
$dbname = "book";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

var_dump($conn);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
