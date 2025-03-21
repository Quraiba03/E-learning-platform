-- Create the database
CREATE DATABASE IF NOT EXISTS gsss;

-- Switch to the created database
USE gsss;

-- Create the table for storing lesson details
CREATE TABLE IF NOT EXISTS lessons (
    lesson_id INT AUTO_INCREMENT PRIMARY KEY,
    heading VARCHAR(255) NOT NULL,
    explanation TEXT,
    video_path VARCHAR(255) NOT NULL
);

-- Create the table for storing keywords related to each lesson
CREATE TABLE IF NOT EXISTS keywords (
    keyword_id INT AUTO_INCREMENT PRIMARY KEY,
    lesson_id INT,
    keyword VARCHAR(255) NOT NULL,
    FOREIGN KEY (lesson_id) REFERENCES lessons(lesson_id) ON DELETE CASCADE
);
