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
    <div id="search">
        <form class="record-search" action="/borrow_record" method="get">
            <input type="hidden" name="search" value="search">
            <input type="text" name="query" id="sinput" placeholder="Search by name or email">
            <button id="sebutton" type="submit">Search</button>
        </form>
    </div>

    <section class="record-container">
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
                        <td>
                            <form action="/borrow_record" method="post">
                                <input type="hidden" name="id" value="<?= $borrow['id'] ?>">
                                <button type="submit">Return</button>
                            </form>
                        </td>
                    </tr> 
                <?php endforeach; ?>                
            </tbody>
        </table>
        
    </section>

    <?php require "partials/footer.php" ?>

</body>
</html>