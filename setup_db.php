<?php
$host = 'localhost';
$user = 'root';
$pass = '';

// Connect without database first
$conn = mysqli_connect($host, $user, $pass);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Create Database
$sql = "CREATE DATABASE IF NOT EXISTS haven_coffee";
if (mysqli_query($conn, $sql)) {
    echo "Database created or already exists.<br>";
} else {
    echo "Error creating database: " . mysqli_error($conn) . "<br>";
}

// Select Database
mysqli_select_db($conn, 'haven_coffee');

// Drop existing tables to ensure clean state
mysqli_query($conn, "DROP TABLE IF EXISTS order_items");
mysqli_query($conn, "DROP TABLE IF EXISTS orders");
mysqli_query($conn, "DROP TABLE IF EXISTS products");
mysqli_query($conn, "DROP TABLE IF EXISTS users");

// 1. users Table
$sql = "CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(20),
    password VARCHAR(255) NOT NULL,
    role ENUM('customer', 'admin') DEFAULT 'customer',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB";
mysqli_query($conn, $sql);

// 2. products Table
$sql = "CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    category VARCHAR(50) NOT NULL,
    image_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB";
mysqli_query($conn, $sql);

// 3. orders Table
$sql = "CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    status ENUM('pending', 'completed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
) ENGINE=InnoDB";
mysqli_query($conn, $sql);

// 4. order_items Table
$sql = "CREATE TABLE order_items (
    id INT AUTO_INCREMENT PRIMARY KEY,
    order_id INT NOT NULL,
    product_id INT NOT NULL,
    quantity INT NOT NULL,
    price_at_purchase DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
) ENGINE=InnoDB";
mysqli_query($conn, $sql);

// Initial Admin Account (Password: admin123)
$admin_pass = password_hash('admin123', PASSWORD_DEFAULT);
mysqli_query($conn, "INSERT INTO users (username, email, password, role) VALUES ('admin', 'kai955595@gmail.com', '$admin_pass', 'admin')");

// Seed Products
$products = [
    ['Cappuccino', 'Rich espresso with steamed milk and foam.', 2500, 'Coffee', 'cappuccino.jpg'],
    ['Coffee Latte', 'Smooth espresso with steamed milk.', 2500, 'Coffee', 'latte.jpg'],
    ['Flat White', 'Espresso with thin layer of velvety milk.', 2500, 'Coffee', 'flat_white.jpg'],
    ['Mocha', 'Espresso with chocolate and steamed milk.', 3000, 'Coffee', 'mocha.jpg'],
    ['African Coffee', 'Traditional African brewed coffee.', 3000, 'Coffee', 'african_coffee.jpg'],
    ['Espresso', 'Pure and bold espresso shot.', 2000, 'Coffee', 'espresso.jpg'],
    ['Black Coffee', 'Classic brewed black coffee.', 2000, 'Coffee', 'black_coffee.jpg'],
    ['Americano', 'Espresso diluted with hot water.', 2000, 'Coffee', 'americano.jpg'],
    ['Macchiato', 'Espresso with a dash of frothy milk.', 2000, 'Coffee', 'macchiato.jpg'],
    ['Extra Short', 'A quick, intense espresso shot.', 1000, 'Coffee', 'extra_short.jpg'],
    ['African Tea', 'Strong and aromatic African tea.', 2500, 'Teas', 'african_tea.jpg'],
    ['Hot Chocolate', 'Rich and creamy cocoa drink.', 2500, 'Teas', 'hot_chocolate.jpg'],
    ['Black Tea', 'Classic premium black tea.', 2000, 'Teas', 'black_tea.jpg'],
    ['Hot Milk', 'Warm and comforting fresh milk.', 1500, 'Teas', 'hot_milk.jpg'],
    ['Spice Tea', 'Black tea infused with aromatic spices.', 3000, 'Teas', 'spice_tea.jpg'],
    ['Iced Latte', 'Chilled espresso with cold milk and ice.', 3000, 'Cold Drinks', 'iced_latte.jpg'],
    ['Iced Cappuccino', 'Cold espresso with foamy chilled milk.', 3000, 'Cold Drinks', 'iced_cappuccino.jpg'],
    ['Iced Mocha', 'Cold espresso with chocolate and ice.', 3500, 'Cold Drinks', 'iced_mocha.jpg'],
    ['Iced Americano', 'Espresso over ice and cold water.', 2500, 'Cold Drinks', 'iced_americano.jpg']
];

foreach ($products as $p) {
    mysqli_query($conn, "INSERT INTO products (name, description, price, category, image_url) VALUES ('$p[0]', '$p[1]', $p[2], '$p[3]', '$p[4]')");
}

echo "All tables created and seeded successfully!<br>";
echo "<a href='index.php'>Go to Homepage</a>";
?>
