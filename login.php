<?php 
include 'includes/db.php';
include 'includes/functions.php';

if (isLoggedIn()) {
    redirect('index.php');
}

$error = '';
$success = isset($_GET['registered']) ? "Registration successful! Please login." : "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if ($user = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            
            if ($user['role'] === 'admin') {
                redirect('admin/index.php');
            } else {
                redirect('index.php');
            }
        } else {
            $error = "Invalid password.";
        }
    } else {
        $error = "No account found with that email.";
    }
}

include 'includes/header.php'; 
?>

<section class="py-20 bg-cream min-h-screen flex items-center">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto bg-white p-8 rounded-2xl shadow-2xl">
            <h1 class="text-3xl font-bold text-center mb-8 text-coffee-dark font-serif">Welcome Back</h1>
            
            <?php if ($error): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <?php if ($success): ?>
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                    <?php echo $success; ?>
                </div>
            <?php endif; ?>

            <form action="login.php" method="POST" class="space-y-6">
                <div>
                    <label class="block text-coffee-dark font-bold mb-2">Email Address</label>
                    <input type="email" name="email" class="w-full px-4 py-3 rounded-lg border border-beige focus:outline-none focus:ring-2 focus:ring-coffee-light" required>
                </div>
                <div>
                    <label class="block text-coffee-dark font-bold mb-2">Password</label>
                    <input type="password" name="password" class="w-full px-4 py-3 rounded-lg border border-beige focus:outline-none focus:ring-2 focus:ring-coffee-light" required>
                </div>
                <button type="submit" class="w-full bg-coffee-dark text-white py-4 rounded-lg font-bold hover:bg-coffee-light transition hover-lift">Login</button>
            </form>

            <p class="text-center mt-8 text-gray-600">
                Don't have an account? <a href="register.php" class="text-coffee-dark font-bold hover:underline">Register now</a>
            </p>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
