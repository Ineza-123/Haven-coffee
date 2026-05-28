<?php 
include '../includes/db.php';
include '../includes/functions.php';

if (!isAdmin()) {
    redirect('../login.php');
}

$message = '';

// Handle Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    mysqli_query($conn, "DELETE FROM products WHERE id = $id");
    $message = "Product deleted successfully.";
}

// Handle Add
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_product'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $desc = mysqli_real_escape_string($conn, $_POST['description']);
    $price = (float)$_POST['price'];
    $cat = $_POST['category'];
    
    mysqli_query($conn, "INSERT INTO products (name, description, price, category) VALUES ('$name', '$desc', $price, '$cat')");
    $message = "Product added successfully.";
}

$products = mysqli_query($conn, "SELECT * FROM products ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products | Haven Admin</title>
    <link rel="stylesheet" href="../assets/css/tailwind.css">
</head>
<body class="bg-gray-100 flex min-h-screen">

<aside class="w-64 bg-slate-800 text-white flex-shrink-0">
    <div class="p-6"><h1 class="text-2xl font-bold font-serif tracking-widest">HAVEN ADMIN</h1></div>
    <nav class="mt-6">
        <a href="index.php" class="block px-6 py-3 hover:bg-slate-700 transition">Dashboard</a>
        <a href="products.php" class="block px-6 py-3 bg-slate-700">Products</a>
        <a href="orders.php" class="block px-6 py-3 hover:bg-slate-700 transition">Orders</a>
        <a href="users.php" class="block px-6 py-3 hover:bg-slate-700 transition">Users</a>
    </nav>
</aside>

<main class="flex-grow p-10">
    <header class="flex justify-between items-center mb-10">
        <h2 class="text-3xl font-bold text-gray-800">Manage Products</h2>
        <button onclick="document.getElementById('add-modal').classList.remove('hidden')" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-bold">Add New Product</button>
    </header>

    <?php if ($message): ?>
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-600 text-sm uppercase">
                <tr>
                    <th class="px-6 py-4">Name</th>
                    <th class="px-6 py-4">Category</th>
                    <th class="px-6 py-4">Price</th>
                    <th class="px-6 py-4">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                <?php while ($p = mysqli_fetch_assoc($products)): ?>
                <tr>
                    <td class="px-6 py-4 font-bold text-gray-800"><?php echo $p['name']; ?></td>
                    <td class="px-6 py-4 italic text-gray-500"><?php echo ucfirst($p['category']); ?></td>
                    <td class="px-6 py-4"><?php echo number_format($p['price']); ?> FRW</td>
                    <td class="px-6 py-4">
                        <a href="products.php?delete=<?php echo $p['id']; ?>" class="text-red-500 hover:underline font-bold" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</main>

<!-- Add Product Modal -->
<div id="add-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl w-full max-w-md p-8">
        <h3 class="text-2xl font-bold mb-6">Add New Product</h3>
        <form action="products.php" method="POST" class="space-y-4">
            <div>
                <label class="block font-bold mb-1">Product Name</label>
                <input type="text" name="name" class="w-full border rounded-lg p-2" required>
            </div>
            <div>
                <label class="block font-bold mb-1">Description</label>
                <textarea name="description" class="w-full border rounded-lg p-2" required></textarea>
            </div>
            <div>
                <label class="block font-bold mb-1">Price (FRW)</label>
                <input type="number" step="1" name="price" class="w-full border rounded-lg p-2" required>
            </div>
            <div>
                <label class="block font-bold mb-1">Category</label>
                <select name="category" class="w-full border rounded-lg p-2">
                    <option value="Coffee">Coffee</option>
                    <option value="Teas">Teas</option>
                    <option value="Cold Drinks">Cold Drinks</option>
                </select>
            </div>
            <div class="flex justify-end gap-4 mt-6">
                <button type="button" onclick="document.getElementById('add-modal').classList.add('hidden')" class="px-4 py-2 text-gray-600">Cancel</button>
                <button type="submit" name="add_product" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-bold">Save Product</button>
            </div>
        </form>
    </div>
</div>

</body>
</html>
