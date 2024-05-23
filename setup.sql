

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
    poster VARCHAR(64)
);

CREATE TABLE IF NOT EXISTS borrow (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    borrow_date DATETIME NOT NULL,
    user_id INTEGER,
    book_id INTEGER,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (book_id) REFERENCES book(id)
);

