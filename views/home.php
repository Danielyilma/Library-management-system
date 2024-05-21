<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link rel="stylesheet" href="css/homesty.css">
</head>

<body>
    <?php require "partials/header.php" ?>

    <section id="search">
        <h2>Search for Books</h2>
        <form action="searchview.php" method="get">
            <input type="text" name="query" id="sinput" placeholder="Search by title, author, or ISBN">
            <button type="submit">Search</button>
        </form>
    </section>


    <?php require "partials/footer.php" ?>

</body>

</html>