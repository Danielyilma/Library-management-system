<?php
try {

    $dsn = "mysql:host=localhost;port=3306;dbname=book;charset=utf8mb4";
    $username = "root";
    $password = "MYSQLRoot1)0";


    $pdo = new PDO($dsn, $username, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //fetch all books
    $bookdata = $pdo->prepare("SELECT * FROM book");
    $bookdata->execute();
    $bookobj = $bookdata->fetchAll(PDO::FETCH_ASSOC);


    // var_dump($bookobj); //checking if it works



    // Get search query
    // $query = "dani";  //checking

    $query = trim($_GET['query']);
    $query = filter_var($query, FILTER_SANITIZE_STRING);

    if ($query) {
        // Search the database
        $stmt = $pdo->prepare("SELECT * FROM book WHERE bookname LIKE '%$query%' OR bookauthor LIKE '%$query%' OR bookid LIKE '%$query%'");

        $stmt->execute();

        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        $result = null;
    }


    // var_dump($result);

} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
