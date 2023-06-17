CREATE DATABASE IF NOT EXISTS myDB;
use myDB;

CREATE TABLE IF NOT EXISTS user(
    id int AUTO_INCREMENT NOT NULL,
    username varchar(255),
    password varchar(255),
    salt char(16),
    role varchar(50),
    PRIMARY KEY (id)
);

CREATE TABLE blog_post(
    id int AUTO_INCREMENT NOT NULL,
    title VARCHAR(255),
    content TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci,
    photo_filename VARCHAR(255),
    publication_date DATETIME,
    PRIMARY KEY (id)
);

CREATE TABLE comment(
    id int AUTO_INCREMENT NOT NULL,
    content TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_polish_ci,
    publication_date DATETIME,
    user_id INT,
    blog_post_id INT,
    PRIMARY KEY (id)
);

INSERT INTO blog_post (title, content, photo_filename, publication_date)
VALUES ('First Post', 'This is the content of the first post.', 'photo1.jpg', '2023-06-01 09:15:00');

INSERT INTO blog_post (title, content, photo_filename, publication_date)
VALUES ('Second Post', 'This is the content of the second post.', 'photo2.jpg', '2023-06-02 14:30:00');

INSERT INTO blog_post (title, content, photo_filename, publication_date)
VALUES ('Third Post', 'This is the content of the third post.', NULL, '2023-06-03 18:45:00');

INSERT INTO blog_post (title, content, photo_filename, publication_date)
VALUES ('Fourth Post', 'This is the content of the fourth post.', 'photo3.jpg', '2023-06-04 10:00:00');

INSERT INTO blog_post (title, content, photo_filename, publication_date)
VALUES ('Fifth Post', 'This is the content of the fifth post.', NULL, '2023-06-05 12:30:00');

INSERT INTO blog_post (title, content, photo_filename, publication_date)
VALUES ('Sixth Post', 'This is the content of the sixth post.', 'photo4.jpg', '2023-06-06 15:45:00');

INSERT INTO blog_post (title, content, photo_filename, publication_date)
VALUES ('Seventh Post', 'This is the content of the seventh post.', NULL, '2023-06-07 09:30:00');

INSERT INTO blog_post (title, content, photo_filename, publication_date)
VALUES ('Eighth Post', 'This is the content of the eighth post.', 'photo5.jpg', '2023-06-08 11:45:00');

INSERT INTO blog_post (title, content, photo_filename, publication_date)
VALUES ('Ninth Post', 'This is the content of the ninth post.', NULL, '2023-06-09 14:00:00');

INSERT INTO blog_post (title, content, photo_filename, publication_date)
VALUES ('Tenth Post', 'This is the content of the tenth post.', 'photo6.jpg', '2023-06-10 16:30:00');

INSERT INTO blog_post (title, content, photo_filename, publication_date)
VALUES ('Eleventh Post', 'This is the content of the eleventh post.', NULL, '2023-06-11 10:15:00');

INSERT INTO blog_post (title, content, photo_filename, publication_date)
VALUES ('Twelfth Post', 'This is the content of the twelfth post.', 'photo7.jpg', '2023-06-12 12:45:00');

INSERT INTO blog_post (title, content, photo_filename, publication_date)
VALUES ('Thirteenth Post', 'This is the content of the thirteenth post.', NULL, '2023-06-13 15:00:00');

INSERT INTO blog_post (title, content, photo_filename, publication_date)
VALUES ('Fourteenth Post', 'This is the content of the fourteenth post.', 'photo8.jpg', '2023-06-14 09:30:00');

INSERT INTO blog_post (title, content, photo_filename, publication_date)
VALUES ('Fifteenth Post', 'This is the content of the fifteenth post.', NULL, '2023-06-15 11:45:00');
