<?php require "db_books.php"; ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="stylesheet" href="css/homesty.css">
</head>

<body>
    <?php require "partials/header.php" ?>

    <section id="search">
        <h2>Books Matching "<?php echo htmlspecialchars($query); ?>"</h2>
        <?php
        if (isset($result) && count($result) > 0) {
            echo "<table>";
            echo "<tr><th>Book Name</th><th>Author</th><th>ISBN</th></tr>";
            foreach ($result as $row) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row["bookname"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["bookauthor"]) . "</td>";
                echo "<td>" . htmlspecialchars($row["bookid"]) . "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<p>No results found</p>";
        }
        ?>
    </section>

    <?php require "partials/footer.php" ?>

</body>

</html>