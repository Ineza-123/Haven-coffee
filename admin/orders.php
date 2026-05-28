<?php 
include '../includes/db.php';
include '../includes/functions.php';

if (!isAdmin()) {
    redirect('../login.php');
}

$message = '';

// Update Status
if (isset($_POST['update_status'])) {
    $oid = (int)$_POST['order_id'];
    $status = $_POST['status'];
    mysqli_query($conn, "UPDATE orders SET status = '$status' WHERE id = $oid");
    $message = "Order #$oid updated to $status.";
}

$orders = mysqli_query($conn, "SELECT orders.*, users.username FROM orders JOIN users ON orders.user_id = users.id ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders | Haven Admin</title>
    <link rel="stylesheet" href="../assets/css/tailwind.css">
</head>
<body class="bg-gray-100 flex min-h-screen">

<aside class="w-64 bg-slate-800 text-white flex-shrink-0">
    <div class="p-6"><h1 class="text-2xl font-bold font-serif tracking-widest">HAVEN ADMIN</h1></div>
    <nav class="mt-6">
        <a href="index.php" class="block px-6 py-3 hover:bg-slate-700 transition">Dashboard</a>
        <a href="products.php" class="block px-6 py-3 hover:bg-slate-700 transition">Products</a>
        <a href="orders.php" class="block px-6 py-3 bg-slate-700">Orders</a>
        <a href="users.php" class="block px-6 py-3 hover:bg-slate-700 transition">Users</a>
    </nav>
</aside>

<main class="flex-grow p-10">
    <header class="mb-10">
        <h2 class="text-3xl font-bold text-gray-800">Manage Orders</h2>
    </header>

    <?php if ($message): ?>
        <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-6">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-600 text-sm uppercase">
                <tr>
                    <th class="px-6 py-4">ID</th>
                    <th class="px-6 py-4">Customer</th>
                    <th class="px-6 py-4">Total</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4">Update</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                <?php while ($o = mysqli_fetch_assoc($orders)): ?>
                <tr>
                    <td class="px-6 py-4 font-bold text-gray-800">#<?php echo $o['id']; ?></td>
                    <td class="px-6 py-4"><?php echo $o['username']; ?></td>
                    <td class="px-6 py-4 font-bold"><?php echo number_format($o['total_amount']); ?> FRW</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-full text-xs font-bold 
                            <?php echo $o['status'] === 'completed' ? 'bg-green-100 text-green-700' : ($o['status'] === 'pending' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700'); ?>">
                            <?php echo strtoupper($o['status']); ?>
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <form action="orders.php" method="POST" class="flex gap-2">
                            <input type="hidden" name="order_id" value="<?php echo $o['id']; ?>">
                            <select name="status" class="border rounded px-2 py-1 text-sm">
                                <option value="pending" <?php echo $o['status'] === 'pending' ? 'selected' : ''; ?>>Pending</option>
                                <option value="completed" <?php echo $o['status'] === 'completed' ? 'selected' : ''; ?>>Completed</option>
                                <option value="cancelled" <?php echo $o['status'] === 'cancelled' ? 'selected' : ''; ?>>Cancelled</option>
                            </select>
                            <button type="submit" name="update_status" class="bg-gray-800 text-white px-3 py-1 rounded text-xs">Update</button>
                        </form>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</main>

</body>
</html>
