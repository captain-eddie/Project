CREATE DATABASE IF NOT EXISTS calendarApp;

USE calendarApp;

CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    date DATE,
    name VARCHAR(255),
    location VARCHAR(255),
    notes TEXT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
