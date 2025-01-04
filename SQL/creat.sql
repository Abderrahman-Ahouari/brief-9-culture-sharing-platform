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
   
    CREATE TABLE categories (
        categories_id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL
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
