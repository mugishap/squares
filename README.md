# Squares

This is a stock management system to simplify the recording and making business transactions

## ##Some of the queries used

Create users:
CREATE TABLE users (
user_id varchar(255) varchar UUID() NOT NULL UNIQUE,
count INT PRIMARY KEY AUTO_INCREMENT,
firstname varchar(30) NOT NULL,
lastname varchar(30) NOT NULL,
username varchar(30) NOT NULL,
email varchar(70) NOT NULL,
password varchar(255) NOT NULL,
);

#Create entries:
------------------------------------------------------
CREATE TABLE entries_username (
entry_id VARCHAR(255) DEFAULT UUID(),
count int auto_increment PRIMARY KEY NOT NULL,
date DATE DEFAULT current_timestamp() NOT NULL,
title VARCHAR(70) NOT NULL,amount int NOT NULL,
price int NOT NULL, description VARCHAR(1000) NOT NULL
);
