<?php $__env->startSection('title', 'Shopping Cart'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto px-4 py-10">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl md:text-4xl font-bold text-neutral-900 flex items-center gap-3">
                <span class="inline-flex items-center justify-center w-11 h-11 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-600 text-white shadow-lg">
                    <i class="fas fa-shopping-bag text-lg"></i>
                </span>
                <span>Your Cart</span>
            </h1>
            <p class="mt-2 text-neutral-600 text-sm md:text-base">Review items you want to purchase before checkout.</p>
        </div>
        <a href="<?php echo e(route('products.index')); ?>" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-neutral-300 text-sm font-medium text-neutral-700 hover:bg-neutral-50 transition">
            <i class="fas fa-arrow-left"></i>
            <span>Continue Shopping</span>
        </a>
    </div>

    <?php if(empty($items)): ?>
        <div class="bg-white rounded-2xl border border-secondary-200 shadow-md py-12 px-6 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-secondary-100 text-secondary-700 mb-4">
                <i class="fas fa-shopping-basket text-2xl"></i>
            </div>
            <h2 class="text-xl font-semibold text-neutral-900 mb-1">Your cart is empty</h2>
            <p class="text-neutral-600 mb-4">Browse products and add items to your cart to get started.</p>
            <a href="<?php echo e(route('products.index')); ?>" class="inline-flex items-center gap-2 px-5 py-3 rounded-lg bg-gradient-to-r from-accent-500 to-accent-600 text-white text-sm font-semibold shadow-md hover:from-accent-600 hover:to-accent-700 transition">
                <i class="fas fa-box"></i>
                <span>Browse Products</span>
            </a>
        </div>
    <?php else: ?>
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Cart items -->
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-md border border-secondary-200 p-6">
                <h2 class="text-lg font-semibold text-neutral-900 mb-4 flex items-center gap-2">
                    <i class="fas fa-list"></i>
                    <span>Items in Cart</span>
                </h2>

                <div class="divide-y divide-neutral-200">
                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php ($product = $line['product']); ?>
                        <div class="py-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div class="flex items-start gap-4 flex-1">
                                <div class="w-16 h-16 rounded-lg bg-secondary-50 flex items-center justify-center overflow-hidden">
                                    <?php if($product->image_path): ?>
                                        <img src="<?php echo e(Storage::url($product->image_path)); ?>" alt="<?php echo e($product->name); ?>" class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <i class="fas fa-box text-neutral-400"></i>
                                    <?php endif; ?>
                                </div>
                                <div>
                                    <h3 class="text-sm font-semibold text-neutral-900"><?php echo e($product->name); ?></h3>
                                    <p class="text-xs text-neutral-500 mt-1">Category: <?php echo e(ucfirst($product->category)); ?></p>
                                    <p class="text-xs text-neutral-500 mt-1">Unit price: RM <?php echo e(number_format($line['unit_price'], 2)); ?></p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4">
                                <form method="POST" action="<?php echo e(route('cart.update', $product)); ?>" class="flex items-center gap-2">
                                    <?php echo csrf_field(); ?>
                                    <input type="number" name="quantity" min="1" value="<?php echo e($line['quantity']); ?>" class="w-16 px-2 py-1 border border-neutral-300 rounded-lg text-sm text-center">
                                    <button type="submit" class="inline-flex items-center px-3 py-1 rounded-lg border border-neutral-300 text-xs font-semibold text-neutral-700 hover:bg-neutral-50">
                                        Update
                                    </button>
                                </form>
                                <div class="text-right">
                                    <p class="text-sm font-semibold text-neutral-900">RM <?php echo e(number_format($line['total'], 2)); ?></p>
                                    <form method="POST" action="<?php echo e(route('cart.remove', $product)); ?>" class="mt-1">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="inline-flex items-center gap-1 text-xs text-red-600 hover:text-red-700">
                                            <i class="fas fa-trash"></i>
                                            <span>Remove</span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <!-- Summary -->
            <div class="bg-white rounded-2xl shadow-md border border-secondary-200 p-6 flex flex-col justify-between">
                <div>
                    <h2 class="text-lg font-semibold text-neutral-900 mb-4 flex items-center gap-2">
                        <i class="fas fa-receipt"></i>
                        <span>Order Summary</span>
                    </h2>
                    <div class="flex items-center justify-between text-sm mb-2">
                        <span class="text-neutral-600">Subtotal</span>
                        <span class="font-semibold text-neutral-900">RM <?php echo e(number_format($total, 2)); ?></span>
                    </div>
                    <p class="text-xs text-neutral-500 mb-4">Prices are inclusive of any applicable taxes. Shipping is handled directly by artisans.</p>
                </div>

                <form method="POST" action="<?php echo e(route('cart.checkout')); ?>" class="mt-4">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-5 py-3 rounded-lg bg-gradient-to-r from-primary-600 to-primary-500 text-white text-sm font-semibold shadow-md hover:from-primary-700 hover:to-primary-600 transition">
                        <i class="fas fa-credit-card"></i>
                        <span>Checkout</span>
                    </button>
                </form>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/leezanm/eAsli-app/resources/views/cart/index.blade.php ENDPATH**/ ?>