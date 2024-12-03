CREATE DATABASE IF NOT EXISTS `architech-labs-db`;

USE `architech-labs-db`;

CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    code VARCHAR(10) NOT NULL UNIQUE,
    name VARCHAR(100) NOT NULL,
    price DECIMAL(10, 2) NOT NULL
);

-- Insert sample data
INSERT INTO products (code, name, price) VALUES
('R01', 'Red Widget', 32.95),
('G01', 'Green Widget', 24.95),
('B01', 'Blue Widget', 7.95);
