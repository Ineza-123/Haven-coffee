<?php 
include '../includes/db.php';
include '../includes/functions.php';

if (!isAdmin()) {
    redirect('../login.php');
}

$users = mysqli_query($conn, "SELECT * FROM users ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users | Haven Admin</title>
    <link rel="stylesheet" href="../assets/css/tailwind.css">
</head>
<body class="bg-gray-100 flex min-h-screen">

<aside class="w-64 bg-slate-800 text-white flex-shrink-0">
    <div class="p-6"><h1 class="text-2xl font-bold font-serif tracking-widest">HAVEN ADMIN</h1></div>
    <nav class="mt-6">
        <a href="index.php" class="block px-6 py-3 hover:bg-slate-700 transition">Dashboard</a>
        <a href="products.php" class="block px-6 py-3 hover:bg-slate-700 transition">Products</a>
        <a href="orders.php" class="block px-6 py-3 hover:bg-slate-700 transition">Orders</a>
        <a href="users.php" class="block px-6 py-3 bg-slate-700">Users</a>
    </nav>
</aside>

<main class="flex-grow p-10">
    <header class="mb-10">
        <h2 class="text-3xl font-bold text-gray-800">Registered Users</h2>
    </header>

    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-600 text-sm uppercase">
                <tr>
                    <th class="px-6 py-4">ID</th>
                    <th class="px-6 py-4">Username</th>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">Phone</th>
                    <th class="px-6 py-4">Role</th>
                    <th class="px-6 py-4">Joined</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                <?php while ($u = mysqli_fetch_assoc($users)): ?>
                <tr>
                    <td class="px-6 py-4 text-gray-500">#<?php echo $u['id']; ?></td>
                    <td class="px-6 py-4 font-bold"><?php echo $u['username']; ?></td>
                    <td class="px-6 py-4"><?php echo $u['email']; ?></td>
                    <td class="px-6 py-4"><?php echo $u['phone']; ?></td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 rounded-full text-xs font-bold <?php echo $u['role'] === 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-gray-100 text-gray-700'; ?>">
                            <?php echo strtoupper($u['role']); ?>
                        </span>
                    </td>
                    <td class="px-6 py-4 text-gray-500"><?php echo date('M d, Y', strtotime($u['created_at'])); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</main>

</body>
</html>
