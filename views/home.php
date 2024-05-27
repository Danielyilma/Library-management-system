<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link rel="stylesheet" href="static/css/homesty.css">
</head>

<body>
    <?php require "partials/header.php";
    $books = [
        [
            "poster" => "front.png",
            "title" => "Advanced programming",
            "author" => "Daniel Ababu",
            "amount" => 3
        ],
        [
            "poster" => "front.png",
            "title" => "Advanced programming",
            "author" => "Daniel Ababu",
            "amount" => 3
        ],
        [
            "poster" => "front.png",
            "title" => "Advanced programming",
            "author" => "Daniel Ababu",
            "amount" => 3
        ],
        [
            "poster" => "front.png",
            "title" => "Advanced programming",
            "author" => "Daniel Ababu",
            "amount" => 3
        ],
        [
            "poster" => "front.png",
            "title" => "Advanced programming",
            "author" => "Daniel Ababu",
            "amount" => 3
        ]
    ]
    ?>

    <section>
        <div id="search">
            <h2>Search for Books</h2>
            <form action="searchview.php" method="get">
                <input type="text" name="query" id="sinput" placeholder="Search by title, author, or ISBN">
                <button type="submit">Search</button>
            </form>
        </div>

        <div id="books">
            <?php foreach ($books as $book) : ?>
                <div class="card">
                    <div class="cardimg"><img src="<?= $book["poster"] ?>" alt="book image"></div>
                    <h4 class="ctitle"><?= $book["title"] ?></h4>
                    <p class="cauthor"> <?= $book["author"] ?></p>
                    <p class="camount"><?= $book["amount"] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </section>


    <?php require "partials/footer.php" ?>

</body>

</html>