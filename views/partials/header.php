<header>
    <div>
        <h1>LIBRARY</h1>
    </div>
    <div>
        <nav>
            <ul>
                <li><a href="#search">Search for Books</a></li>
                <?php if ($_SESSION['user'] ?? false) : ?>
                    <li><a href="#borrow">Borrow Books</a></li>
                    <li><a href="#return">Return Books</a></li>
                    <li><a href="/logout">Logout</a></li>
                <?php else : ?>
                    <li><a href="/signup">Sign-up</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>
</header>