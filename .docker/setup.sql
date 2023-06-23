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

INSERT INTO post (title, content, photo_filename, publication_date) VALUES
('Exploring the Evolution of Visual Effects in Film', 'The movie industry has witnessed remarkable advancements in visual effects over the years. From the groundbreaking achievements of Stanley Kubrick\'s "2001: A Space Odyssey" to the awe-inspiring computer-generated imagery (CGI) in today\'s blockbusters, this article delves into the evolution of visual effects. We explore the transition from practical effects to digital wizardry and examine the impact these advancements have had on storytelling. By examining case studies and interviewing industry experts, we uncover the artistic and technical challenges faced by filmmakers. From the emergence of CGI to the seamless integration of visual effects, this article provides an in-depth analysis of how visual effects have transformed the movie industry.', 'evolution_of_visual_effects.jpg', NOW()),
('The Rise of Streaming Platforms: Changing the Face of Movie Distribution', 'In recent years, the movie industry has witnessed a seismic shift in the way films are distributed and consumed. Streaming platforms such as Netflix, Amazon Prime Video, and Disney+ have disrupted traditional distribution models, allowing viewers to access a vast library of movies and TV shows at their convenience. This article explores the impact of streaming platforms on the movie industry, discussing the benefits and challenges they bring. We delve into the changing viewing habits, the rise of original content, and the implications for filmmakers and studios. With the streaming landscape continuously evolving, it is crucial to understand the dynamics reshaping the industry.', 'rise_of_streaming_platforms.jpg', NOW()),
('Unveiling the Art of Cinematography: Crafting Visual Masterpieces', 'Cinematography plays a vital role in shaping the visual language of movies. It is the art of capturing light, framing shots, and creating visually stunning compositions that evoke emotions and enhance storytelling. In this article, we take a deep dive into the world of cinematography. We explore the techniques employed by cinematographers, the use of lighting and color to convey mood, and the collaboration between directors and cinematographers. Through analyzing iconic scenes and discussing the work of acclaimed cinematographers, we uncover the magic behind crafting visual masterpieces on the silver screen.', 'art_of_cinematography.jpg', NOW()),
('The Impact of Diversity and Inclusion in Hollywood', 'The movie industry has long been criticized for its lack of diversity and representation. However, in recent years, there has been a significant push for greater inclusion in Hollywood. This article examines the importance of diversity in storytelling and its impact on audiences. We explore the initiatives undertaken to promote diversity both in front of and behind the camera, the challenges faced, and the progress made. By highlighting successful diverse films and the stories they tell, we shed light on the power of representation in shaping a more inclusive and authentic cinematic landscape.', null, NOW()),
('Film Review: "The Shape of Water"', 'Guillermo del Toro\'s "The Shape of Water" is a visually stunning and emotionally captivating masterpiece. Set against the backdrop of Cold War-era America, the film tells the story of a mute janitor who forms a unique connection with a mysterious amphibious creature. The performances are exceptional, with Sally Hawkins delivering a breathtaking portrayal of vulnerability and strength. The production design and cinematography create a mesmerizing world that blends fantasy and reality seamlessly. With its poignant themes of love, acceptance, and the power of empathy, "The Shape of Water" is a must-see for any cinephile.', null, NOW()),
('Movie Review: "Parasite"', 'Bong Joon-ho\'s "Parasite" is a genre-defying masterpiece that leaves a lasting impact. "Parasite" is a masterclass in storytelling, blending elements of dark comedy, suspense, and social commentary flawlessly. The ensemble cast delivers exceptional performances, with the film showcasing Bong Joon-ho\'s signature style and his ability to navigate complex themes with nuance. With its thought-provoking narrative, stellar direction, and powerful performances, "Parasite" rightfully earned its place as a landmark in cinema history.', 'parasite_review.jpg', NOW());

INSERT INTO comment (content, comment_date, user_id, post_id)
VALUES ('I absolutely loved "The Shape of Water"! The visuals were breathtaking, and the performances were outstanding. Guillermo del Toro is a true visionary.', NOW(), 1, 6);
INSERT INTO comment (content, comment_date, user_id, post_id)
VALUES ('I agree! "Parasite" was an incredible film. The way it portrayed class dynamics was both thought-provoking and unsettling.', NOW(), 2, 7);
INSERT INTO comment (content, comment_date, user_id, post_id)
VALUES ('I\'m fascinated by the evolution of visual effects in the movie industry. The advancements have truly changed the way stories are told on the big screen.', NOW(), 3, 1);
INSERT INTO comment (content, comment_date, user_id, post_id)
VALUES ('Streaming platforms have revolutionized the way we watch movies. I enjoy having access to a vast library of films and shows at my fingertips.', NOW(), 4, 2);
INSERT INTO comment (content, comment_date, user_id, post_id)
VALUES ('Cinematography is such a crucial aspect of filmmaking. It\'s amazing how lighting, framing, and composition can evoke emotions and enhance storytelling.', NOW(), 5, 3);


INSERT INTO user (username, password, salt, role) VALUES
('admin', '$argon2id$v=19$m=65536,t=4,p=1$c1BHRXQzOHpaZldTeElHbw$TKVPi2znGSI2y0YHrk7n/onTHhOGPckw5oJj5GdQv48', 'JERF/V6ymD5CASdv', 'admin'),
('john.doe', 'password123', 'abcdef1234567890', 'user'),
('jane.smith', 'securepass', 'xyz7890abcdef123', 'user'),
('admin', 'adminpass', '1234567890abcdef', 'admin'),
('author', 'authorpass', '4567890abcdef123', 'author'),
('guest', 'guestpass', '7890abcdef123456', 'user');
