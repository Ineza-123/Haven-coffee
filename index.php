<?php include 'includes/header.php'; ?>

<!-- Hero Section -->
<section class="relative h-screen flex items-center justify-center text-center text-white">
    <div class="absolute inset-0 bg-black opacity-50 z-10"></div>
    <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?ixlib=rb-1.2.1&auto=format&fit=crop&w=1350&q=80');"></div>
    
    <div class="relative z-20 px-4 animate-fade-in">
        <h1 class="text-5xl md:text-7xl font-bold mb-4 font-serif">Welcome to Haven Coffee Shop</h1>
        <p class="text-xl md:text-2xl italic mb-8 text-beige">"Fresh Coffee, Warm Moments, and Sweet Memories."</p>
        <div class="flex flex-col md:flex-row justify-center space-y-4 md:space-y-0 md:space-x-4">
            <a href="menu.php" class="bg-beige text-coffee-dark px-8 py-3 rounded-full text-lg font-semibold hover:bg-white transition hover-lift">Explore Menu</a>
            <a href="about.php" class="border-2 border-beige text-beige px-8 py-3 rounded-full text-lg font-semibold hover:bg-beige hover:text-coffee-dark transition hover-lift">Our Story</a>
        </div>
    </div>
</section>

<!-- Features / Testimonials -->
<section class="py-20 bg-cream">
    <div class="container mx-auto px-4">
        <h2 class="text-4xl font-bold text-center mb-16 text-coffee-dark">Why Choose Haven?</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
            <div class="text-center p-8 bg-white rounded-xl shadow-sm hover-lift">
                <div class="text-4xl mb-4 text-coffee-light">☕</div>
                <h3 class="text-2xl font-bold mb-4">Premium Beans</h3>
                <p class="text-gray-600">Sourced from the finest organic farms across the globe.</p>
            </div>
            <div class="text-center p-8 bg-white rounded-xl shadow-sm hover-lift">
                <div class="text-4xl mb-4 text-coffee-light">🍵</div>
                <h3 class="text-2xl font-bold mb-4">Aromatic Teas</h3>
                <p class="text-gray-600">Premium tea leaves infused with rich spices and flavors.</p>
            </div>
            <div class="text-center p-8 bg-white rounded-xl shadow-sm hover-lift">
                <div class="text-4xl mb-4 text-coffee-light">✨</div>
                <h3 class="text-2xl font-bold mb-4">Cozy Ambience</h3>
                <p class="text-gray-600">The perfect spot for work, meetings, or just a quiet moment.</p>
            </div>
        </div>
    </div>
</section>

<!-- Featured Testimonial -->
<section class="py-20 bg-coffee-dark text-cream">
    <div class="container mx-auto px-4 text-center">
        <div class="max-w-3xl mx-auto">
            <p class="text-3xl italic mb-8 font-serif">"The atmosphere is so warm and welcoming. It's truly my little haven in the middle of a busy city."</p>
            <div class="flex items-center justify-center space-x-4">
                <img src="https://i.pravatar.cc/100?u=sarah" alt="Customer" class="w-16 h-16 rounded-full border-2 border-beige">
                <div class="text-left">
                    <h4 class="font-bold">Sarah Johnson</h4>
                    <p class="text-beige text-sm">Regular Customer</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
