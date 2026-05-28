<?php include 'includes/header.php'; ?>

<section class="py-20 bg-cream">
    <div class="container mx-auto px-4">
        <h1 class="text-5xl font-bold text-center mb-16 text-coffee-dark font-serif">Get in Touch</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div class="bg-white p-8 rounded-2xl shadow-xl">
                <form action="#" method="POST" class="space-y-6">
                    <div>
                        <label class="block text-coffee-dark font-bold mb-2">Full Name</label>
                        <input type="text" name="name" class="w-full px-4 py-3 rounded-lg border border-beige focus:outline-none focus:ring-2 focus:ring-coffee-light" placeholder="Your Name" required>
                    </div>
                    <div>
                        <label class="block text-coffee-dark font-bold mb-2">Email Address</label>
                        <input type="email" name="email" class="w-full px-4 py-3 rounded-lg border border-beige focus:outline-none focus:ring-2 focus:ring-coffee-light" placeholder="email@example.com" required>
                    </div>
                    <div>
                        <label class="block text-coffee-dark font-bold mb-2">Message</label>
                        <textarea name="message" rows="5" class="w-full px-4 py-3 rounded-lg border border-beige focus:outline-none focus:ring-2 focus:ring-coffee-light" placeholder="How can we help you?" required></textarea>
                    </div>
                    <button type="submit" class="w-full bg-coffee-dark text-white py-4 rounded-lg font-bold hover:bg-coffee-light transition hover-lift">Send Message</button>
                </form>
            </div>

            <!-- Info & Map -->
            <div class="space-y-8">
                <div>
                    <h3 class="text-2xl font-bold mb-4 text-coffee-dark">Visit Our Haven</h3>
                    <p class="text-gray-700 font-bold">SP Kabuga</p>
                    <p class="text-gray-700">Kabuga, Kigali, Rwanda</p>
                    <p class="text-gray-700">Phone: (250)791760609</p>
                    <p class="text-gray-700">Email: kai955595@gmail.com</p>
                    <p class="text-gray-700 mt-4">Monday - Friday: 7am - 9pm</p>
                    <p class="text-gray-700">Saturday - Sunday: 8am - 10pm</p>
                </div>
                
                <!-- Google Map Placeholder -->
                <div class="w-full h-80 rounded-2xl overflow-hidden shadow-lg">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d996.8594922076807!2d30.22087046952522!3d-1.9792616595701307!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19db59a0dd8b92e9%3A0x1f723c4c6d8cbc90!2sSP%20Kabuga!5e0!3m2!1sen!2srw!4v1779789477320!5m2!1sen!2srw" 
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>
