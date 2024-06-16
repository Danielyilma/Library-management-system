<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link rel="stylesheet" href="views/static/css/addbook.css">
</head>

<body>
    <?php require "partials/header.php" ?>

    <!-- the id are not changed so it can use the same styling -->
    <section id="addbook">
        <h2>Borrow Book</h2>
        <form action="" method="post">
            <label for="email">Customer Email</label>
            <input type="text" name="email" id="email" placeholder="">
            <label for="book_title"> Book Title</label>
            <input type="text" name="book_title" id="book_title" placeholder="">
            <label for="book_author"> Author</label>
            <input type="text" name="book_author" id="book_author" placeholder="">
            <label for="return_date"> Return Date</label>
            <input type="text" name="return_date" id="return_date" placeholder="">

            <button type="submit">Borrow Book</button>
        </form>
    </section>


    <?php require "partials/footer.php" ?>
    ]
</body>

</html>