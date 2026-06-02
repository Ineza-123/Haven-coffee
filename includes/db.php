<?php
// Database configuration using environment variables
$host = getenv('DB_HOST') ?: ($_ENV['DB_HOST'] ?? '127.0.0.1');
$user = getenv('DB_USER') ?: ($_ENV['DB_USER'] ?? 'root');
$pass = getenv('DB_PASS') ?: ($_ENV['DB_PASS'] ?? '');
$db   = getenv('DB_NAME') ?: ($_ENV['DB_NAME'] ?? 'haven_coffee');

// On Vercel, localhost/127.0.0.1 will never work.
if (($host == 'localhost' || $host == '127.0.0.1') && getenv('VERCEL')) {
    die("<h1>Database Config Missing</h1><p>Vercel detected, but no <b>DB_HOST</b> found. <br>Please add <b>DB_HOST, DB_USER, DB_PASS, DB_NAME</b> to your <b>Vercel Project Settings > Environment Variables</b>.</p>");
}

try {
    $conn = mysqli_connect($host, $user, $pass, $db);
} catch (mysqli_sql_exception $e) {
    die("<h1>Database Error</h1><p>Could not connect to: <b>$host</b></p><p>Error: " . $e->getMessage() . "</p>");
}

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
