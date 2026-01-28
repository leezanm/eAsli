<?php $__env->startSection('title', 'Shops'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 py-10">
    <!-- Page header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl md:text-4xl font-bold text-neutral-900 flex items-center gap-3">
                <span class="inline-flex items-center justify-center w-11 h-11 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-600 text-white shadow-lg">
                    <i class="fas fa-shop text-lg"></i>
                </span>
                <span>Shops</span>
            </h1>
            <p class="mt-2 text-neutral-600 text-sm md:text-base">Manage all artisan shops in a clean, modern view.</p>
        </div>
        <div class="flex items-center gap-3">
             <?php if(auth('web')->check()): ?>
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-neutral-300 text-sm font-medium text-neutral-700 hover:bg-neutral-50 transition">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Dashboard</span>
                </a>
            <?php elseif(Auth::guard('artisan')->check()): ?>
             <a href="<?php echo e(route('artisans.dashboard')); ?>" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-neutral-300 text-sm font-medium text-neutral-700 hover:bg-neutral-50 transition">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Dashboard</span>
            </a>
            <?php else: ?>
                <button onclick="history.back()" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-neutral-300 text-sm font-medium text-neutral-700 hover:bg-neutral-50 transition">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to list</span>
                </button>
            <?php endif; ?>


            <?php if(auth()->guard('artisan')->check()): ?>
                <a href="<?php echo e(route('shops.create')); ?>" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-gradient-to-r from-primary-600 to-primary-500 text-white text-sm font-semibold shadow-md hover:from-primary-700 hover:to-primary-600 transition">
                    <i class="fas fa-plus"></i>
                    <span>Add New Shop</span>
                </a>
            <?php endif; ?>
        </div>
    </div>

    <?php if($shops->isEmpty()): ?>
        <!-- Empty state -->
        <div class="bg-white rounded-2xl border border-secondary-200 shadow-md py-12 px-6 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-secondary-100 text-secondary-700 mb-4">
                <i class="fas fa-inbox text-2xl"></i>
            </div>
            <h2 class="text-xl font-semibold text-neutral-900 mb-1">No shops yet</h2>
            <p class="text-neutral-600 mb-4">Start by adding a new shop to display your products.</p>
            <?php if(auth()->guard('artisan')->check()): ?>
                <a href="<?php echo e(route('shops.create')); ?>" class="inline-flex items-center gap-2 px-5 py-3 rounded-lg bg-gradient-to-r from-accent-500 to-accent-600 text-white text-sm font-semibold shadow-md hover:from-accent-600 hover:to-accent-700 transition">
                    <i class="fas fa-plus"></i>
                    <span>Add Shop</span>
                </a>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <!-- Shops grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__currentLoopData = $shops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white rounded-2xl border border-secondary-200 shadow-md hover:shadow-xl transition transform hover:-translate-y-1 flex flex-col">
                    <div class="p-6 flex-1 flex flex-col gap-3">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <h2 class="text-lg font-semibold text-neutral-900 flex items-center gap-2">
                                    <i class="fas fa-store text-primary-600"></i>
                                    <span><?php echo e($shop->name); ?></span>
                                </h2>
                                <?php if($shop->address ?? $shop->location): ?>
                                    <p class="mt-1 text-sm text-neutral-600">
                                        <i class="fas fa-map-marker-alt text-accent-600 mr-1"></i>
                                        <?php echo e($shop->address ?? $shop->location); ?>

                                    </p>
                                <?php endif; ?>
                            </div>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold <?php echo e($shop->status === 'active' ? 'bg-green-50 text-green-700' : 'bg-red-50 text-red-700'); ?>">
                                <?php echo e($shop->status === 'active' ? 'Active' : 'Closed'); ?>

                            </span>
                        </div>

                        <div class="mt-2 space-y-1 text-xs text-neutral-600">
                            <p>
                                <span class="font-semibold text-neutral-800">Products:</span>
                                <span class="ml-1"><?php echo e($shop->products_count ?? ($shop->products->count() ?? 0)); ?></span>
                            </p>
                            <?php if($shop->state): ?>
                                <p>
                                    <span class="font-semibold text-neutral-800">State:</span>
                                    <span class="ml-1"><?php echo e($shop->state); ?></span>
                                </p>
                            <?php endif; ?>
                            <?php if($shop->latitude && $shop->longitude): ?>
                                <p>
                                    <span class="font-semibold text-neutral-800">Coordinates:</span>
                                    <span class="ml-1"><?php echo e(number_format($shop->latitude, 4)); ?>, <?php echo e(number_format($shop->longitude, 4)); ?></span>
                                </p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="border-t border-neutral-200 px-6 py-4 flex items-center justify-between gap-3 bg-neutral-0/60">
                        <a href="<?php echo e(route('shops.show', $shop)); ?>" class="inline-flex items-center gap-2 text-xs font-semibold text-primary-700 hover:text-primary-800">
                            <i class="fas fa-eye"></i>
                            <span>View</span>
                        </a>
                        <?php if($shop->latitude && $shop->longitude): ?>
                            <a href="https://www.google.com/maps/?q=<?php echo e($shop->latitude); ?>,<?php echo e($shop->longitude); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 text-xs font-semibold text-accent-700 hover:text-accent-800">
                                <i class="fas fa-map"></i>
                                <span>Go to Shop</span>
                            </a>
                        <?php endif; ?>
                        <?php if(auth()->guard('artisan')->check()): ?>
                            <div class="flex items-center gap-3">
                                <a href="<?php echo e(route('shops.edit', $shop)); ?>" class="inline-flex items-center gap-1 px-3 py-1 rounded-md border border-primary-300 text-xs font-semibold text-primary-700 hover:bg-primary-50">
                                    <i class="fas fa-edit"></i>
                                    <span>Edit</span>
                                </a>
                                <form method="POST" action="<?php echo e(route('shops.destroy', $shop)); ?>" onsubmit="return confirm('Are you sure you want to delete this shop?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="inline-flex items-center gap-1 px-3 py-1 rounded-md border border-red-300 text-xs font-semibold text-red-600 hover:bg-red-50">
                                        <i class="fas fa-trash"></i>
                                        <span>Delete</span>
                                    </button>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/leezanm/eAsli-app/resources/views/shops/index.blade.php ENDPATH**/ ?>