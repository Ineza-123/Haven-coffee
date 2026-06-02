<?php
// Database configuration using environment variables
// We check getenv(), $_SERVER, and $_ENV to be as robust as possible on Vercel
$host = getenv('DB_HOST') ?: ($_SERVER['DB_HOST'] ?? ($_ENV['DB_HOST'] ?? '127.0.0.1'));
$user = getenv('DB_USER') ?: ($_SERVER['DB_USER'] ?? ($_ENV['DB_USER'] ?? 'root'));
$pass = getenv('DB_PASS') ?: ($_SERVER['DB_PASS'] ?? ($_ENV['DB_PASS'] ?? ''));
$db   = getenv('DB_NAME') ?: ($_SERVER['DB_NAME'] ?? ($_ENV['DB_NAME'] ?? 'haven_coffee'));
$port = getenv('DB_PORT') ?: ($_SERVER['DB_PORT'] ?? ($_ENV['DB_PORT'] ?? '3306'));

// On Vercel, localhost/127.0.0.1 will never work.
if (($host == 'localhost' || $host == '127.0.0.1') && getenv('VERCEL')) {
    $found = [];
    if (getenv('DB_HOST') || isset($_SERVER['DB_HOST'])) $found[] = 'DB_HOST';
    if (getenv('DB_USER') || isset($_SERVER['DB_USER'])) $found[] = 'DB_USER';
    if (getenv('DB_NAME') || isset($_SERVER['DB_NAME'])) $found[] = 'DB_NAME';
    
    $found_str = empty($found) ? "None" : implode(", ", $found);
    
    die("<h1>Database Config Missing</h1>
         <p>Vercel detected, but <b>DB_HOST</b> is still defaulting to 127.0.0.1.</p>
         <p><b>Detected Variables:</b> $found_str</p>
         <hr>
         <p><b>Troubleshooting:</b><br>
         1. Go to Vercel Project Settings > Environment Variables.<br>
         2. Ensure the names are EXACTLY <b>DB_HOST, DB_USER, DB_PASS, DB_PORT, DB_NAME</b>.<br>
         3. Ensure they are assigned to the <b>'Production'</b> environment.<br>
         4. <b>IMPORTANT:</b> You must create a <u>NEW</u> Deployment (Redeploy) after saving variables.</p>");
}

try {
    $conn = mysqli_connect($host, $user, $pass, $db, $port);
} catch (mysqli_sql_exception $e) {
    die("<h1>Database Error</h1><p>Could not connect to: <b>$host</b> on port <b>$port</b></p><p>Error: " . $e->getMessage() . "</p>");
}

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
