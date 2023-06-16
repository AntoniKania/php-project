CREATE DATABASE IF NOT EXISTS myDB;
use myDB;

CREATE TABLE IF NOT EXISTS user(
    id int AUTO_INCREMENT NOT NULL,
    username varchar(255),
    password varchar(255),
    salt char(16),
    PRIMARY KEY (id)
    );