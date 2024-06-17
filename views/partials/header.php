<header>
    <div>
        <h1>LIBRARY</h1>
    </div>
    <div>
        <nav>
            <ul>
                <?php if ($_SESSION['user'] ?? false) : ?>
                    <li><a href="/book">Add book</a></li>
                    <li><a href="/borrow">Borrow Books</a></li>
                    <li><a href="/borrow_record">Borrow Records</a></li>
                    <li><a href="/report">Report</a></li>
                    <li><a href="/logout">Logout</a></li>
                <?php else : ?>
                    <li><a href="/signup">Sign-up</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>