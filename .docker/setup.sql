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

CREATE TABLE post(
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
    comment_date DATETIME,
    user_id INT,
    post_id INT,
    PRIMARY KEY (id)
);

INSERT INTO post (title, content, photo_filename, publication_date)
VALUES ('First Post', 'This is the content of the first post.', 'photo1.jpg', '2023-06-01 09:15:00');

INSERT INTO post (title, content, photo_filename, publication_date)
VALUES ('Second Post', 'This is the content of the second post.', 'photo2.jpg', '2023-06-02 14:30:00');

INSERT INTO post (title, content, photo_filename, publication_date)
VALUES ('Third Post', 'This is the content of the third post.', NULL, '2023-06-03 18:45:00');

INSERT INTO post (title, content, photo_filename, publication_date)
VALUES ('Fourth Post', 'This is the content of the fourth post.', 'photo3.jpg', '2023-06-04 10:00:00');

INSERT INTO post (title, content, photo_filename, publication_date)
VALUES ('Fifth Post', 'This is the content of the fifth post.', NULL, '2023-06-05 12:30:00');

INSERT INTO post (title, content, photo_filename, publication_date)
VALUES ('Sixth Post', 'This is the content of the sixth post.', 'photo4.jpg', '2023-06-06 15:45:00');

INSERT INTO post (title, content, photo_filename, publication_date)
VALUES ('Seventh Post', 'This is the content of the seventh post.', NULL, '2023-06-07 09:30:00');

INSERT INTO post (title, content, photo_filename, publication_date)
VALUES ('Eighth Post', 'This is the content of the eighth post.', 'photo5.jpg', '2023-06-08 11:45:00');

INSERT INTO post (title, content, photo_filename, publication_date)
VALUES ('Ninth Post', 'This is the content of the ninth post.', NULL, '2023-06-09 14:00:00');

INSERT INTO post (title, content, photo_filename, publication_date)
VALUES ('Tenth Post', 'This is the content of the tenth post.', 'photo6.jpg', '2023-06-10 16:30:00');

INSERT INTO post (title, content, photo_filename, publication_date)
VALUES ('Eleventh Post', 'This is the content of the eleventh post.', NULL, '2023-06-11 10:15:00');

INSERT INTO post (title, content, photo_filename, publication_date)
VALUES ('Twelfth Post', 'This is the content of the twelfth post.', 'photo7.jpg', '2023-06-12 12:45:00');

INSERT INTO post (title, content, photo_filename, publication_date)
VALUES ('Thirteenth Post', 'This is the content of the thirteenth post.', NULL, '2023-06-13 15:00:00');

INSERT INTO post (title, content, photo_filename, publication_date)
VALUES ('Fourteenth Post', 'This is the content of the fourteenth post.', 'photo8.jpg', '2023-06-14 09:30:00');

INSERT INTO post (title, content, photo_filename, publication_date)
VALUES ('Fifteenth Post', 'This is the content of the fifteenth post.', NULL, '2023-06-15 11:45:00');


INSERT INTO comment (content, comment_date, user_id, post_id) VALUES ('Great post!', '2023-06-01 12:34:56', 1, 1);
INSERT INTO comment (content, comment_date, user_id, post_id) VALUES ('Nice job!', '2023-06-02 09:21:00', 2, 1);
INSERT INTO comment (content, comment_date, user_id, post_id) VALUES ('Interesting read.', '2023-06-03 18:45:22', 3, 2);
INSERT INTO comment (content, comment_date, user_id, post_id) VALUES ('Thanks for sharing.', '2023-06-04 15:10:30', 4, 2);
INSERT INTO comment (content, comment_date, user_id, post_id) VALUES ('Well written!', '2023-06-05 11:55:12', 2, 3);
INSERT INTO comment (content, comment_date, user_id, post_id) VALUES ('I enjoyed this.', '2023-06-06 20:30:45', 1, 3);
INSERT INTO comment (content, comment_date, user_id, post_id) VALUES ('Keep up the good work.', '2023-06-07 14:22:18', 3, 4);
INSERT INTO comment (content, comment_date, user_id, post_id) VALUES ('Informative post.', '2023-06-08 17:17:29', 4, 4);
INSERT INTO comment (content, comment_date, user_id, post_id) VALUES ('I have a question.', '2023-06-09 10:05:50', 2, 5);
INSERT INTO comment (content, comment_date, user_id, post_id) VALUES ('Looking forward to more.', '2023-06-10 19:40:03', 1, 5);
INSERT INTO comment (content, comment_date, user_id, post_id) VALUES ('Insightful content.', '2023-06-11 16:15:41', 3, 6);
INSERT INTO comment (content, comment_date, user_id, post_id) VALUES ('Well done!', '2023-06-12 13:55:24', 4, 6);
INSERT INTO comment (content, comment_date, user_id, post_id) VALUES ('I learned something new.', '2023-06-13 08:12:09', 2, 7);
INSERT INTO comment (content, comment_date, user_id, post_id) VALUES ('Impressive writing style.', '2023-06-14 22:18:37', 1, 7);
INSERT INTO comment (content, comment_date, user_id, post_id) VALUES ('This deserves more attention.', '2023-06-15 12:45:52', 3, 8);
INSERT INTO comment (content, comment_date, user_id, post_id) VALUES ('I can relate to this.', '2023-06-16 17:30:15', 4, 8);
INSERT INTO comment (content, comment_date, user_id, post_id) VALUES ('Well-explained.', '2023-06-17 09:55:02', 2, 9);

INSERT INTO user (username, password, salt, role) VALUES
('john.doe', 'password123', 'abcdef1234567890', 'user'),
('jane.smith', 'securepass', 'xyz7890abcdef123', 'user'),
('admin', 'adminpass', '1234567890abcdef', 'admin'),
('author', 'authorpass', '4567890abcdef123', 'author'),
('guest', 'guestpass', '7890abcdef123456', 'user');
