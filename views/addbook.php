<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    <link rel="stylesheet" href="static/css/addbook.css">
</head>

<body>
    <?php require "partials/header.php" ?>

    <section id="addbook">
        <h2>Add Book</h2>
        <form action="" method="get">
            <label for="btitle"> Title</label>
            <input type="text" name="btitle" id="btitle" placeholder="">
            <label for="bauthor"> Author</label>
            <input type="text" name="bauthor" id="bauthor" placeholder="">
            <label for="bamount"> Amount</label>
            <input type="text" name="bamount" id="bamount" placeholder="">
            <label for="bpicture"> Picture</label>
            <input type="file" name="bpicture" id="bpicture" placeholder="">
            <button type="submit">Add Book</button>
        </form>
    </section>


    <?php require "partials/footer.php" ?>
    ]
</body>

</html>