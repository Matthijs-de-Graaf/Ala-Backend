DROP DATABASE IF EXISTS ALA_Questions_test;
CREATE DATABASE ALA_Questions_test;

-- Select the database
USE ALA_Questions_test;


CREATE TABLE questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question varchar(255),
    score INT NOT NULL
);

INSERT INTO questions (question, score) VALUES 
('Why wouldnt a simple change in name not work?', 3),
('Why wouldnt a simple change in name not work?', 2),
('Why wouldnt a simple change in name not work?', 1),
('Why wouldnt a simple change in name not work?', -1),
('Why wouldnt a simple change in name not work?', -3),
('Why wouldnt a simple change in name not work?', -3),
('Why wouldnt a simple change in name not work?', -3),
('Why wouldnt a simple change in name not work?', -2);


-- Query the table to get information about the responses
SELECT *
FROM questions;