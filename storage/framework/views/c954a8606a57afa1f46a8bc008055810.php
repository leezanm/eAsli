<!-- Splash Popup Modal -->
<div id="splashModal" class="fixed inset-0 flex items-center justify-center bg-black/50 backdrop-blur-sm hidden" style="z-index: 9999;">
    <div class="relative w-full max-w-2xl mx-4 bg-white rounded-3xl shadow-2xl animate-in fade-in zoom-in duration-300 max-h-[90vh] overflow-y-auto">
        <!-- Close Button -->
        <button onclick="closeSplash()" class="absolute top-4 right-4 inline-flex items-center justify-center w-10 h-10 rounded-full bg-neutral-100 hover:bg-neutral-200 text-neutral-700 transition" style="z-index: 10000;">
            <i class="fas fa-times text-xl"></i>
        </button>

        <!-- Content -->
        <div class="p-8 md:p-10">
            <!-- Header -->
            <div class="text-center mb-8">
                <span class="inline-block bg-gradient-to-r from-accent-500 to-accent-600 text-white px-4 py-2 rounded-full font-bold text-xs uppercase tracking-wider mb-4">
                    ✨ Favorites Product
                </span>
                <h2 class="text-3xl md:text-4xl font-bold text-neutral-900 mb-2">Today's Discovery</h2>
                <p class="text-neutral-600 text-sm md:text-base">Check out this beautiful product from our artisans</p>
            </div>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <?php $__empty_1 = true; $__currentLoopData = $randomProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="relative group rounded-2xl overflow-hidden bg-white border-2 border-neutral-200 hover:border-primary-400 transition-all duration-300 hover:shadow-xl <?php echo e($index == 1 ? 'md:col-span-2 md:row-span-2' : ''); ?>">
                    <!-- Product Image -->
                    <div class="relative w-full <?php echo e($index == 1 ? 'h-96' : 'h-48'); ?> bg-gradient-to-br from-neutral-200 to-neutral-300 overflow-hidden">
                        <?php if($product->image_path): ?>
                            <img src="<?php echo e(asset('storage/' . $product->image_path)); ?>" alt="<?php echo e($product->name); ?>" class="w-full h-full object-cover group-hover:scale-110 transition duration-500">
                        <?php else: ?>
                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-primary-100 to-secondary-100">
                                <i class="fas fa-box text-neutral-400 text-6xl"></i>
                            </div>
                        <?php endif; ?>

                        <!-- Badge -->
                        <div class="absolute top-3 right-3">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold text-white bg-gradient-to-r from-primary-600 to-primary-700 shadow-lg">
                                <i class="fas fa-star mr-1"></i>Featured
                            </span>
                        </div>

                        <!-- Stock Status -->
                        <?php if($product->stock <= 5): ?>
                            <div class="absolute bottom-3 left-3">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold text-white bg-gradient-to-r from-red-500 to-red-600 shadow-lg">
                                    <i class="fas fa-exclamation-circle mr-1"></i>Low Stock
                                </span>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Product Info -->
                    <div class="p-4 flex flex-col">
                        <p class="text-xs text-neutral-600 font-semibold uppercase tracking-wider mb-1"><?php echo e(ucfirst($product->category)); ?></p>
                        <h3 class="text-lg font-bold text-neutral-900 line-clamp-2 mb-2 group-hover:text-primary-700 transition"><?php echo e($product->name); ?></h3>

                        <?php if($product->artisan): ?>
                            <p class="text-xs text-primary-700 font-semibold mb-2 flex items-center gap-1">
                                <i class="fas fa-user-circle"></i>
                                <?php echo e($product->artisan->name); ?>

                            </p>
                        <?php endif; ?>

                        <p class="text-sm text-neutral-600 line-clamp-2 mb-3 flex-grow"><?php echo e(Str::limit($product->description, 80)); ?></p>

                        <div class="flex items-center justify-between gap-2">
                            <p class="text-2xl font-bold text-primary-700">RM <?php echo e(number_format($product->price, 2)); ?></p>
                            <a href="<?php echo e(route('products.show', $product)); ?>" class="inline-flex items-center gap-2 px-3 py-2 rounded-lg bg-gradient-to-r from-primary-600 to-primary-700 text-white text-xs font-bold hover:shadow-lg transition">
                                <i class="fas fa-eye"></i>
                                View
                            </a>
                        </div>
                    </div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-span-full text-center py-12">
                    <i class="fas fa-box-open text-5xl text-neutral-300 mb-3"></i>
                    <p class="text-neutral-600 font-semibold">No products available</p>
                </div>
                <?php endif; ?>
            </div>

            <!-- Call to Action -->
            <div class="border-t border-neutral-200 pt-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                    <a href="<?php echo e(route('products.shop')); ?>" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg bg-gradient-to-r from-accent-500 to-accent-600 text-white font-bold shadow-lg hover:shadow-xl transition transform hover:scale-105">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Browse All Products</span>
                    </a>
                    <button onclick="closeSplash()" class="inline-flex items-center justify-center gap-2 px-6 py-3 rounded-lg border-2 border-neutral-300 text-neutral-700 font-bold hover:bg-neutral-50 transition">
                        <i class="fas fa-times"></i>
                        <span>Maybe Later</span>
                    </button>
                </div>
            </div>

            <!-- Refresh Button -->
            <div class="flex justify-center mt-4">
                <button onclick="refreshSplash()" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg text-sm font-semibold text-primary-700 hover:bg-primary-50 transition">
                    <i class="fas fa-redo"></i>
                    <span>Show Different Products</span>
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes zoomIn {
        from {
            transform: scale(0.95);
            opacity: 0;
        }
        to {
            transform: scale(1);
            opacity: 1;
        }
    }

    .animate-in.fade-in {
        animation: fadeIn 0.3s ease-in-out;
    }

    .animate-in.zoom-in {
        animation: zoomIn 0.3s ease-in-out;
    }
</style>

<script>
    function closeSplash() {
        const modal = document.getElementById('splashModal');
        modal.classList.add('hidden');
        // Store in sessionStorage so it doesn't show again during this session
        sessionStorage.setItem('splashClosed', 'true');
    }

    function refreshSplash() {
        // Reload the page to get new random products
        location.reload();
    }

    function showSplash() {
        const modal = document.getElementById('splashModal');
        // Check if user already closed it this session
        if (sessionStorage.getItem('splashClosed') !== 'true') {
            modal.classList.remove('hidden');
        }
    }

    // Show splash when page loads (after a small delay for better UX)
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(showSplash, 800);
    });
</script>
<?php /**PATH /Users/leezanm/eAsli-app/resources/views/splash-popup.blade.php ENDPATH**/ ?>