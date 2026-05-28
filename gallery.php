<?php include 'includes/header.php'; ?>

<section class="py-20 bg-cream">
    <div class="container mx-auto px-4">
        <h1 class="text-5xl font-bold text-center mb-16 text-coffee-dark font-serif">Captured Moments</h1>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            <!-- Gallery Items -->
            <div class="gallery-item cursor-pointer overflow-hidden rounded-xl shadow-lg hover-lift">
                <img src="https://images.unsplash.com/photo-1509042239860-f550ce710b93?auto=format&fit=crop&w=800&q=80" alt="Coffee" class="w-full h-80 object-cover transition duration-500 hover:scale-110">
            </div>
            <div class="gallery-item cursor-pointer overflow-hidden rounded-xl shadow-lg hover-lift">
                <img src="https://images.unsplash.com/photo-1442512595331-e89e73853f31?auto=format&fit=crop&w=800&q=80" alt="Interior" class="w-full h-80 object-cover transition duration-500 hover:scale-110">
            </div>
            <div class="gallery-item cursor-pointer overflow-hidden rounded-xl shadow-lg hover-lift">
                <img src="https://images.unsplash.com/photo-1512568400610-62da28bc8a13?auto=format&fit=crop&w=800&q=80" alt="Coffee Cup" class="w-full h-80 object-cover transition duration-500 hover:scale-110">
            </div>
            <div class="gallery-item cursor-pointer overflow-hidden rounded-xl shadow-lg hover-lift">
                <img src="https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?auto=format&fit=crop&w=800&q=80" alt="Pastries" class="w-full h-80 object-cover transition duration-500 hover:scale-110">
            </div>
            <div class="gallery-item cursor-pointer overflow-hidden rounded-xl shadow-lg hover-lift">
                <img src="https://images.unsplash.com/photo-1511920170033-f8396924c348?auto=format&fit=crop&w=800&q=80" alt="Barista" class="w-full h-80 object-cover transition duration-500 hover:scale-110">
            </div>
            <div class="gallery-item cursor-pointer overflow-hidden rounded-xl shadow-lg hover-lift">
                <img src="https://images.unsplash.com/photo-1459755486867-b55449bb39ff?auto=format&fit=crop&w=800&q=80" alt="Beans" class="w-full h-80 object-cover transition duration-500 hover:scale-110">
            </div>
        </div>
    </div>
</section>

<!-- Lightbox -->
<div id="lightbox" class="flex">
    <span class="close-lightbox">&times;</span>
    <img id="lightbox-img" src="" alt="Zoomed">
</div>

<script>
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    const galleryItems = document.querySelectorAll('.gallery-item img');
    const closeBtn = document.querySelector('.close-lightbox');

    galleryItems.forEach(img => {
        img.addEventListener('click', () => {
            lightbox.style.display = 'flex';
            lightboxImg.src = img.src;
        });
    });

    closeBtn.addEventListener('click', () => {
        lightbox.style.display = 'none';
    });

    lightbox.addEventListener('click', (e) => {
        if (e.target === lightbox) {
            lightbox.style.display = 'none';
        }
    });
</script>

<?php include 'includes/footer.php'; ?>
