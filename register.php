<?php 
include 'includes/db.php';
include 'includes/functions.php';

if (isLoggedIn()) {
    redirect('index.php');
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";
        
        if (mysqli_query($conn, $sql)) {
            redirect('login.php?registered=true');
        } else {
            $error = "Registration failed. Email might already exist.";
        }
    }
}

include 'includes/header.php'; 
?>

<section class="py-20 bg-cream min-h-screen flex items-center">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto bg-white p-8 rounded-2xl shadow-2xl">
            <h1 class="text-3xl font-bold text-center mb-8 text-coffee-dark font-serif">Join Our Haven</h1>
            
            <?php if ($error): ?>
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>

            <form action="register.php" method="POST" class="space-y-6">
                <div>
                    <label class="block text-coffee-dark font-bold mb-2">Username</label>
                    <input type="text" name="username" class="w-full px-4 py-3 rounded-lg border border-beige focus:outline-none focus:ring-2 focus:ring-coffee-light" required>
                </div>
                <div>
                    <label class="block text-coffee-dark font-bold mb-2">Email Address</label>
                    <input type="email" name="email" class="w-full px-4 py-3 rounded-lg border border-beige focus:outline-none focus:ring-2 focus:ring-coffee-light" required>
                </div>
                <div>
                    <label class="block text-coffee-dark font-bold mb-2">Phone Number</label>
                    <input type="text" name="phone" class="w-full px-4 py-3 rounded-lg border border-beige focus:outline-none focus:ring-2 focus:ring-coffee-light" placeholder="(250) 791..." required>
                </div>
                <div>
                    <label class="block text-coffee-dark font-bold mb-2">Password</label>
                    <input type="password" name="password" class="w-full px-4 py-3 rounded-lg border border-beige focus:outline-none focus:ring-2 focus:ring-coffee-light" required>
                </div>
                <div>
                    <label class="block text-coffee-dark font-bold mb-2">Confirm Password</label>
                    <input type="password" name="confirm_password" class="w-full px-4 py-3 rounded-lg border border-beige focus:outline-none focus:ring-2 focus:ring-coffee-light" required>
                </div>
                <button type="submit" class="w-full bg-coffee-dark text-white py-4 rounded-lg font-bold hover:bg-coffee-light transition hover-lift">Create Account</button>
            </form>

            <p class="text-center mt-8 text-gray-600">
                Already have an account? <a href="login.php" class="text-coffee-dark font-bold hover:underline">Login here</a>
            </p>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
