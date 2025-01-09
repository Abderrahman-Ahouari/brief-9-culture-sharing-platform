-- Active: 1733842609457@@127.0.0.1@3306@culture_sharing_platform

DROP TABLE users;
DROP TABLE categories;
DROP TABLE articles;
DROP TABLE commentairs;
DROP TABLE tags;
DROP TABLE likes;
DROP TABLE taged_articles;


DELETE FROM articles;
DELETE FROM users;
DELETE FROM categories;
DELETE FROM commentairs;
DELETE FROM tags;
DELETE FROM likes;
DELETE FROM taged_articles;

    CREATE TABLE users (
        users_id INT AUTO_INCREMENT PRIMARY KEY,
        first_name VARCHAR(100) NOT NULL,
        last_name VARCHAR(100) NOT NULL, 
        email VARCHAR(150) UNIQUE NOT NULL,
        image_profile VARCHAR(500),
        phone VARCHAR(15) NOT NULL,
        password VARCHAR(255) UNIQUE NOT NULL,
        role ENUM('author', 'user', 'admin') NOT NULL,
        statu ENUM('safe', 'banned') DEFAULT 'safe'
    ); 
    
            CREATE TABLE categories (
            categories_id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL
        );

        CREATE TABLE tags (
            tag_id INT AUTO_INCREMENT PRIMARY KEY,
            tag_name VARCHAR(100) NOT NULL
        );

    CREATE TABLE articles (
        articles_id INT AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(255) NOT NULL,
        content TEXT NOT NULL,
        publication_date DATETIME DEFAULT CURRENT_TIMESTAMP,
        author_id INT,
        category_id INT,
        image VARCHAR(500),
        status ENUM('pending', 'published', 'rejected') DEFAULT 'pending',
        FOREIGN KEY (author_id) REFERENCES users(users_id) ON DELETE CASCADE ON UPDATE CASCADE,
        FOREIGN KEY (category_id) REFERENCES categories(categories_id) ON DELETE CASCADE ON UPDATE CASCADE 
    );

CREATE TABLE commentairs (
    comment_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    article_id INT,
    comment_content TEXT not null,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(users_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (article_id) REFERENCES articles(articles_id) ON DELETE CASCADE ON UPDATE CASCADE
);

CREATE TABLE Taged_articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tag_id INT,
    article_id INT,
    FOREIGN KEY (tag_id) REFERENCES tags(tag_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (article_id) REFERENCES articles(articles_id) ON DELETE CASCADE ON UPDATE CASCADE
    );

CREATE TABLE likes (
   like_id INT AUTO_INCREMENT PRIMARY KEY,
   user_id INT,
   article_id INT,
   Foreign Key (user_id) REFERENCES users(users_id) ON DELETE CASCADE ON UPDATE CASCADE,
   Foreign Key (article_id) REFERENCES articles(articles_id) ON DELETE CASCADE ON UPDATE CASCADE
); 









-- isert some data for testing

INSERT INTO users (first_name, last_name, email, image_profile, phone, password, role, statu)
VALUES 
('John', 'Doe', 'john.doe@example.com', 'john.jpg', '1234567890', 'hashedpassword123', 'author', 'safe'),
('Jane', 'Smith', 'jane.smith@example.com', 'jane.jpg', '0987654321', 'hashedpassword456', 'user', 'safe'),
('Admin', 'User', 'admin@example.com', 'admin.jpg', '1122334455', 'hashedpassword789', 'admin', 'safe'),
('Alice', 'Johnson', 'alice.johnson@example.com', 'alice.jpg', '5544332211', 'hashedpassword101', 'author', 'safe'),
('Bob', 'Brown', 'bob.brown@example.com', 'bob.jpg', '6677889900', 'hashedpassword202', 'user', 'safe');

INSERT INTO categories (name)
VALUES 
('Technology'),
('Lifestyle'),
('Education'),
('Health'),
('Travel');

INSERT INTO tags (tag_name)
VALUES 
('PHP'),
('MySQL'),
('JavaScript'),
('CSS'),
('HTML'),
('React'),
('Node.js');

INSERT INTO articles (title, content, publication_date, author_id, category_id, image, status)
VALUES 
('Introduction to PHP', 'PHP is a popular scripting language.', '2024-01-01 10:00:00', 1, 1, 'php.jpg', 'published'),
('Top CSS Tips', 'Learn how to style your website effectively.', '2024-01-02 15:00:00', 1, 1, 'css.jpg', 'published'),
('Healthy Living Guide', 'Tips for maintaining a healthy lifestyle.', '2024-01-03 18:00:00', 2, 4, 'health.jpg', 'published'),
('Best Travel Destinations', 'Explore amazing places around the world.', '2024-01-04 12:00:00', 4, 5, 'travel.jpg', 'pending'),
('Advanced JavaScript Techniques', 'Learn advanced concepts in JavaScript.', '2024-01-05 14:00:00', 1, 1, 'javascript.jpg', 'published'),
('Education Trends 2024', 'The latest trends in education.', '2024-01-06 09:00:00', 5, 3, 'education.jpg', 'pending');

INSERT INTO Taged_articles (tag_id, article_id)
VALUES 
(1, 1),
(2, 1),
(3, 2),
(4, 2),
(5, 6),
(6, 4),
(7, 5),
(3, 5),
(2, 6),
(1, 6);

I   NSERT INTO likes (user_id, article_id)
VALUES 
(2, 1),
(3, 2),
(4, 5),
(5, 6),
(1, 4);

INSERT INTO commentairs (user_id, article_id, comment_content)
VALUES 
(1, 1, 'Great HHHHHHH'),
(2, 2, 'CSS tips were very helpful.'),
(3, 3, 'Interesting health tips.'),
(4, 4, 'Cant wait to visit these places.'),
(5, 5, 'JavaScript techniques are amazing.');







-- get all the articls created by a specific auteur for the author profile
select title, content, publication_date, articles_id FROM articles
WHERE author_id='4' and status='published' ORDER BY publication_date;

-- get a specific user informations for the user profile
SELECT first_name, last_name, email, phone FROM users where users_id='9';

-- get the pending articles to be validated or rejected by the admin
select title, content, publication_date, articles_id FROM articles
WHERE status='pending';



-- get all categories to display on a list in the admin dashboard
select name, categories_id FROM categories;


-- get articles by categorie
SELECT title, content, publication_date, articles_id, author_id, category_id FROM articles 
where category_id = '3';



-- query to add an article
INSERT INTO articles (title, content, author_id, category_id) VALUES('Article test', 'Content test 1...', 4, 3);

-- query to modify an article
UPDATE articles SET title = 'abdo', content='changecontent', category_id=3, status='pending' where articles_id='3';

-- query to delete an article
DELETE FROM articles WHERE articles_id=3;




-- creat a categoeie
INSERT INTO categories(name) VALUES('history');

-- modify a categorie
UPDATE categories set name='comedy' WHERE categories_id = '2';

-- delete a categorie
DELETE FROM categories WHERE categories_id = '1';


-- query to accept an articl
UPDATE articles set status = 'published' where articles_id ='';


-- query to reject an articl
UPDATE articles set status = 'rejected' where articles_id ='';

-- get all safe users to display in admin page
SELECT * FROM users WHERE statu = 'safe' and role= 'author' OR role= 'user' and statu = 'safe';

-- get all comments to display on the admin dashboard



