-- HCV Database Schema
CREATE DATABASE IF NOT EXISTS hcv_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE hcv_db;

-- Users/Admin table
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL UNIQUE,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  role ENUM('admin','editor') DEFAULT 'admin',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Gallery table
CREATE TABLE IF NOT EXISTS gallery (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  type ENUM('image','video') NOT NULL DEFAULT 'image',
  category VARCHAR(100) DEFAULT 'uncategorized',
  file_path VARCHAR(255) NOT NULL,
  thumbnail VARCHAR(255) DEFAULT NULL,
  video_url VARCHAR(255) DEFAULT NULL,
  featured TINYINT(1) DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Blog posts table
CREATE TABLE IF NOT EXISTS blog_posts (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  slug VARCHAR(255) NOT NULL UNIQUE,
  excerpt TEXT,
  content LONGTEXT,
  category VARCHAR(100) DEFAULT 'uncategorized',
  featured_image VARCHAR(255) DEFAULT NULL,
  featured TINYINT(1) DEFAULT 0,
  status ENUM('draft','published') DEFAULT 'published',
  author VARCHAR(100) DEFAULT 'HCV',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Events table
CREATE TABLE IF NOT EXISTS events (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  slug VARCHAR(255) NOT NULL UNIQUE,
  description TEXT,
  location VARCHAR(255) DEFAULT NULL,
  event_date DATE NOT NULL,
  event_time TIME DEFAULT NULL,
  image VARCHAR(255) DEFAULT NULL,
  status ENUM('upcoming','ongoing','completed') DEFAULT 'upcoming',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Testimonials table
CREATE TABLE IF NOT EXISTS testimonials (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  position VARCHAR(100) DEFAULT NULL,
  photo VARCHAR(255) DEFAULT NULL,
  content TEXT NOT NULL,
  rating TINYINT DEFAULT 5,
  featured TINYINT(1) DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Partners table
CREATE TABLE IF NOT EXISTS partners (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  logo VARCHAR(255) NOT NULL,
  website VARCHAR(255) DEFAULT NULL,
  category VARCHAR(100) DEFAULT 'partner',
  display_order INT DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Donation info table
CREATE TABLE IF NOT EXISTS donation_info (
  id INT AUTO_INCREMENT PRIMARY KEY,
  bank_name VARCHAR(255) NOT NULL,
  account_name VARCHAR(255) NOT NULL,
  account_number VARCHAR(100) NOT NULL,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Contact messages table
CREATE TABLE IF NOT EXISTS contact_messages (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL,
  phone VARCHAR(50) DEFAULT NULL,
  subject VARCHAR(255) DEFAULT NULL,
  message TEXT NOT NULL,
  read_status TINYINT(1) DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Contact info table
CREATE TABLE IF NOT EXISTS contact_info (
  id INT AUTO_INCREMENT PRIMARY KEY,
  address VARCHAR(255) DEFAULT NULL,
  phone VARCHAR(50) DEFAULT NULL,
  email VARCHAR(100) DEFAULT NULL,
  facebook VARCHAR(255) DEFAULT NULL,
  twitter VARCHAR(255) DEFAULT NULL,
  instagram VARCHAR(255) DEFAULT NULL,
  linkedin VARCHAR(255) DEFAULT NULL,
  youtube VARCHAR(255) DEFAULT NULL,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Newsletter subscribers
CREATE TABLE IF NOT EXISTS newsletter_subscribers (
  id INT AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(100) NOT NULL UNIQUE,
  subscribed TINYINT(1) DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Settings table
CREATE TABLE IF NOT EXISTS settings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  setting_key VARCHAR(100) NOT NULL UNIQUE,
  setting_value TEXT,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- Insert default admin (password: admin123)
INSERT INTO users (username, email, password, role) VALUES
('admin', 'admin@hcv.org', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin');

-- Insert sample donation info
INSERT INTO donation_info (bank_name, account_name, account_number) VALUES
('First Bank of Health', 'Health Communication and Visibility', '0123456789');

-- Insert sample contact info
INSERT INTO contact_info (address, phone, email, facebook, twitter, instagram, linkedin) VALUES
('123 Health Avenue, Wellness City, HC 10001', '+1 (555) 123-4567', 'info@hcv.org', '#', '#', '#', '#');
