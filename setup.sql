

CREATE DATABASE IF NOT EXISTS library_management;

USE library_management;

CREATE TABLE IF NOT EXISTS users (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(64) NOT NULL,
    email VARCHAR(254) NOT NULL,
    phone_number VARCHAR(64) NOT NULL,
    isAdmin BOOLEAN DEFAULT 0,
    password varchar(512)
);

CREATE TABLE IF NOT EXISTS book (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(64),
    author varchar(64),
    poster VARCHAR(64),
    amount INTEGER,
    available INTEGER
);

CREATE TABLE IF NOT EXISTS borrow (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    borrow_date DATETIME NOT NULL,
    return_date DATE,
    user_id INTEGER,
    book_id INTEGER,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (book_id) REFERENCES book(id)
);

CREATE TABLE IF NOT EXISTS password_resets (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    token VARCHAR(255) NOT NULL,
    expires INT NOT NULL
);

-- ALTER TABLE borrow 
-- ADD COLUMN return_date DATE;

-- ALTER TABLE book 
-- ADD COLUMN available INTEGER;

ALTER TABLE book 
ADD COLUMN genre varchar(30);