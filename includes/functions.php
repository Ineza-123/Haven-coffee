<?php
session_start();

function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function redirect($url) {
    header("Location: $url");
    exit();
}

function getCartCount() {
    if (isset($_SESSION['cart'])) {
        return array_sum($_SESSION['cart']);
    }
    return 0;
}
?>
