<?php $__env->startSection('title', 'Sales'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-gradient-to-br from-neutral-100 to-neutral-50 min-h-screen py-10">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h1 class="text-3xl md:text-4xl font-bold text-primary-800 flex items-center gap-3">
                    <span class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-primary-100 text-primary-700">
                        <i class="fas fa-receipt"></i>
                    </span>
                    Sales
                </h1>
                <p class="mt-2 text-neutral-600">
                    Manage all sales transactions and revenue performance.
                </p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="<?php echo e(Auth::guard('artisan')->check() ? route('artisans.dashboard') : route('admin.dashboard')); ?>" class="inline-flex items-center px-4 py-2 rounded-lg border border-neutral-300 text-neutral-700 hover:bg-neutral-100 text-sm font-medium">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Back to Dashboard
                </a>
                <?php if(auth()->guard('artisan')->check()): ?>
                    <a href="<?php echo e(route('sales.create')); ?>" class="inline-flex items-center px-4 py-2 rounded-lg bg-primary-600 hover:bg-primary-700 text-white text-sm font-semibold shadow">
                        <i class="fas fa-plus mr-2"></i>
                        Record New Sale
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-2xl shadow-sm border border-neutral-100 p-5 mb-8">
            <form method="GET" action="<?php echo e(route('sales.index')); ?>" class="space-y-4">
                <div class="flex items-center justify-between gap-3 flex-wrap">
                    <h2 class="text-sm font-semibold text-neutral-900 uppercase tracking-wide flex items-center gap-2">
                        <i class="fas fa-filter text-primary-600"></i>
                        Filters
                    </h2>
                    <?php if(!empty(array_filter($filters ?? []))): ?>
                        <a href="<?php echo e(route('sales.index')); ?>" class="text-xs font-medium text-primary-700 hover:text-primary-800">
                            Clear filters
                        </a>
                    <?php endif; ?>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-neutral-600 uppercase mb-1">Start date</label>
                        <input type="date" name="start_date" value="<?php echo e($filters['start_date'] ?? ''); ?>"
                               class="w-full px-3 py-2 rounded-lg border border-neutral-300 text-sm focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-neutral-600 uppercase mb-1">End date</label>
                        <input type="date" name="end_date" value="<?php echo e($filters['end_date'] ?? ''); ?>"
                               class="w-full px-3 py-2 rounded-lg border border-neutral-300 text-sm focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none">
                    </div>

                    <?php if(isset($shops) && $shops->isNotEmpty()): ?>
                        <div>
                            <label class="block text-xs font-semibold text-neutral-600 uppercase mb-1">Shop</label>
                            <select name="shop_id" class="w-full px-3 py-2 rounded-lg border border-neutral-300 text-sm focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none">
                                <option value="">All shops</option>
                                <?php $__currentLoopData = $shops; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $shop): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($shop->id); ?>" <?php echo e(($filters['shop_id'] ?? '') == $shop->id ? 'selected' : ''); ?>>
                                        <?php echo e($shop->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    <?php endif; ?>

                    <?php if(isset($artisans) && $artisans->isNotEmpty()): ?>
                        <div>
                            <label class="block text-xs font-semibold text-neutral-600 uppercase mb-1">Artisan</label>
                            <select name="artisan_id" class="w-full px-3 py-2 rounded-lg border border-neutral-300 text-sm focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none">
                                <option value="">All artisans</option>
                                <?php $__currentLoopData = $artisans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $artisan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($artisan->id); ?>" <?php echo e(($filters['artisan_id'] ?? '') == $artisan->id ? 'selected' : ''); ?>>
                                        <?php echo e($artisan->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    <?php endif; ?>

                    <?php if(isset($categories) && $categories->isNotEmpty()): ?>
                        <div>
                            <label class="block text-xs font-semibold text-neutral-600 uppercase mb-1">Product category</label>
                            <select name="category" class="w-full px-3 py-2 rounded-lg border border-neutral-300 text-sm focus:border-primary-500 focus:ring-2 focus:ring-primary-200 outline-none">
                                <option value="">All categories</option>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category); ?>" <?php echo e(($filters['category'] ?? '') === $category ? 'selected' : ''); ?>>
                                        <?php echo e($category); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="flex justify-end mt-2">
                    <button type="submit" class="inline-flex items-center px-4 py-2 rounded-lg bg-primary-600 hover:bg-primary-700 text-white text-sm font-semibold shadow">
                        <i class="fas fa-search mr-2"></i>
                        Apply Filters
                    </button>
                </div>
            </form>
        </div>

        <!-- Stats cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-8">
            <div class="bg-white rounded-xl shadow-sm border border-neutral-100 p-5 flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold tracking-wide text-neutral-500 uppercase">Total Sales</p>
                    <p class="mt-2 text-2xl font-bold text-primary-800"><?php echo e($totalSales); ?></p>
                </div>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-primary-50 text-primary-600">
                    <i class="fas fa-receipt"></i>
                </span>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-neutral-100 p-5 flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold tracking-wide text-neutral-500 uppercase">Total Revenue</p>
                    <p class="mt-2 text-2xl font-bold text-primary-800">RM <?php echo e(number_format($totalRevenue, 2)); ?></p>
                </div>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-primary-50 text-primary-600">
                    <i class="fas fa-chart-line"></i>
                </span>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-neutral-100 p-5 flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold tracking-wide text-neutral-500 uppercase">Average Transaction</p>
                    <p class="mt-2 text-2xl font-bold text-primary-800">RM <?php echo e(number_format($averageTransaction, 2)); ?></p>
                </div>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-primary-50 text-primary-600">
                    <i class="fas fa-cash-register"></i>
                </span>
            </div>

            <div class="bg-white rounded-xl shadow-sm border border-neutral-100 p-5 flex items-center justify-between">
                <div>
                    <p class="text-xs font-semibold tracking-wide text-neutral-500 uppercase">Sales Today</p>
                    <p class="mt-2 text-2xl font-bold text-primary-800"><?php echo e($salesToday); ?></p>
                </div>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-primary-50 text-primary-600">
                    <i class="fas fa-hourglass-end"></i>
                </span>
            </div>
        </div>

        <?php if($sales->isEmpty()): ?>
            <!-- Empty state -->
            <div class="bg-white rounded-2xl shadow-sm border border-dashed border-neutral-300 p-10 text-center">
                <div class="mx-auto mb-4 flex items-center justify-center w-14 h-14 rounded-full bg-neutral-100 text-neutral-500">
                    <i class="fas fa-inbox text-xl"></i>
                </div>
                <h2 class="text-lg font-semibold text-neutral-800 mb-2">No sales recorded yet</h2>
                <p class="text-sm text-neutral-600 mb-4">Start by recording your first sale transaction.</p>
                <?php if(auth()->guard('artisan')->check()): ?>
                    <a href="<?php echo e(route('sales.create')); ?>" class="inline-flex items-center px-4 py-2 rounded-lg bg-primary-600 hover:bg-primary-700 text-white text-sm font-semibold">
                        <i class="fas fa-plus mr-2"></i>
                        Record Sale
                    </a>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <!-- Sales table -->
            <div class="bg-white rounded-2xl shadow-sm border border-neutral-100 overflow-hidden">
                <div class="px-5 py-4 border-b border-neutral-100 flex items-center justify-between">
                    <h2 class="text-sm font-semibold text-neutral-900 uppercase tracking-wide flex items-center gap-2">
                        <i class="fas fa-list text-primary-600"></i>
                        Sales Transactions
                    </h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-neutral-200 text-sm">
                        <thead class="bg-neutral-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-neutral-600 uppercase tracking-wide">Date</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-neutral-600 uppercase tracking-wide">Product</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-neutral-600 uppercase tracking-wide">Customer</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-neutral-600 uppercase tracking-wide">Quantity</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-neutral-600 uppercase tracking-wide">Total Amount</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-neutral-600 uppercase tracking-wide">Status</th>
                                <th class="px-4 py-3 text-right text-xs font-semibold text-neutral-600 uppercase tracking-wide">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-100">
                            <?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="hover:bg-neutral-50/70">
                                    <td class="px-4 py-3 align-top text-neutral-800"><?php echo e($sale->created_at->format('d/m/Y H:i')); ?></td>
                                    <td class="px-4 py-3 align-top text-neutral-800"><?php echo e($sale->product->name); ?></td>
                                    <td class="px-4 py-3 align-top text-neutral-800"><?php echo e($sale->customer->name); ?></td>
                                    <td class="px-4 py-3 align-top text-neutral-800"><?php echo e($sale->quantity); ?></td>
                                    <td class="px-4 py-3 align-top font-semibold text-primary-800">RM <?php echo e(number_format($sale->total_price, 2)); ?></td>
                                    <td class="px-4 py-3 align-top">
                                        <?php
                                            $isCompleted = ($sale->status ?? '') === 'completed';
                                            $statusLabel = $isCompleted ? 'Completed' : 'Pending';
                                        ?>
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold
                                            <?php echo e($isCompleted ? 'bg-emerald-50 text-emerald-700 border border-emerald-100' : 'bg-amber-50 text-amber-700 border border-amber-100'); ?>">
                                            <span class="w-1.5 h-1.5 rounded-full mr-1.5 <?php echo e($isCompleted ? 'bg-emerald-500' : 'bg-amber-400'); ?>"></span>
                                            <?php echo e($statusLabel); ?>

                                        </span>
                                    </td>
                                    <td class="px-4 py-3 align-top text-right whitespace-nowrap">
                                        <div class="inline-flex items-center gap-2">
                                            <a href="<?php echo e(route('sales.show', $sale)); ?>" class="inline-flex items-center px-3 py-1.5 rounded-lg border border-neutral-200 text-xs font-semibold text-neutral-700 hover:bg-neutral-50">
                                                <i class="fas fa-eye mr-1.5"></i> View
                                            </a>
                                            <?php if(auth()->guard('artisan')->check()): ?>
                                                <a href="<?php echo e(route('sales.edit', $sale)); ?>" class="inline-flex items-center px-3 py-1.5 rounded-lg border border-primary-200 text-xs font-semibold text-primary-700 bg-primary-50 hover:bg-primary-100">
                                                    <i class="fas fa-edit mr-1.5"></i> Edit
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/leezanm/eAsli-app/resources/views/sales/index.blade.php ENDPATH**/ ?>