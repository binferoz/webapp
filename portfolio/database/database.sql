CREATE DATABASE IF NOT EXISTS portfolio_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE portfolio_db;

-- Users table for authentication
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Projects table for portfolio projects
CREATE TABLE IF NOT EXISTS projects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image_url VARCHAR(255),
    project_url VARCHAR(255),
    technologies VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Contacts table for contact form submissions
CREATE TABLE IF NOT EXISTS contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL,
    subject VARCHAR(255),
    message TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Skills table for portfolio skills
CREATE TABLE IF NOT EXISTS skills (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    category VARCHAR(50) NOT NULL,
    proficiency INT DEFAULT 80,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert sample data
INSERT INTO projects (title, description, image_url, project_url, technologies) VALUES
('Portfolio Website', 'A responsive portfolio website built with HTML, CSS, and JavaScript', 'project1.jpg', 'https://github.com/yourusername/portfolio', 'HTML, CSS, JavaScript, Bootstrap'),
('E-commerce Platform', 'A full-stack e-commerce application with user authentication and payment processing', 'project2.jpg', 'https://github.com/yourusername/ecommerce', 'PHP, MariaDB, JavaScript, Stripe API'),
('Task Management App', 'A collaborative task management application with real-time updates', 'project3.jpg', 'https://github.com/yourusername/taskmanager', 'React, Node.js, MongoDB, Socket.io');

INSERT INTO skills (name, category, proficiency) VALUES
('HTML5', 'Frontend', 95),
('CSS3', 'Frontend', 90),
('JavaScript', 'Frontend', 85),
('PHP', 'Backend', 80),
('MariaDB', 'Database', 85),
('React', 'Frontend', 75),
('Node.js', 'Backend', 70),
('Python', 'Backend', 75),
('Git', 'Tools', 80),
('Bootstrap', 'Frontend', 90);

-- Create indexes for better performance
CREATE INDEX idx_users_username ON users(username);
CREATE INDEX idx_users_email ON users(email);
CREATE INDEX idx_projects_title ON projects(title);
CREATE INDEX idx_contacts_email ON contacts(email);
CREATE INDEX idx_skills_category ON skills(category);
