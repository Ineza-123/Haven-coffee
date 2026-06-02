<?php
include 'includes/db.php';

echo "<h1>Starting Database Setup...</h1>";

$queries = [
    'CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL,
        email VARCHAR(100) NOT NULL UNIQUE,
        phone VARCHAR(20),
        password VARCHAR(255) NOT NULL,
        role ENUM(\'customer\', \'admin\') DEFAULT \'customer\',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB',

    'CREATE TABLE IF NOT EXISTS products (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        description TEXT,
        price DECIMAL(10,2) NOT NULL,
        category VARCHAR(50) NOT NULL,
        image_url VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB',

    'CREATE TABLE IF NOT EXISTS orders (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        total_amount DECIMAL(10,2) NOT NULL,
        status ENUM(\'pending\', \'completed\', \'cancelled\') DEFAULT \'pending\',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    ) ENGINE=InnoDB',

    'CREATE TABLE IF NOT EXISTS order_items (
        id INT AUTO_INCREMENT PRIMARY KEY,
        order_id INT NOT NULL,
        product_id INT NOT NULL,
        quantity INT NOT NULL,
        price_at_purchase DECIMAL(10,2) NOT NULL,
        FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
        FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
    ) ENGINE=InnoDB',

    'REPLACE INTO users (id, username, email, password, role) VALUES 
    (1, \'admin\', \'kai955595@gmail.com\', \'$2y$10$vI8qO6/Z.VpW3/7v8.x8eO2uQy8p5Z1F7fG/U2z9XoI8y6w5Yk1zG\', \'admin\')',

    'INSERT IGNORE INTO products (name, description, price, category, image_url) VALUES
    (\'Cappuccino\', \'Rich espresso with steamed milk and foam.\', 2500, \'Coffee\', \'cappuccino.jpg\'),
    (\'Coffee Latte\', \'Smooth espresso with steamed milk.\', 2500, \'Coffee\', \'latte.jpg\'),
    (\'Mocha\', \'Espresso with chocolate and steamed milk.\', 3000, \'Coffee\', \'mocha.jpg\'),
    (\'African Coffee\', \'Traditional African brewed coffee.\', 3000, \'Coffee\', \'african_coffee.jpg\'),
    (\'Espresso\', \'Pure and bold espresso shot.\', 2000, \'Coffee\', \'espresso.jpg\'),
    (\'African Tea\', \'Strong and aromatic African tea.\', 2500, \'Teas\', \'african_tea.jpg\'),
    (\'Iced Latte\', \'Chilled espresso with cold milk and ice.\', 3000, \'Cold Drinks\', \'iced_latte.jpg\')'
];

foreach ($queries as $sql) {
    if (mysqli_query($conn, $sql)) {
        echo "<p style='color:green;'>Success: Table/Data created.</p>";
    } else {
        echo "<p style='color:red;'>Error: " . mysqli_error($conn) . "</p>";
    }
}

echo "<h2>Setup Complete! You can now delete this file and go to your home page.</h2>";
?>
