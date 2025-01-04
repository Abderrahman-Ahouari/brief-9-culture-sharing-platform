-- Active: 1733842609457@@127.0.0.1@3306@culture_sharing_platform
DROP TABLE articles;
DROP TABLE users;
DROP TABLE categories;

CREATE TABLE users (
    users_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL, 
    email VARCHAR(150) UNIQUE NOT NULL,
    phone VARCHAR(15) NOT NULL,
    password VARCHAR(255) UNIQUE NOT NULL,
    role ENUM('author', 'user', 'admin') NOT NULL
);

CREATE TABLE articles (
    articles_id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    publication_date DATETIME DEFAULT CURRENT_TIMESTAMP,
    author_id INT,
    category_id INT,
    status ENUM('pending', 'published', 'rejected') DEFAULT 'pending',
    FOREIGN KEY (author_id) REFERENCES users(users_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(categories_id) ON DELETE CASCADE ON UPDATE CASCADE 
);

    CREATE TABLE categories (
        categories_id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL
    );


-- isert some data for testing

INSERT INTO users (first_name, last_name, email, phone, password, role) VALUES
('Admin1', 'User', 'admin1@example.com', '1111111111', 'pass1', 'admin'),
('Admin2', 'User', 'admin2@example.com', '2222222222', 'pass2', 'admin'),
('Admin3', 'User', 'admin3@example.com', '3333333333', 'pass3', 'admin'),
('Author1', 'User', 'author1@example.com', '4444444444', 'pass4', 'author'),
('Author2', 'User', 'author2@example.com', '5555555555', 'pass5', 'author'),
('Author3', 'User', 'author3@example.com', '6666666666', 'pass6', 'author'),
('Author4', 'User', 'author4@example.com', '7777777777', 'pass7', 'author'),
('Author5', 'User', 'author5@example.com', '8888888888', 'pass8', 'author'),
('User1', 'User', 'user1@example.com', '9999999999', 'pass9', 'user'),
('User2', 'User', 'user2@example.com', '1010101010', 'pass10', 'user');


INSERT INTO categories (name) VALUES
('Technology'),
('Health'),
('Lifestyle'),
('Education');


INSERT INTO articles (title, content, author_id, category_id, status) VALUES
('Article 1', 'Content 1...', 4, 1, 'published'),
('Article 2', 'Content 2...', 4, 2, 'pending'),
('Article 3', 'Content 3...', 4, 3, 'rejected'),
('Article 4', 'Content 4...', 4, 4, 'published'),
('Article 5', 'Content 5...', 5, 1, 'published'),
('Article 6', 'Content 6...', 5, 2, 'pending'),
('Article 7', 'Content 7...', 5, 3, 'rejected'),
('Article 8', 'Content 8...', 5, 4, 'published'),
('Article 9', 'Content 9...', 6, 1, 'published'),
('Article 10', 'Content 10...', 6, 2, 'pending'),
('Article 11', 'Content 11...', 6, 3, 'rejected'),
('Article 12', 'Content 12...', 6, 4, 'published'),
('Article 13', 'Content 13...', 7, 1, 'published'),
('Article 14', 'Content 14...', 7, 2, 'pending'),
('Article 15', 'Content 15...', 7, 3, 'rejected'),
('Article 16', 'Content 16...', 7, 4, 'published'), 
('Article 17', 'Content 17...', 8, 1, 'published'),
('Article 18', 'Content 18...', 8, 2, 'pending'),
('Article 19', 'Content 19...', 8, 3, 'rejected'),
('Article 20', 'Content 20...', 8, 4, 'published');



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

