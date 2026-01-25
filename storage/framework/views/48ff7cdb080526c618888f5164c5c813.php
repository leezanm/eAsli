<?php $__env->startSection('title', 'Shop Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 py-10">
    <!-- Back link -->
    <div class="mb-6">
        <a href="<?php echo e(route('shops.index')); ?>" class="inline-flex items-center gap-2 text-sm font-medium text-neutral-700 hover:text-primary-700">
            <i class="fas fa-arrow-left"></i>
            <span>Back to Shop List</span>
        </a>
    </div>

    <!-- Shop header -->
    <div class="bg-white rounded-2xl shadow-lg border border-secondary-200 p-8 mb-10">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-neutral-900 mb-2 flex items-center gap-3">
                    <span class="inline-flex items-center justify-center w-12 h-12 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-600 text-white">
                        <i class="fas fa-shop text-xl"></i>
                    </span>
                    <span><?php echo e($shop->name); ?></span>
                </h1>
                <?php if($shop->address): ?>
                    <p class="text-neutral-700 mb-1"><i class="fas fa-map-marker-alt text-accent-600 mr-2"></i><?php echo e($shop->address); ?></p>
                <?php endif; ?>
                <?php if($shop->state): ?>
                    <p class="text-neutral-700 mb-1"><i class="fas fa-flag text-primary-600 mr-2"></i><?php echo e($shop->state); ?></p>
                <?php endif; ?>
                <p class="text-sm text-neutral-500">
                    <span class="font-semibold">Status:</span>
                    <span class="ml-1 inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold <?php echo e($shop->status === 'active' ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700'); ?>">
                        <?php echo e($shop->status === 'active' ? 'Active' : 'Closed'); ?>

                    </span>
                </p>
                <?php if($shop->latitude && $shop->longitude): ?>
                    <p class="text-xs text-neutral-500 mt-2">Coordinates: <?php echo e(number_format($shop->latitude, 4)); ?>, <?php echo e(number_format($shop->longitude, 4)); ?></p>
                <?php endif; ?>
            </div>
            <div class="space-y-3">
                <div class="space-y-2 text-sm text-neutral-700">
                    <?php if($shop->artisan): ?>
                        <p class="flex items-center gap-2">
                            <i class="fas fa-user text-primary-600"></i>
                            <span><span class="font-semibold">Artisan:</span> <?php echo e($shop->artisan->name); ?></span>
                        </p>
                    <?php endif; ?>
                    <?php if($shop->phone): ?>
                        <p class="flex items-center gap-2">
                            <i class="fas fa-phone text-primary-600"></i>
                            <span><?php echo e($shop->phone); ?></span>
                        </p>
                    <?php endif; ?>
                </div>
                <?php if($shop->latitude && $shop->longitude): ?>
                    <a href="https://www.google.com/maps/?q=<?php echo e($shop->latitude); ?>,<?php echo e($shop->longitude); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center w-full gap-2 px-4 py-2 rounded-lg bg-gradient-to-r from-accent-500 to-accent-600 text-white text-sm font-semibold shadow-md hover:from-accent-600 hover:to-accent-700 transition">
                        <i class="fas fa-map"></i>
                        <span>Open on Google Maps</span>
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <?php if($shop->description): ?>
            <div class="mt-6 border-t border-neutral-200 pt-4">
                <h2 class="text-lg font-semibold text-neutral-900 mb-2">Shop Description</h2>
                <p class="text-neutral-700 leading-relaxed"><?php echo e($shop->description); ?></p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Products list -->
    <div class="bg-secondary-50 rounded-2xl border border-secondary-200 p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-neutral-900 flex items-center gap-2">
                <i class="fas fa-boxes-stacked text-primary-600"></i>
                <span>Products in this Shop</span>
            </h2>
            <span class="text-sm text-neutral-600">Total: <?php echo e($products->count()); ?></span>
        </div>

        <?php if($products->isEmpty()): ?>
            <div class="text-center py-10 text-neutral-500">
                <i class="fas fa-box-open text-5xl mb-3 text-neutral-300"></i>
                <p class="font-semibold">There are no products for this shop yet.</p>
            </div>
        <?php else: ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-white rounded-xl shadow-md border border-neutral-200 overflow-hidden flex flex-col">
                            <div class="h-40 bg-gradient-to-br from-primary-100 to-secondary-100 flex items-center justify-center">
                                <?php if($product->image_path): ?>
                                    <img src="<?php echo e(Storage::url($product->image_path)); ?>" alt="<?php echo e($product->name); ?>" class="w-full h-full object-cover">
                            <?php else: ?>
                                <i class="fas fa-box text-4xl text-neutral-400"></i>
                            <?php endif; ?>
                        </div>
                        <div class="p-4 flex-1 flex flex-col">
                            <h3 class="font-semibold text-neutral-900 mb-1 line-clamp-2"><?php echo e($product->name); ?></h3>
                            <?php if($product->price): ?>
                                <p class="text-primary-700 font-bold mb-2">RM <?php echo e(number_format($product->price, 2)); ?></p>
                            <?php endif; ?>
                            <?php if($product->description): ?>
                                <p class="text-sm text-neutral-600 line-clamp-3 mb-3"><?php echo e($product->description); ?></p>
                            <?php endif; ?>
                            <div class="mt-auto flex items-center justify-between text-xs text-neutral-500">
                                <span>Stock: <?php echo e($product->stock ?? '-'); ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/leezanm/eAsli-app/resources/views/shops/show.blade.php ENDPATH**/ ?>