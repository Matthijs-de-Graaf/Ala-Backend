DROP DATABASE IF EXISTS ALA_Questions_test;
CREATE DATABASE ALA_Questions_test;

-- Select the database
USE ALA_Questions_test;

DROP TABLE IF EXISTS questions;

CREATE TABLE questions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    question varchar(255),
    score INT NOT NULL
);

INSERT INTO questions (question, score) VALUES
('Bevat het document informatie die niet elders beschikbaar is?', 2),
('Is het document al vervangen door een bijgewerkte versie?', 2),
('Is het document nog steeds nodig voor onze huidige bedrijfsactiviteiten?', 3),
('Is het document van strategisch belang voor ons bedrijf?', 3),
('Is het document van historisch belang voor ons bedrijf?', 3),
('Is het document van belang voor toekomstig onderzoek of ontwikkeling?', 2),
('Is het document opgenomen in onze archieven of records?', 1),
('Is het document nog steeds relevant voor onze klanten?', 2),
('Is het document nodig om te voldoen aan wettelijke of regelgevende vereisten?', 3),
('Is het document nuttig voor het trainen van nieuwe medewerkers?', 1),
('Is het document van belang voor onze leveranciers of partners?', 2),
('Is het document nodig voor audits of verificaties?', 3),
('Is het document nodig om te voldoen aan contractuele verplichtingen?', 3),
('Is het document nodig voor het indienen van belastingaangiften of financiële rapportages?', 3),
('Is het document van belang voor onze merkidentiteit of marketingactiviteiten?', 2),
('Is het document nodig voor onze klantenservice?', 2),
('Is het document nodig voor het trainen van interne medewerkers?', 2),
('Is het document nuttig voor onze R&D-afdeling of productontwikkeling?', 2),
('Is het document nodig voor het beschermen van onze intellectuele eigendom?', 3),
('Is het document nog steeds nodig voor naleving van interne procedures of richtlijnen?', 2),
('Is het document nog relevant voor mijn werk of het bedrijf?', 3),
('Bevat het document gevoelige of vertrouwelijke informatie?', 3);

-- Query the table to get information about the responses
SELECT *
FROM questions;