<?php include_once 'functions.php'; ?>
<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Haven Coffee Shop | Fresh Coffee & Warm Moments</title>
    <link rel="stylesheet" href="assets/css/tailwind.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-cream">

<nav class="bg-coffee-dark text-cream p-4 sticky top-0 z-50 shadow-lg">
    <div class="container mx-auto flex justify-between items-center">
        <a href="index.php" class="text-2xl font-bold tracking-widest font-serif">HAVEN</a>
        
        <div class="hidden md:flex space-x-6 items-center">
            <a href="index.php" class="hover:text-beige transition">Home</a>
            <a href="menu.php" class="hover:text-beige transition">Menu</a>
            <a href="about.php" class="hover:text-beige transition">About</a>
            <a href="gallery.php" class="hover:text-beige transition">Gallery</a>
            <a href="contact.php" class="hover:text-beige transition">Contact</a>
            
            <a href="cart.php" class="relative">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                </svg>
                <span class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center"><?php echo getCartCount(); ?></span>
            </a>

            <?php if (isLoggedIn()): ?>
                <?php if (isAdmin()): ?>
                    <a href="admin/index.php" class="bg-beige text-coffee-dark px-4 py-1 rounded hover:bg-white transition">Admin</a>
                <?php endif; ?>
                <a href="logout.php" class="hover:text-beige transition">Logout</a>
            <?php else: ?>
                <a href="login.php" class="hover:text-beige transition">Login</a>
                <a href="register.php" class="bg-beige text-coffee-dark px-4 py-1 rounded hover:bg-white transition">Register</a>
            <?php endif; ?>
        </div>

        <!-- Mobile Menu Button -->
        <div class="md:hidden">
            <button id="mobile-menu-btn">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden bg-coffee-light p-4 mt-4 space-y-4">
        <a href="index.php" class="block">Home</a>
        <a href="menu.php" class="block">Menu</a>
        <a href="about.php" class="block">About</a>
        <a href="gallery.php" class="block">Gallery</a>
        <a href="contact.php" class="block">Contact</a>
        <a href="cart.php" class="block">Cart (<?php echo getCartCount(); ?>)</a>
        <?php if (isLoggedIn()): ?>
            <a href="logout.php" class="block">Logout</a>
        <?php else: ?>
            <a href="login.php" class="block">Login</a>
            <a href="register.php" class="block">Register</a>
        <?php endif; ?>
    </div>
</nav>

<script>
    document.getElementById('mobile-menu-btn').addEventListener('click', function() {
        document.getElementById('mobile-menu').classList.toggle('hidden');
    });
</script>
