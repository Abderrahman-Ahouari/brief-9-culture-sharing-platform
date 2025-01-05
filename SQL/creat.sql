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



-- isert some data for testing

INSERT INTO users (first_name, last_name, email, phone, password, role) VALUES
('Admin', 'User', 'admin@example.com', '1234567890', 'hashedpassword1', 'admin'),
('Author1', 'LastName1', 'author1@example.com', '1234567891', 'hashedpassword2', 'author'),
('Author2', 'LastName2', 'author2@example.com', '1234567892', 'hashedpassword3', 'author'),
('Author3', 'LastName3', 'author3@example.com', '1234567893', 'hashedpassword4', 'author'),
('User1', 'LastName4', 'user1@example.com', '1234567894', 'hashedpassword5', 'user'),
('User2', 'LastName5', 'user2@example.com', '1234567895', 'hashedpassword6', 'user'),
('User3', 'LastName6', 'user3@example.com', '1234567896', 'hashedpassword7', 'user'),
('User4', 'LastName7', 'user4@example.com', '1234567897', 'hashedpassword8', 'user'),
('User5', 'LastName8', 'user5@example.com', '1234567898', 'hashedpassword9', 'user'),
('User6', 'LastName9', 'user6@example.com', '1234567899', 'hashedpassword10', 'user'),
('User7', 'LastName10', 'user7@example.com', '1234567810', 'hashedpassword11', 'user'),
('User8', 'LastName11', 'user8@example.com', '1234567811', 'hashedpassword12', 'user'),
('User9', 'LastName12', 'user9@example.com', '1234567812', 'hashedpassword13', 'user'),
('User10', 'LastName13', 'user10@example.com', '1234567813', 'hashedpassword14', 'user'),
('Author4', 'LastName14', 'author4@example.com', '1234567814', 'hashedpassword15', 'author'),
('Author5', 'LastName15', 'author5@example.com', '1234567815', 'hashedpassword16', 'author'),
('Author6', 'LastName16', 'author6@example.com', '1234567816', 'hashedpassword17', 'author'),
('Author7', 'LastName17', 'author7@example.com', '1234567817', 'hashedpassword18', 'author'),
('Author8', 'LastName18', 'author8@example.com', '1234567818', 'hashedpassword19', 'author'),
('Author9', 'LastName19', 'author9@example.com', '1234567819', 'hashedpassword20', 'author');



INSERT INTO categories (name) VALUES
('Technology'),
('Health'),
('Education'),
('Sports'),
('Business'),
('Lifestyle'),
('Entertainment'),
('Science'),
('Politics'),
('Travel');


INSERT INTO articles (title, content, author_id, category_id, status) VALUES
('Article 1', 'Content of article 1.', 2, 1, 'published'),
('Article 2', 'Content of article 2.', 3, 2, 'pending'),
('Article 3', 'Content of article 3.', 4, 3, 'rejected'),
('Article 4', 'Content of article 4.', 5, 4, 'published'),
('Article 5', 'Content of article 5.', 6, 5, 'pending'),
('Article 6', 'Content of article 6.', 7, 6, 'published'),
('Article 7', 'Content of article 7.', 8, 7, 'rejected'),
('Article 8', 'Content of article 8.', 9, 8, 'published'),
('Article 9', 'Content of article 9.', 10, 9, 'pending'),
('Article 10', 'Content of article 10.', 11, 10, 'published'),
('Article 11', 'Content of article 11.', 12, 1, 'pending'),
('Article 12', 'Content of article 12.', 13, 2, 'published'),
('Article 13', 'Content of article 13.', 14, 3, 'rejected'),
('Article 14', 'Content of article 14.', 15, 4, 'published'),
('Article 15', 'Content of article 15.', 16, 5, 'pending'),
('Article 16', 'Content of article 16.', 17, 6, 'published'),
('Article 17', 'Content of article 17.', 18, 7, 'rejected'),
('Article 18', 'Content of article 18.', 19, 8, 'published'),
('Article 19', 'Content of article 19.', 20, 9, 'pending'),
('Article 20', 'Content of article 20.', 2, 10, 'published');



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
