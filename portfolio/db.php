<?php
// Database configuration for MariaDB
$host = 'localhost';
$db   = 'portfolio_db';
$user = 'root';
$pass = 'Adnan.123';

try {
    // Check what database extensions are available
    $available_extensions = [];
    if (extension_loaded('pdo')) $available_extensions[] = 'PDO';
    if (extension_loaded('pdo_mysql')) $available_extensions[] = 'PDO MySQL';
    if (extension_loaded('mysqli')) $available_extensions[] = 'MySQLi';
    
    // Try PDO first (most common)
    if (extension_loaded('pdo') && extension_loaded('pdo_mysql')) {
        // Connect to MariaDB server first (without specifying database)
        $pdo = new PDO("mysql:host=$host", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        // Create database if it doesn't exist
        $pdo->exec("CREATE DATABASE IF NOT EXISTS $db");
        
        // Connect to the specific database
        $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        
    } else {
        // No suitable database extension found
        $error_msg = "No suitable database extension found. ";
        $error_msg .= "Available extensions: " . implode(', ', $available_extensions) . ". ";
        $error_msg .= "Please enable PDO MySQL or MySQLi extension in your PHP configuration.";
        throw new Exception($error_msg);
    }
    
    // Create tables
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            username VARCHAR(100) NOT NULL UNIQUE,
            password VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL UNIQUE,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");
    
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS projects (
            id INT AUTO_INCREMENT PRIMARY KEY,
            title VARCHAR(255) NOT NULL,
            description TEXT NOT NULL,
            image_url VARCHAR(255),
            project_url VARCHAR(255),
            technologies VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");
    
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS contacts (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            email VARCHAR(255) NOT NULL,
            subject VARCHAR(255),
            message TEXT NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");
    
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS skills (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100) NOT NULL,
            category VARCHAR(50) NOT NULL,
            proficiency INT DEFAULT 80,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )
    ");
    
    // Add sample data if tables are empty
    $stmt = $pdo->query("SELECT COUNT(*) FROM projects");
    if ($stmt->fetchColumn() == 0) {
        $pdo->exec("
            INSERT INTO projects (title, description, image_url, project_url, technologies) VALUES
            ('Portfolio Website', 'A responsive portfolio website built with HTML, CSS, and JavaScript', 'project1.jpg', 'https://github.com/yourusername/portfolio', 'HTML, CSS, JavaScript, Bootstrap'),
            ('E-commerce Platform', 'A full-stack e-commerce application with user authentication and payment processing', 'project2.jpg', 'https://github.com/yourusername/ecommerce', 'PHP, MariaDB, JavaScript, Stripe API'),
            ('Task Management App', 'A collaborative task management application with real-time updates', 'project3.jpg', 'https://github.com/yourusername/taskmanager', 'React, Node.js, MongoDB, Socket.io')
        ");
    }
    
    $stmt = $pdo->query("SELECT COUNT(*) FROM skills");
    if ($stmt->fetchColumn() == 0) {
        $pdo->exec("
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
            ('Bootstrap', 'Frontend', 90)
        ");
    }
    
} catch (Exception $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
