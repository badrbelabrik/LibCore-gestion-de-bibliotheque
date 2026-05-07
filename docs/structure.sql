CREATE DATABASE library_db;
USE library_db;

CREATE TABLE types(
    label VARCHAR(100) PRIMARY KEY NOT NULL
);
CREATE TABLE members(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE,
    member_type VARCHAR(100),
    FOREIGN KEY (member_type) REFERENCES types(label) ON DELETE SET NULL
);
CREATE TABLE librarians(
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE
);
CREATE TABLE books(
    id INT PRIMARY KEY AUTO_INCREMENT,
    isbn VARCHAR(100) UNIQUE,
    title VARCHAR(100) NOT NULL,
    author VARCHAR(100) NOT NULL,
    isAvailable BOOLEAN DEFAULT TRUE,
    state VARCHAR(100) DEFAULT 'Disponible'
);
CREATE TABLE borrows(
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_member INT NOT NULL,
    id_book INT NOT NULL,
    date_borrow DATETIME NOT NULL,
    date_return DATE NOT NULL,
    returned BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (id_member) REFERENCES members(id),
    FOREIGN KEY (id_book) REFERENCES books(id)
)