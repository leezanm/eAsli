<?php $__env->startSection('title', 'Order History - ' . $customer->name); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto px-4 py-10">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl md:text-4xl font-bold text-neutral-900 flex items-center gap-3">
                <span class="inline-flex items-center justify-center w-11 h-11 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-600 text-white shadow-lg">
                    <i class="fas fa-receipt text-lg"></i>
                </span>
                <span>Order History</span>
            </h1>
            <p class="mt-2 text-neutral-600 text-sm md:text-base">All your purchases and order details</p>
        </div>
        <a href="<?php echo e(route('home')); ?>" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-neutral-300 text-sm font-medium text-neutral-700 hover:bg-neutral-50 transition">
            <i class="fas fa-arrow-left"></i>
            <span>Back to Shopping</span>
        </a>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-md border border-neutral-200 p-6">
            <p class="text-sm font-semibold text-neutral-600 mb-1">Total Orders</p>
            <p class="text-3xl font-bold text-primary-700"><?php echo e($totalOrders); ?></p>
        </div>
        <div class="bg-white rounded-xl shadow-md border border-neutral-200 p-6">
            <p class="text-sm font-semibold text-neutral-600 mb-1">Total Spent</p>
            <p class="text-3xl font-bold text-accent-600">RM <?php echo e(number_format($totalSpent, 2)); ?></p>
        </div>
        <div class="bg-white rounded-xl shadow-md border border-neutral-200 p-6">
            <p class="text-sm font-semibold text-neutral-600 mb-1">Average Order</p>
            <p class="text-3xl font-bold text-secondary-600">RM <?php echo e($totalOrders > 0 ? number_format($totalSpent / $totalOrders, 2) : '0.00'); ?></p>
        </div>
    </div>

    <!-- Orders Table -->
    <?php if($sales->isNotEmpty()): ?>
        <div class="bg-white rounded-2xl shadow-md border border-neutral-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-neutral-200 bg-neutral-50 flex items-center justify-between">
                <h2 class="text-lg font-bold text-neutral-900 flex items-center gap-2">
                    <i class="fas fa-list text-primary-600"></i>
                    Orders
                </h2>
                <span class="text-sm font-semibold text-neutral-600"><?php echo e($sales->total()); ?> order<?php echo e($sales->total() !== 1 ? 's' : ''); ?></span>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-neutral-50 border-b border-neutral-200">
                        <tr>
                            <th class="px-6 py-3 text-left font-semibold text-neutral-700">Date</th>
                            <th class="px-6 py-3 text-left font-semibold text-neutral-700">Product</th>
                            <th class="px-6 py-3 text-left font-semibold text-neutral-700">Artisan</th>
                            <th class="px-6 py-3 text-left font-semibold text-neutral-700">Qty</th>
                            <th class="px-6 py-3 text-left font-semibold text-neutral-700">Unit Price</th>
                            <th class="px-6 py-3 text-right font-semibold text-neutral-700">Total</th>
                            <th class="px-6 py-3 text-center font-semibold text-neutral-700">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-100">
                        <?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-neutral-50 transition">
                                <td class="px-6 py-4 font-medium text-neutral-900">
                                    <?php echo e($sale->sale_date->format('d M Y')); ?>

                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <?php if($sale->product->image_path): ?>
                                            <img src="<?php echo e(Storage::url($sale->product->image_path)); ?>" alt="<?php echo e($sale->product->name); ?>" class="w-10 h-10 object-cover rounded">
                                        <?php else: ?>
                                            <div class="w-10 h-10 rounded bg-neutral-200 flex items-center justify-center">
                                                <i class="fas fa-box text-xs text-neutral-400"></i>
                                            </div>
                                        <?php endif; ?>
                                        <div>
                                            <p class="font-semibold text-neutral-900"><?php echo e($sale->product->name); ?></p>
                                            <p class="text-xs text-neutral-500"><?php echo e($sale->product->category); ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-neutral-700">
                                    <?php echo e($sale->artisan->name ?? 'Unknown'); ?>

                                </td>
                                <td class="px-6 py-4 text-neutral-700">
                                    <?php echo e($sale->quantity); ?>

                                </td>
                                <td class="px-6 py-4 text-neutral-700">
                                    RM <?php echo e(number_format($sale->unit_price, 2)); ?>

                                </td>
                                <td class="px-6 py-4 text-right font-semibold text-neutral-900">
                                    RM <?php echo e(number_format($sale->total_price, 2)); ?>

                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-xs font-semibold <?php echo e($sale->payment_status === 'paid' ? 'bg-emerald-50 text-emerald-700' : 'bg-amber-50 text-amber-700'); ?>">
                                        <span class="w-2 h-2 rounded-full <?php echo e($sale->payment_status === 'paid' ? 'bg-emerald-600' : 'bg-amber-600'); ?>"></span>
                                        <?php echo e(ucfirst($sale->payment_status)); ?>

                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <?php if($sales->hasPages()): ?>
                <div class="px-6 py-4 border-t border-neutral-200 bg-neutral-50">
                    <?php echo e($sales->links()); ?>

                </div>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <div class="bg-white rounded-2xl border border-neutral-200 shadow-md p-12 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-neutral-100 text-neutral-500 mb-4">
                <i class="fas fa-inbox text-2xl"></i>
            </div>
            <h3 class="text-lg font-semibold text-neutral-900 mb-2">No Orders Yet</h3>
            <p class="text-neutral-600 mb-6">You haven't placed any orders yet. Browse products and start shopping!</p>
            <a href="<?php echo e(route('products.index')); ?>" class="inline-flex items-center gap-2 px-5 py-3 rounded-lg bg-gradient-to-r from-accent-500 to-accent-600 text-white text-sm font-semibold shadow-md hover:from-accent-600 hover:to-accent-700 transition">
                <i class="fas fa-box"></i>
                <span>Browse Products</span>
            </a>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/leezanm/eAsli-app/resources/views/customers/history.blade.php ENDPATH**/ ?>