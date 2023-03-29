-- Create the database
DROP DATABASE IF EXISTS ALA_Questions_test;
CREATE DATABASE ALA_Questions_test;

-- Select the database
USE ALA_Questions_test;

-- Create the questions table
CREATE TABLE questions (
  ID INT NOT NULL AUTO_INCREMENT,
  question VARCHAR(255),
  option_a BOOLEAN,
  option_b BOOLEAN,
  next_question_a BOOLEAN,
  next_question_b BOOLEAN,
  PRIMARY KEY (ID)
);

-- Insert data into the table
INSERT INTO ALA_Questions_test.questions (question, option_a, option_b, next_question_a, next_question_b) VALUES 
    ('True', TRUE, TRUE, TRUE, TRUE),
    ('this is false', FALSE, FALSE, FALSE, FALSE),
    ('Ehhh -Renzo (true)', FALSE, FALSE, FALSE, FALSE),
    ('Anil is HOMOPHOBIC', FALSE, FALSE, FALSE, FALSE),
    ('Matthijs is stupid and gay', FALSE, FALSE, FALSE, FALSE);

-- Query the table to get information about the responses
SELECT *
FROM questions;