<?php $__env->startSection('title', 'View Sale'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-4xl mx-auto px-4 py-10">
    <!-- Page header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl md:text-4xl font-bold text-neutral-900 flex items-center gap-3">
                <span class="inline-flex items-center justify-center w-11 h-11 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-600 text-white shadow-lg">
                    <i class="fas fa-receipt text-lg"></i>
                </span>
                <span>Sale Details</span>
            </h1>
            <p class="mt-2 text-neutral-600 text-sm md:text-base">Transaction #<?php echo e($sale->id); ?></p>
        </div>
        <div class="flex items-center gap-3">
            <a href="<?php echo e(route('sales.index')); ?>" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-neutral-300 text-sm font-medium text-neutral-700 hover:bg-neutral-50 transition">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Sales</span>
            </a>
            <?php if(auth()->guard('artisan')->check()): ?>
                <a href="<?php echo e(route('sales.edit', $sale)); ?>" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-primary-600 hover:bg-primary-700 text-white text-sm font-semibold shadow-md transition">
                    <i class="fas fa-edit"></i>
                    <span>Edit</span>
                </a>
             <?php endif; ?>
        </div>
    </div>

    <!-- Main content grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Left column - Main details -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Sale Header Card -->
            <div class="bg-white rounded-2xl shadow-md border border-secondary-200 p-6">
                <div class="flex items-start justify-between gap-4 mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-neutral-900">Transaction #<?php echo e($sale->id); ?></h2>
                        <p class="text-sm text-neutral-600 mt-1 flex items-center gap-1">
                            <i class="fas fa-calendar-alt text-primary-600"></i>
                            <?php echo e($sale->sale_date->format('d M Y, H:i')); ?>

                        </p>
                    </div>
                    <span class="inline-flex items-center px-4 py-2 rounded-full font-semibold
                        <?php
                            $paymentStatus = $sale->payment_status ?? 'pending';
                            if ($paymentStatus === 'paid') {
                                $badgeClass = 'bg-emerald-50 text-emerald-700 border border-emerald-100';
                                $icon = 'fa-check-circle';
                            } elseif ($paymentStatus === 'failed') {
                                $badgeClass = 'bg-red-50 text-red-700 border border-red-100';
                                $icon = 'fa-times-circle';
                            } else {
                                $badgeClass = 'bg-amber-50 text-amber-700 border border-amber-100';
                                $icon = 'fa-clock';
                            }
                        ?>
                        <?php echo e($badgeClass); ?>">
                        <i class="fas <?php echo e($icon); ?> mr-2"></i>
                        <?php echo e(ucfirst(str_replace('_', ' ', $paymentStatus))); ?>

                    </span>
                </div>
                <div class="border-t border-neutral-200 pt-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="flex items-center gap-3">
                            <div class="inline-flex items-center justify-center w-12 h-12 rounded-lg bg-primary-100 text-primary-600">
                                <i class="fas fa-box text-lg"></i>
                            </div>
                            <div>
                                <p class="text-xs text-neutral-600 font-semibold uppercase">Quantity</p>
                                <p class="text-xl font-bold text-neutral-900"><?php echo e($sale->quantity); ?> unit<?php echo e($sale->quantity > 1 ? 's' : ''); ?></p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="inline-flex items-center justify-center w-12 h-12 rounded-lg bg-accent-100 text-accent-600">
                                <i class="fas fa-tag text-lg"></i>
                            </div>
                            <div>
                                <p class="text-xs text-neutral-600 font-semibold uppercase">Unit Price</p>
                                <p class="text-xl font-bold text-neutral-900">RM <?php echo e(number_format($sale->product->price, 2)); ?></p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="inline-flex items-center justify-center w-12 h-12 rounded-lg bg-secondary-100 text-secondary-600">
                                <i class="fas fa-money-bill text-lg"></i>
                            </div>
                            <div>
                                <p class="text-xs text-neutral-600 font-semibold uppercase">Total Amount</p>
                                <p class="text-xl font-bold text-secondary-900">RM <?php echo e(number_format($sale->total_price, 2)); ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Card -->
            <div class="bg-white rounded-2xl shadow-md border border-secondary-200 p-6">
                <h3 class="text-lg font-semibold text-neutral-900 mb-4 flex items-center gap-2">
                    <i class="fas fa-shopping-bag text-primary-600"></i>
                    Product Information
                </h3>
                <div class="space-y-4">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-sm text-neutral-600 font-semibold">Product Name</p>
                            <p class="text-lg font-semibold text-neutral-900 mt-1"><?php echo e($sale->product->name); ?></p>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-primary-50 text-primary-700">
                            <?php echo e(ucfirst($sale->product->category)); ?>

                        </span>
                    </div>
                    <?php if($sale->product->description): ?>
                        <div>
                            <p class="text-sm text-neutral-600 font-semibold">Description</p>
                            <p class="text-neutral-700 mt-1"><?php echo e($sale->product->description); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Notes Card -->
            <?php if($sale->notes): ?>
                <div class="bg-white rounded-2xl shadow-md border border-secondary-200 p-6">
                    <h3 class="text-lg font-semibold text-neutral-900 mb-4 flex items-center gap-2">
                        <i class="fas fa-sticky-note text-accent-600"></i>
                        Notes
                    </h3>
                    <p class="text-neutral-700 bg-neutral-50 rounded-lg p-4 border-l-4 border-accent-500"><?php echo e($sale->notes); ?></p>
                </div>
            <?php endif; ?>
        </div>

        <!-- Right column - Sidebar -->
        <div class="space-y-6">
            <!-- Artisan Card -->
            <div class="bg-white rounded-2xl shadow-md border border-secondary-200 p-6">
                <h3 class="text-sm font-semibold text-neutral-900 uppercase tracking-wider mb-4 flex items-center gap-2">
                    <i class="fas fa-user-tie text-primary-600"></i>
                    Artisan
                </h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-xs text-neutral-600 font-semibold">Name</p>
                        <p class="text-neutral-900 font-semibold mt-1"><?php echo e($sale->artisan->name); ?></p>
                    </div>
                    <?php if($sale->artisan->email): ?>
                        <div>
                            <p class="text-xs text-neutral-600 font-semibold">Email</p>
                            <a href="mailto:<?php echo e($sale->artisan->email); ?>" class="text-primary-700 hover:text-primary-800 font-semibold mt-1"><?php echo e($sale->artisan->email); ?></a>
                        </div>
                    <?php endif; ?>
                    <?php if($sale->artisan->phone): ?>
                        <div>
                            <p class="text-xs text-neutral-600 font-semibold">Phone</p>
                            <a href="tel:<?php echo e($sale->artisan->phone); ?>" class="text-primary-700 hover:text-primary-800 font-semibold mt-1"><?php echo e($sale->artisan->phone); ?></a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Customer Card -->
            <div class="bg-white rounded-2xl shadow-md border border-secondary-200 p-6">
                <h3 class="text-sm font-semibold text-neutral-900 uppercase tracking-wider mb-4 flex items-center gap-2">
                    <i class="fas fa-user text-accent-600"></i>
                    Customer
                </h3>
                <div class="space-y-3">
                    <div>
                        <p class="text-xs text-neutral-600 font-semibold">Name</p>
                        <p class="text-neutral-900 font-semibold mt-1"><?php echo e($sale->customer->name); ?></p>
                    </div>
                    <?php if($sale->customer->email): ?>
                        <div>
                            <p class="text-xs text-neutral-600 font-semibold">Email</p>
                            <a href="mailto:<?php echo e($sale->customer->email); ?>" class="text-accent-700 hover:text-accent-800 font-semibold mt-1 break-all"><?php echo e($sale->customer->email); ?></a>
                        </div>
                    <?php endif; ?>
                    <?php if($sale->customer->phone): ?>
                        <div>
                            <p class="text-xs text-neutral-600 font-semibold">Phone</p>
                            <a href="tel:<?php echo e($sale->customer->phone); ?>" class="text-accent-700 hover:text-accent-800 font-semibold mt-1"><?php echo e($sale->customer->phone); ?></a>
                        </div>
                    <?php endif; ?>
                    <?php if($sale->customer->address): ?>
                        <div>
                            <p class="text-xs text-neutral-600 font-semibold">Address</p>
                            <p class="text-neutral-700 mt-1 text-sm"><?php echo e($sale->customer->address); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Shop Card -->
            <?php if($sale->product->artisan->shops->first()): ?>
                <div class="bg-white rounded-2xl shadow-md border border-secondary-200 p-6">
                    <h3 class="text-sm font-semibold text-neutral-900 uppercase tracking-wider mb-4 flex items-center gap-2">
                        <i class="fas fa-store text-secondary-600"></i>
                        Shop
                    </h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-xs text-neutral-600 font-semibold">Name</p>
                            <a href="<?php echo e(route('shops.show', $sale->product->artisan->shops->first()->id)); ?>" class="text-secondary-700 hover:text-secondary-800 font-semibold mt-1"><?php echo e($sale->product->artisan->shops->first()->name); ?></a>
                        </div>
                        <?php if($sale->product->artisan->shops->first()->address): ?>
                            <div>
                                <p class="text-xs text-neutral-600 font-semibold">Address</p>
                                <p class="text-neutral-700 mt-1 text-sm"><?php echo e($sale->product->artisan->shops->first()->address); ?></p>
                            </div>
                        <?php endif; ?>
                        <?php if($sale->product->artisan->shops->first()->state): ?>
                            <div>
                                <p class="text-xs text-neutral-600 font-semibold">State</p>
                                <p class="text-neutral-700 mt-1 text-sm"><?php echo e($sale->product->artisan->shops->first()->state); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Meta Info Card -->
            <div class="bg-neutral-50 rounded-2xl border border-neutral-200 p-6">
                <h3 class="text-sm font-semibold text-neutral-900 uppercase tracking-wider mb-4">Information</h3>
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between items-center">
                        <span class="text-neutral-600">Created</span>
                        <span class="text-neutral-900 font-semibold"><?php echo e($sale->created_at->format('d M Y H:i')); ?></span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-neutral-600">Updated</span>
                        <span class="text-neutral-900 font-semibold"><?php echo e($sale->updated_at->format('d M Y H:i')); ?></span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-neutral-600">Payment Status</span>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold
                            <?php
                                $paymentStatus = $sale->payment_status ?? 'pending';
                                $statusColor = match($paymentStatus) {
                                    'paid' => 'bg-emerald-50 text-emerald-700',
                                    'failed' => 'bg-red-50 text-red-700',
                                    default => 'bg-amber-50 text-amber-700',
                                };
                            ?>
                            <?php echo e($statusColor); ?>">
                            <?php echo e(ucfirst($paymentStatus)); ?>

                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/leezanm/eAsli-app/resources/views/sales/show.blade.php ENDPATH**/ ?>