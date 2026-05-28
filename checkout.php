<?php 
include 'includes/db.php';
include 'includes/functions.php';

if (!isLoggedIn()) {
    redirect('login.php?checkout=true');
}

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    redirect('menu.php');
}

$user_id = $_SESSION['user_id'];
$cart_items = [];
$total = 0;

$ids = implode(',', array_keys($_SESSION['cart']));
$sql = "SELECT * FROM products WHERE id IN ($ids)";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    $row['quantity'] = $_SESSION['cart'][$row['id']];
    $row['subtotal'] = $row['price'] * $row['quantity'];
    $total += $row['subtotal'];
    $cart_items[] = $row;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 1. Create Order
    $order_sql = "INSERT INTO orders (user_id, total_amount) VALUES ($user_id, $total)";
    if (mysqli_query($conn, $order_sql)) {
        $order_id = mysqli_insert_id($conn);
        
        // 2. Create Order Items
        foreach ($cart_items as $item) {
            $pid = $item['id'];
            $qty = $item['quantity'];
            $price = $item['price'];
            $item_sql = "INSERT INTO order_items (order_id, product_id, quantity, price_at_purchase) 
                         VALUES ($order_id, $pid, $qty, $price)";
            mysqli_query($conn, $item_sql);
        }
        
        // 3. Clear Cart
        unset($_SESSION['cart']);
        $success_msg = "Order placed successfully! Order ID: #$order_id";
    }
}

include 'includes/header.php'; 
?>

<section class="py-20 bg-cream min-h-screen">
    <div class="container mx-auto px-4 max-w-2xl">
        <h1 class="text-4xl font-bold mb-12 text-coffee-dark font-serif text-center">Checkout</h1>

        <?php if (isset($success_msg)): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-2xl text-center shadow-lg">
                <h2 class="text-2xl font-bold mb-2">Thank You!</h2>
                <p class="mb-6"><?php echo $success_msg; ?></p>
                <a href="index.php" class="bg-coffee-dark text-white px-8 py-2 rounded-full inline-block">Back to Home</a>
            </div>
        <?php else: ?>
            <div class="bg-white p-8 rounded-2xl shadow-xl">
                <h2 class="text-2xl font-bold mb-6 text-coffee-dark border-b pb-4">Order Review</h2>
                <div class="space-y-4 mb-8">
                    <?php foreach ($cart_items as $item): ?>
                        <div class="flex justify-between text-gray-700">
                            <span><?php echo $item['name']; ?> (x<?php echo $item['quantity']; ?>)</span>
                            <span class="font-bold"><?php echo number_format($item['subtotal']); ?> FRW</span>
                        </div>
                    <?php endforeach; ?>
                    <div class="flex justify-between text-2xl font-bold text-coffee-dark border-t pt-4 mt-4">
                        <span>Total to Pay</span>
                        <span><?php echo number_format($total); ?> FRW</span>
                    </div>
                </div>

                <form action="checkout.php" method="POST">
                    <button type="submit" class="w-full bg-coffee-dark text-white py-4 rounded-lg font-bold hover:bg-coffee-light transition hover-lift">Confirm & Place Order</button>
                </form>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
