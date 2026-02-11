<?php $__env->startSection('title', 'Product Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto px-4 py-10">
    <!-- Back link -->
    <div class="mb-6 flex items-center justify-between gap-3">
        <a href="<?php echo e(route('products.index')); ?>" class="inline-flex items-center gap-2 text-sm font-medium text-neutral-700 hover:text-primary-700">
            <i class="fas fa-arrow-left"></i>
            <span>Back to Products</span>
        </a>
        <?php if(auth()->guard('artisan')->check()): ?>
            <div class="flex items-center gap-3">
                <a href="<?php echo e(route('products.edit', $product)); ?>" class="inline-flex items-center gap-2 px-3 py-2 rounded-lg border border-primary-300 text-xs font-semibold text-primary-700 hover:bg-primary-50">
                    <i class="fas fa-edit"></i>
                    <span>Edit</span>
                </a>
                <form method="POST" action="<?php echo e(route('products.destroy', $product)); ?>" onsubmit="return confirm('Are you sure you want to delete this product?')">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="inline-flex items-center gap-2 px-3 py-2 rounded-lg border border-red-300 text-xs font-semibold text-red-600 hover:bg-red-50">
                        <i class="fas fa-trash"></i>
                        <span>Delete</span>
                    </button>
                </form>
            </div>
        <?php endif; ?>
    </div>

    <div class="bg-white rounded-2xl shadow-lg border border-secondary-200 overflow-hidden">
        <div class="grid grid-cols-1 md:grid-cols-2">
            <!-- Image / visual -->
            <div class="bg-secondary-50 flex items-center justify-center p-8">
                <?php if($product->image_path): ?>
                    <img src="<?php echo e(Storage::url($product->image_path)); ?>" alt="<?php echo e($product->name); ?>" class="w-full max-h-80 object-contain rounded-xl shadow-md">
                <?php else: ?>
                    <div class="w-40 h-40 rounded-2xl bg-gradient-to-br from-primary-100 to-secondary-100 flex items-center justify-center">
                        <i class="fas fa-box text-5xl text-neutral-400"></i>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Details -->
            <div class="p-8 flex flex-col gap-4">
                <div>
                    <h1 class="text-2xl md:text-3xl font-bold text-neutral-900 mb-1 flex items-center gap-2">
                        <i class="fas fa-box text-primary-600"></i>
                        <span><?php echo e($product->name); ?></span>
                    </h1>
                    <?php if($product->artisan): ?>
                        <p class="text-sm text-neutral-600">by <span class="font-semibold text-primary-700"><?php echo e($product->artisan->name); ?></span></p>
                    <?php endif; ?>
                </div>

                <div class="flex flex-wrap gap-3 text-xs">
                    <span class="inline-flex items-center px-3 py-1 rounded-full bg-primary-50 text-primary-700 font-semibold">
                        <i class="fas fa-folder-open mr-1"></i>
                        <?php echo e(ucfirst($product->category)); ?>

                    </span>
                    <span class="inline-flex items-center px-3 py-1 rounded-full font-semibold <?php echo e($product->status === 'available' ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700'); ?>">
                        <span class="w-1.5 h-1.5 rounded-full mr-1.5 <?php echo e($product->status === 'available' ? 'bg-emerald-500' : 'bg-rose-500'); ?>"></span>
                        <?php echo e($product->status === 'available' ? 'Available' : 'Unavailable'); ?>

                    </span>
                </div>

                <div class="mt-2">
                    <p class="text-3xl font-bold text-primary-800">RM <?php echo e(number_format($product->price, 2)); ?></p>
                    <p class="mt-1 text-sm text-neutral-600">
                        <span class="font-semibold">Stock:</span>
                        <span class="ml-1"><?php echo e($product->stock); ?> units</span>
                        <?php if($product->stock <= 5): ?>
                            <span class="ml-2 inline-flex items-center gap-1 text-xs font-semibold text-red-600">
                                <i class="fas fa-exclamation-triangle"></i>
                                Low stock
                            </span>
                        <?php endif; ?>
                    </p>
                </div>

                <?php if($product->description): ?>
                    <div class="mt-4 border-t border-neutral-200 pt-4">
                        <h2 class="text-sm font-semibold text-neutral-900 uppercase tracking-wide mb-2">Description</h2>
                        <p class="text-sm text-neutral-700 leading-relaxed"><?php echo e($product->description); ?></p>
                    </div>
                <?php endif; ?>

                <div class="mt-6 border-t border-neutral-200 pt-4">
                    
                    <?php if(Auth::guard('customer')->check() || (Auth::guest() && !Auth::guard('artisan')->check())): ?>
                        <?php if($product->status === 'available' && $product->stock > 0): ?>
                            <form method="POST" action="<?php echo e(route('cart.add', $product)); ?>" class="flex items-center gap-3">
                                <?php echo csrf_field(); ?>
                                <div>
                                    <label for="quantity" class="block text-xs font-semibold text-neutral-700 uppercase tracking-wide mb-1">Quantity</label>
                                    <input type="number" id="quantity" name="quantity" min="1" max="<?php echo e($product->stock); ?>" value="1" class="w-20 px-3 py-2 border border-neutral-300 rounded-lg text-sm focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-200">
                                </div>
                                <button type="submit" class="inline-flex items-center justify-center gap-2 px-5 py-3 mt-4 rounded-lg bg-gradient-to-r from-accent-500 to-accent-600 text-white text-sm font-semibold shadow-md hover:from-accent-600 hover:to-accent-700 transition">
                                    <i class="fas fa-cart-plus"></i>
                                    <span>Add to Cart</span>
                                </button>
                            </form>
                        <?php else: ?>
                            <div class="p-4 rounded-lg bg-rose-50 border border-rose-200 text-rose-700 text-sm font-medium flex items-center gap-2">
                                <i class="fas fa-exclamation-circle"></i>
                                <span>This product is currently unavailable</span>
                            </div>
                        <?php endif; ?>
                   
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/leezanm/eAsli-app/resources/views/products/show.blade.php ENDPATH**/ ?>