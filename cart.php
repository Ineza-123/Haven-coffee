<?php 
include 'includes/db.php';
include 'includes/header.php'; 

// Handle quantity updates
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['update_qty'])) {
        $pid = $_POST['product_id'];
        $qty = (int)$_POST['quantity'];
        if ($qty > 0) {
            $_SESSION['cart'][$pid] = $qty;
        } else {
            unset($_SESSION['cart'][$pid]);
        }
    }
    if (isset($_POST['remove'])) {
        $pid = $_POST['product_id'];
        unset($_SESSION['cart'][$pid]);
    }
    // Refresh to update header count and avoid resubmission
    redirect('cart.php');
}

$cart_items = [];
$total = 0;

if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    $ids = implode(',', array_keys($_SESSION['cart']));
    $sql = "SELECT * FROM products WHERE id IN ($ids)";
    $result = mysqli_query($conn, $sql);
    
    while ($row = mysqli_fetch_assoc($result)) {
        $row['quantity'] = $_SESSION['cart'][$row['id']];
        $row['subtotal'] = $row['price'] * $row['quantity'];
        $total += $row['subtotal'];
        $cart_items[] = $row;
    }
}
?>

<section class="py-20 bg-cream min-h-screen">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold mb-12 text-coffee-dark font-serif text-center">Your Coffee Cart</h1>

        <?php if (empty($cart_items)): ?>
            <div class="text-center bg-white p-12 rounded-2xl shadow-xl">
                <p class="text-xl text-gray-600 mb-8">Your cart is currently empty.</p>
                <a href="menu.php" class="bg-coffee-dark text-white px-8 py-3 rounded-full hover:bg-coffee-light transition">Back to Menu</a>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">
                <!-- Cart Items -->
                <div class="lg:col-span-2 space-y-6">
                    <?php foreach ($cart_items as $item): ?>
                        <div class="bg-white p-6 rounded-2xl shadow-md flex flex-col md:flex-row items-center gap-6">
                            <img src="https://images.unsplash.com/photo-1509042239860-f550ce710b93?auto=format&fit=crop&w=300&q=80" alt="<?php echo $item['name']; ?>" class="w-24 h-24 object-cover rounded-lg">
                            <div class="flex-grow text-center md:text-left">
                                <h3 class="text-xl font-bold text-coffee-dark"><?php echo $item['name']; ?></h3>
                                <p class="text-coffee-light font-semibold"><?php echo number_format($item['price']); ?> FRW</p>
                            </div>
                            <div class="flex items-center gap-4">
                                <form action="cart.php" method="POST" class="flex items-center gap-2">
                                    <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                                    <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" class="w-16 px-2 py-1 border rounded-lg text-center">
                                    <button type="submit" name="update_qty" class="text-blue-600 hover:underline text-sm">Update</button>
                                </form>
                                <form action="cart.php" method="POST">
                                    <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                                    <button type="submit" name="remove" class="text-red-500 hover:text-red-700">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                            <div class="text-right font-bold text-coffee-dark min-w-[100px]">
                                <?php echo number_format($item['subtotal']); ?> FRW
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <!-- Summary -->
                <div class="bg-white p-8 rounded-2xl shadow-xl h-fit sticky top-24">
                    <h2 class="text-2xl font-bold mb-6 text-coffee-dark">Order Summary</h2>
                    <div class="flex justify-between mb-4 border-b pb-4">
                        <span class="text-gray-600">Subtotal</span>
                        <span class="font-bold"><?php echo number_format($total); ?> FRW</span>
                    </div>
                    <div class="flex justify-between mb-8 text-xl font-bold">
                        <span>Total</span>
                        <span class="text-coffee-dark"><?php echo number_format($total); ?> FRW</span>
                    </div>
                    <a href="checkout.php" class="block w-full text-center bg-coffee-dark text-white py-4 rounded-lg font-bold hover:bg-coffee-light transition hover-lift">Proceed to Checkout</a>
                    <a href="menu.php" class="block w-full text-center mt-4 text-coffee-light hover:underline">Continue Shopping</a>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
