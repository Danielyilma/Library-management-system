<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Records</title>
    <link rel="stylesheet" href="views/static/css/addbook.css">
    <link rel="stylesheet" href="views/static/css/record.css">
</head>
<body>
    <?php require "partials/header.php" ?>

    <section class="record-container">
        <h2>List of Borrowed Books</h2>
        <table>
            <thead>
                <tr>
                    <th>Borrower Name</th>
                    <th>Email</th>
                    <th>Book title</th>
                    <th>Borrow date</th>
                    <th>Return Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($borrows as $borrow) : ?>
                    <tr>
                        <td><?= $borrow['user']['full_name'] ?></td>
                        <td><?= $borrow['user']['email'] ?></td>
                        <td><?= $borrow['book']['title'] ?></td>
                        <td><?= $borrow['borrow_date'] ?></td>
                        <td><?= $borrow['return_date'] ?></td>
                    </tr> 
                <?php endforeach; ?>                
            </tbody>
        </table>
    </section>

    <section class="record-container">
        <h2>List of Overdue Books</h2>
        <table>
            <thead>
                <tr>
                    <th>Borrower Name</th>
                    <th>Email</th>
                    <th>Book title</th>
                    <th>Borrow date</th>
                    <th>Return Date</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($borrows as $borrow) : ?>
                    <tr>
                        <td><?= $overdueBorrrow['full_name'] ?></td>
                        <td><?= $overdueBorrrow['email'] ?></td>
                        <td><?= $overdueBorrrow['book']['title'] ?></td>
                        <td><?= $overdueBorrrow['borrow_date'] ?></td>
                        <td><?= $overdueBorrrow['return_date'] ?></td>
                    </tr> 
                <?php endforeach; ?>                
            </tbody>
        </table>
    </section>

    <section class="record-container">
        <h2>Book Inventory</h2>
        <table>
            <thead>
                <tr>
                    <th>Book Title</th>
                    <th>Author</th>
                    <th>Borrowed Count</th>
                    <th>Available Count</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($books as $book) : ?>
                    <tr>
                        <td><?= $book['title'] ?></td>
                        <td><?= $book['author'] ?></td>
                        <td><?= $book['borrow_count'] ?></td>
                        <td><?= $book['available_count'] ?></td>
                    </tr> 
                <?php endforeach; ?>                
            </tbody>
        </table>
    </section>

    <?php require "partials/footer.php" ?>

</body>
</html>