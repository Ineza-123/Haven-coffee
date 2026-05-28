<?php 
include '../includes/db.php';
include '../includes/functions.php';

if (!isAdmin()) {
    redirect('../login.php');
}

// Stats
$user_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM users"))['total'];
$product_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM products"))['total'];
$order_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM orders"))['total'];
$revenue = mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(total_amount) as total FROM orders WHERE status = 'completed'"))['total'] ?? 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Haven Coffee</title>
    <link rel="stylesheet" href="../assets/css/tailwind.css">
</head>
<body class="bg-gray-100 flex min-h-screen">

<!-- Sidebar -->
<aside class="w-64 bg-slate-800 text-white flex-shrink-0">
    <div class="p-6">
        <h1 class="text-2xl font-bold font-serif tracking-widest">HAVEN ADMIN</h1>
    </div>
    <nav class="mt-6">
        <a href="index.php" class="block px-6 py-3 bg-slate-700">Dashboard</a>
        <a href="products.php" class="block px-6 py-3 hover:bg-slate-700 transition">Products</a>
        <a href="orders.php" class="block px-6 py-3 hover:bg-slate-700 transition">Orders</a>
        <a href="users.php" class="block px-6 py-3 hover:bg-slate-700 transition">Users</a>
        <a href="../index.php" class="block px-6 py-3 hover:bg-slate-700 transition mt-auto border-t border-slate-700">View Site</a>
        <a href="../logout.php" class="block px-6 py-3 hover:bg-slate-700 transition">Logout</a>
    </nav>
</aside>

<!-- Main Content -->
<main class="flex-grow p-10">
    <header class="flex justify-between items-center mb-10">
        <h2 class="text-3xl font-bold text-gray-800">Overview</h2>
        <div class="text-gray-600">Welcome, <?php echo $_SESSION['username']; ?></div>
    </header>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-12">
        <div class="bg-white p-6 rounded-xl shadow-md border-b-4 border-blue-500">
            <h3 class="text-gray-500 text-sm font-bold uppercase mb-2">Total Users</h3>
            <p class="text-3xl font-bold"><?php echo $user_count; ?></p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md border-b-4 border-green-500">
            <h3 class="text-gray-500 text-sm font-bold uppercase mb-2">Total Products</h3>
            <p class="text-3xl font-bold"><?php echo $product_count; ?></p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md border-b-4 border-yellow-500">
            <h3 class="text-gray-500 text-sm font-bold uppercase mb-2">Total Orders</h3>
            <p class="text-3xl font-bold"><?php echo $order_count; ?></p>
        </div>
        <div class="bg-white p-6 rounded-xl shadow-md border-b-4 border-red-500">
            <h3 class="text-gray-500 text-sm font-bold uppercase mb-2">Total Revenue</h3>
            <p class="text-3xl font-bold">$<?php echo number_format($revenue, 2); ?></p>
        </div>
    </div>

    <!-- Recent Orders (Simple Table) -->
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <div class="p-6 border-b">
            <h3 class="font-bold text-gray-800 text-lg">Recent Orders</h3>
        </div>
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-600 text-sm uppercase">
                <tr>
                    <th class="px-6 py-4">ID</th>
                    <th class="px-6 py-4">Amount</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Date</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                <?php 
                $recent_orders = mysqli_query($conn, "SELECT * FROM orders ORDER BY created_at DESC LIMIT 5");
                while ($order = mysqli_fetch_assoc($recent_orders)): 
                ?>
                <tr>
                    <td class="px-6 py-4">#<?php echo $order['id']; ?></td>
                    <td class="px-6 py-4">$<?php echo number_format($order['total_amount'], 2); ?></td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-full text-xs font-bold 
                            <?php echo $order['status'] === 'completed' ? 'bg-green-100 text-green-700' : ($order['status'] === 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700'); ?>">
                            <?php echo strtoupper($order['status']); ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-500"><?php echo date('M d, Y', strtotime($order['created_at'])); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</main>

</body>
</html>
