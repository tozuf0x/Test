CREATE DATABASE `Test` character set utf8mb4 collate utf8mb4_bin;
USE `Test`;

CREATE TABLE IF NOT EXISTS Posts(
userId INT NOT NULL,
id INT NOT NULL,
PRIMARY KEY(id),
title TEXT,
body TEXT);

CREATE TABLE IF NOT EXISTS Comments(
postId INT NOT NULL,
   id INT NOT NULL,
   name TEXT,
   email VARCHAR(128),
   body TEXT,
   PRIMARY KEY(id),
   FOREIGN KEY (postId) REFERENCES Posts(id))
