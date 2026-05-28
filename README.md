# Haven Coffee Shop

A modern, elegant, and fully responsive coffee shop website built with PHP, MySQL, and Tailwind CSS.

## Features
- **Luxurious Design:** Warm coffee-inspired color palette and premium typography.
- **Dynamic Menu:** Categorized items with "Add to Cart" functionality.
- **Shopping Cart:** Session-based cart for a seamless experience.
- **Secure Auth:** User registration and login with password hashing.
- **Admin Dashboard:** Full management of products, users, and orders.
- **Interactive:** Lightbox gallery, smooth animations, and responsive layout.

## Setup Instructions

### 1. Database Setup
1. Open PHPMyAdmin or your MySQL client.
2. Create a new database named `haven_coffee`.
3. Import the `database.sql` file provided in the root directory.

### 2. Configuration
1. Open `includes/db.php`.
2. Update the `$host`, `$user`, `$pass`, and `$db` variables if your local MySQL settings are different.

### 3. Admin Access
- **Email:** `admin@havencoffee.com`
- **Password:** `admin123`

## Directory Structure
- `/admin`: Admin dashboard management.
- `/assets`: CSS, JS, and image assets.
- `/includes`: Reusable PHP components (header, footer, DB, functions).
- Root files: Main website pages.
