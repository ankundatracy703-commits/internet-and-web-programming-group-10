-- DineEasy Restaurant Management System Database
-- Run this script to create the database

-- Create database
CREATE DATABASE IF NOT EXISTS dineeasy;
USE dineeasy;

-- Users table (customers and admins)
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    phone VARCHAR(20),
    password VARCHAR(255) NOT NULL,
    role ENUM('customer', 'admin') DEFAULT 'customer',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Menu items table
CREATE TABLE IF NOT EXISTS menu_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    category ENUM('appetizer', 'main', 'dessert', 'drink') DEFAULT 'main',
    image_url VARCHAR(255),
    available BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Reservations table
CREATE TABLE IF NOT EXISTS reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    phone VARCHAR(20) NOT NULL,
    date DATE NOT NULL,
    time TIME NOT NULL,
    party_size INT NOT NULL,
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

-- Orders table
CREATE TABLE IF NOT EXISTS orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    total_amount DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'preparing', 'ready', 'delivered', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

-- Order items table
CREATE TABLE IF NOT EXISTS order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    menu_item_id INT NOT NULL,
    quantity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (menu_item_id) REFERENCES menu_items(id) ON DELETE CASCADE
);

-- Insert sample menu items
INSERT INTO menu_items (name, description, price, category) VALUES
('Caesar Salad', 'Fresh romaine lettuce with caesar dressing and croutons', 12.99, 'appetizer'),
('Garlic Bread', 'Toasted bread with garlic butter and herbs', 6.99, 'appetizer'),
('Chicken Wings', 'Crispy wings with your choice of sauce', 14.99, 'appetizer'),
('Grilled Salmon', 'Fresh Atlantic salmon with lemon butter sauce', 28.99, 'main'),
('Ribeye Steak', '12oz ribeye with seasonal vegetables', 34.99, 'main'),
('Chicken Parmesan', 'Breaded chicken with marinara and mozzarella', 22.99, 'main'),
('Pasta Primavera', 'Mixed vegetables in garlic olive oil', 18.99, 'main'),
('Beef Burger', 'Angus beef patty with all the fixings', 16.99, 'main'),
('Chocolate Lava Cake', 'Warm chocolate cake with molten center', 10.99, 'dessert'),
('Cheesecake', 'New York style cheesecake', 9.99, 'dessert'),
('Tiramisu', 'Classic Italian coffee-flavored dessert', 11.99, 'dessert'),
('Soft Drinks', 'Coke, Sprite, or Fanta', 3.99, 'drink'),
('Fresh Juice', 'Orange, Apple, or Mango', 5.99, 'drink'),
('Coffee', 'Regular or decaf', 3.99, 'drink');