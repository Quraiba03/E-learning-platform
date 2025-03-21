CREATE TABLE profiles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    bio TEXT,
    semester VARCHAR(20),
    profile_photo VARCHAR(255),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);