<?php 
include 'includes/db.php';
include 'includes/header.php'; 

$categories = ['Coffee', 'Teas', 'Cold Drinks'];
?>

<section class="py-20 bg-cream">
    <div class="container mx-auto px-4">
        <h1 class="text-5xl font-bold text-center mb-16 text-coffee-dark font-serif">Our Menu</h1>

        <?php foreach ($categories as $cat): 
            $query = "SELECT * FROM products WHERE category = '$cat'";
            $products = mysqli_query($conn, $query);
            if (mysqli_num_rows($products) > 0):
        ?>
            <div class="mb-20">
                <h2 class="text-3xl font-bold mb-8 text-coffee-light border-b-2 border-beige pb-2 font-serif">
                    <?php 
                        if ($cat == 'Coffee') echo '☕ Coffee';
                        elseif ($cat == 'Teas') echo '🍵 Teas';
                        elseif ($cat == 'Cold Drinks') echo '🧊 Cold Drinks';
                        else echo $cat;
                    ?>
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php while ($product = mysqli_fetch_assoc($products)): ?>
                        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover-lift flex flex-col">
                            <img src="https://images.unsplash.com/photo-1509042239860-f550ce710b93?auto=format&fit=crop&w=600&q=80" alt="<?php echo $product['name']; ?>" class="w-full h-48 object-cover">
                            <div class="p-6 flex-grow flex flex-col">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="text-xl font-bold text-coffee-dark"><?php echo $product['name']; ?></h3>
                                    <span class="text-lg font-bold text-coffee-light"><?php echo number_format($product['price']); ?> FRW</span>
                                </div>
                                <p class="text-gray-600 text-sm mb-6 flex-grow"><?php echo $product['description']; ?></p>
                                <button onclick="addToCart(<?php echo $product['id']; ?>)" class="w-full bg-coffee-dark text-white py-2 rounded-lg font-semibold hover:bg-coffee-light transition">Add to Cart</button>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php 
            endif;
        endforeach; ?>
    </div>
</section>

<script>
function addToCart(productId) {
    const formData = new FormData();
    formData.append('product_id', productId);

    fetch('ajax_cart.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update cart count in header
            const cartCounts = document.querySelectorAll('.absolute.-top-2.-right-2, #mobile-menu a[href="cart.php"]');
            cartCounts.forEach(el => {
                if (el.classList.contains('absolute')) {
                    el.innerText = data.count;
                } else {
                    el.innerText = `Cart (${data.count})`;
                }
            });
            
            // Optional: Show a toast/notification
            alert('Added to cart!');
        }
    });
}
</script>

<?php include 'includes/footer.php'; ?>
