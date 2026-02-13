<?php $__env->startSection('title', 'Customers'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 py-10">
    <!-- Page header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl md:text-4xl font-bold text-neutral-900 flex items-center gap-3">
                <span class="inline-flex items-center justify-center w-11 h-11 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-600 text-white shadow-lg">
                    <i class="fas fa-users text-lg"></i>
                </span>
                <span>Customers</span>
            </h1>
            <p class="mt-2 text-neutral-600 text-sm md:text-base">Overview of your customer base and key insights.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-neutral-300 text-sm font-medium text-neutral-700 hover:bg-neutral-50 transition">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Dashboard</span>
            </a>
        </div>
    </div>

    <!-- Stats cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5 mb-10">
        <a href="<?php echo e(route('customers.index', ['filter' => 'all'])); ?>" class="bg-white rounded-2xl shadow-md border <?php echo e($filter === 'all' || $filter == null ? 'border-primary-500 ring-1 ring-primary-200' : 'border-secondary-200'); ?> p-5 flex flex-col gap-2 hover:shadow-lg transition cursor-pointer">
            <div class="flex items-center justify-between mb-1">
                <p class="text-xs font-semibold text-neutral-600 uppercase tracking-wider">Total Customers</p>
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-primary-50 text-primary-600">
                    <i class="fas fa-user-tie text-sm"></i>
                </span>
            </div>
            <p class="text-2xl font-bold text-neutral-900"><?php echo e($totalCustomers); ?></p>
        </a>

        <a href="<?php echo e(route('customers.index', ['filter' => 'top'])); ?>" class="bg-white rounded-2xl shadow-md border <?php echo e($filter === 'top' ? 'border-accent-500 ring-1 ring-accent-200' : 'border-secondary-200'); ?> p-5 flex flex-col gap-2 hover:shadow-lg transition cursor-pointer">
            <div class="flex items-center justify-between mb-1">
                <p class="text-xs font-semibold text-neutral-600 uppercase tracking-wider">Top Customers</p>
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-accent-50 text-accent-600">
                    <i class="fas fa-star text-sm"></i>
                </span>
            </div>
            <p class="text-2xl font-bold text-neutral-900"><?php echo e($topCustomersCount); ?></p>
        </a>

        <div class="bg-white rounded-2xl shadow-md border border-secondary-200 p-5 flex flex-col gap-2">
            <div class="flex items-center justify-between mb-1">
                <p class="text-xs font-semibold text-neutral-600 uppercase tracking-wider">Average Spend</p>
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-primary-50 text-primary-600">
                    <i class="fas fa-chart-line text-sm"></i>
                </span>
            </div>
            <p class="text-2xl font-bold text-neutral-900">RM <?php echo e(number_format($averageSpend, 2)); ?></p>
        </div>

        <div class="bg-white rounded-2xl shadow-md border border-secondary-200 p-5 flex flex-col gap-2">
            <div class="flex items-center justify-between mb-1">
                <p class="text-xs font-semibold text-neutral-600 uppercase tracking-wider">Average Orders</p>
                <span class="inline-flex items-center justify-center w-8 h-8 rounded-xl bg-primary-50 text-primary-600">
                    <i class="fas fa-shopping-cart text-sm"></i>
                </span>
            </div>
            <p class="text-2xl font-bold text-neutral-900"><?php echo e(number_format($averageOrders, 1)); ?></p>
        </div>
    </div>

    <!-- Customers table -->
    <div class="bg-white rounded-2xl shadow-md border border-secondary-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-neutral-200 flex items-center justify-between">
            <h2 class="text-base font-semibold text-neutral-900 flex items-center gap-2">
                <i class="fas fa-list <?php echo e($filter === 'top' ? 'text-accent-500' : 'text-primary-500'); ?>"></i>
                <span><?php echo e($filter === 'top' ? 'Top Customers' : 'All Customers'); ?></span>
            </h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-neutral-200 text-sm">
                <thead class="bg-secondary-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-neutral-600 uppercase tracking-wider">#</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-neutral-600 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-neutral-600 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-neutral-600 uppercase tracking-wider">Phone</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-neutral-600 uppercase tracking-wider">City</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-neutral-600 uppercase tracking-wider">Orders</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-neutral-600 uppercase tracking-wider">Total Spend (RM)</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-neutral-600 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-neutral-100">
                    <?php $__empty_1 = true; $__currentLoopData = $customers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $customer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-secondary-50/70 transition">
                            <td class="px-6 py-3 whitespace-nowrap text-neutral-600"><?php echo e((($customers->currentPage() - 1) * $customers->perPage()) + $loop->iteration); ?></td>
                            <td class="px-6 py-3 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-primary-50 text-primary-700">
                                        <i class="fas fa-user-circle"></i>
                                    </span>
                                    <span class="font-medium text-neutral-900"><?php echo e($customer->name); ?></span>
                                </div>
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap text-neutral-700"><?php echo e($customer->email); ?></td>
                            <td class="px-6 py-3 whitespace-nowrap text-neutral-700"><?php echo e($customer->phone); ?></td>
                            <td class="px-6 py-3 whitespace-nowrap text-neutral-700"><?php echo e($customer->city ?? '-'); ?></td>
                            <td class="px-6 py-3 whitespace-nowrap">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-primary-50 text-primary-700">
                                    <?php echo e($customer->sales_count ?? 0); ?>

                                </span>
                            </td>
                            <td class="px-6 py-3 whitespace-nowrap text-neutral-800 font-medium">RM <?php echo e(number_format($customer->sales_sum_total_price ?? 0, 2)); ?></td>
                            <td class="px-6 py-3 whitespace-nowrap">
                                <div class="flex items-center gap-2">
                                    <a href="<?php echo e(route('customers.show', $customer)); ?>" class="inline-flex items-center gap-1 px-2 py-1 rounded text-xs font-semibold text-primary-700 hover:bg-primary-50 transition">
                                        <i class="fas fa-eye"></i>
                                        <span>View</span>
                                    </a>
                                    <a href="<?php echo e(route('customers.edit', $customer)); ?>" class="inline-flex items-center gap-1 px-2 py-1 rounded text-xs font-semibold text-blue-700 hover:bg-blue-50 transition">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" class="px-6 py-8 text-center text-neutral-500">
                                <div class="flex flex-col items-center gap-2">
                                    <i class="fas fa-inbox text-2xl text-neutral-300"></i>
                                    <p>No customers found</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <?php if($customers->hasPages()): ?>
            <div class="px-6 py-4 border-t border-neutral-200 bg-secondary-50 flex items-center justify-between">
                <div class="text-sm text-neutral-600">
                    Showing <span class="font-semibold"><?php echo e($customers->firstItem()); ?></span> to <span class="font-semibold"><?php echo e($customers->lastItem()); ?></span> of <span class="font-semibold"><?php echo e($customers->total()); ?></span> customers
                </div>
                <div class="flex gap-2">
                    
                    <?php if($customers->onFirstPage()): ?>
                        <button disabled class="px-3 py-2 rounded-lg border border-neutral-300 text-sm font-medium text-neutral-400 bg-neutral-50 cursor-not-allowed">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                    <?php else: ?>
                        <a href="<?php echo e($customers->previousPageUrl()); ?>" class="px-3 py-2 rounded-lg border border-neutral-300 text-sm font-medium text-neutral-700 hover:bg-white transition">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    <?php endif; ?>

                    
                    <?php $__currentLoopData = $customers->getUrlRange(1, $customers->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($page == $customers->currentPage()): ?>
                            <button disabled class="px-3 py-2 rounded-lg bg-primary-500 text-white text-sm font-medium cursor-default">
                                <?php echo e($page); ?>

                            </button>
                        <?php else: ?>
                            <a href="<?php echo e($url); ?>" class="px-3 py-2 rounded-lg border border-neutral-300 text-sm font-medium text-neutral-700 hover:bg-white transition">
                                <?php echo e($page); ?>

                            </a>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    
                    <?php if($customers->hasMorePages()): ?>
                        <a href="<?php echo e($customers->nextPageUrl()); ?>" class="px-3 py-2 rounded-lg border border-neutral-300 text-sm font-medium text-neutral-700 hover:bg-white transition">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    <?php else: ?>
                        <button disabled class="px-3 py-2 rounded-lg border border-neutral-300 text-sm font-medium text-neutral-400 bg-neutral-50 cursor-not-allowed">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/leezanm/eAsli-app/resources/views/customers/index.blade.php ENDPATH**/ ?>