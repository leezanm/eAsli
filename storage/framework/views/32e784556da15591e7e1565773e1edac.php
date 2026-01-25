<?php $__env->startSection('title', 'Reports & Analytics'); ?>

<?php $__env->startSection('content'); ?>
<div class="bg-gradient-to-br from-neutral-50 via-neutral-100 to-neutral-50 min-h-screen py-12">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-6 mb-10">
            <div>
                <h1 class="text-4xl md:text-5xl font-bold text-neutral-900 flex items-center gap-4">
                    <span class="inline-flex items-center justify-center w-14 h-14 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-600 text-white shadow-lg">
                        <i class="fas fa-chart-line text-xl"></i>
                    </span>
                    Reports & Analytics
                </h1>
                <p class="mt-3 text-neutral-600 text-lg">
                    Generate comprehensive business reports and view real-time analytics.
                </p>
            </div>
            <a href="<?php echo e(Auth::guard('artisan')->check() ? route('artisans.dashboard') : route('admin.dashboard')); ?>" class="inline-flex items-center gap-2 px-6 py-3 rounded-lg border border-neutral-300 text-neutral-700 hover:bg-neutral-100 text-sm font-medium transition">
                <i class="fas fa-arrow-left"></i>
                <span>Back to Dashboard</span>
            </a>
        </div>

        <?php if(session('success')): ?>
            <div class="mb-8 p-4 bg-emerald-50 border-l-4 border-emerald-500 rounded-lg text-emerald-700 flex items-start gap-3 animate-pulse">
                <i class="fas fa-check-circle text-emerald-600 mt-0.5 text-lg"></i>
                <span class="font-semibold"><?php echo e(session('success')); ?></span>
            </div>
        <?php endif; ?>

        <?php if($errors->any()): ?>
            <div class="mb-8 p-4 bg-red-50 border-l-4 border-red-500 rounded-lg text-red-700 flex items-start gap-3">
                <i class="fas fa-exclamation-circle text-red-600 mt-0.5 text-lg"></i>
                <div>
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <p class="font-semibold"><?php echo e($error); ?></p>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="bg-white rounded-2xl shadow-md border border-secondary-200 p-6 hover:shadow-lg transition">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-xs font-semibold text-neutral-600 uppercase tracking-wider">Total Sales</p>
                        <p class="mt-2 text-3xl font-bold text-primary-800"><?php echo e($totalSales); ?></p>
                    </div>
                    <span class="inline-flex items-center justify-center w-12 h-12 rounded-lg bg-primary-100 text-primary-700">
                        <i class="fas fa-receipt text-lg"></i>
                    </span>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md border border-secondary-200 p-6 hover:shadow-lg transition">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-xs font-semibold text-neutral-600 uppercase tracking-wider">Total Revenue</p>
                        <p class="mt-2 text-3xl font-bold text-secondary-800">RM <?php echo e(number_format($totalRevenue, 2)); ?></p>
                    </div>
                    <span class="inline-flex items-center justify-center w-12 h-12 rounded-lg bg-secondary-100 text-secondary-700">
                        <i class="fas fa-money-bill text-lg"></i>
                    </span>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md border border-secondary-200 p-6 hover:shadow-lg transition">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-xs font-semibold text-neutral-600 uppercase tracking-wider">Total Products</p>
                        <p class="mt-2 text-3xl font-bold text-accent-800"><?php echo e($totalProducts); ?></p>
                    </div>
                    <span class="inline-flex items-center justify-center w-12 h-12 rounded-lg bg-accent-100 text-accent-700">
                        <i class="fas fa-box text-lg"></i>
                    </span>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-md border border-secondary-200 p-6 hover:shadow-lg transition">
                <div class="flex items-center justify-between gap-4">
                    <div>
                        <p class="text-xs font-semibold text-neutral-600 uppercase tracking-wider">Active Artisans</p>
                        <p class="mt-2 text-3xl font-bold text-primary-700"><?php echo e(\App\Models\Artisan::count()); ?></p>
                    </div>
                    <span class="inline-flex items-center justify-center w-12 h-12 rounded-lg bg-primary-100 text-primary-700">
                        <i class="fas fa-users text-lg"></i>
                    </span>
                </div>
            </div>
        </div>

        <!-- Reports Section -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Sales Report -->
            <div class="bg-white rounded-2xl shadow-md border border-secondary-200 overflow-hidden hover:shadow-lg transition">
                <div class="h-12 bg-gradient-to-r from-primary-500 to-primary-600 flex items-center px-6">
                    <h3 class="text-white font-semibold flex items-center gap-2">
                        <i class="fas fa-receipt"></i>
                        Sales Report
                    </h3>
                </div>
                <div class="p-6">
                    <p class="text-sm text-neutral-600 mb-4">Download comprehensive sales data for a specific date range in CSV format.</p>
                    <form method="POST" action="<?php echo e(route('reports.sales')); ?>" class="space-y-4">
                        <?php echo csrf_field(); ?>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-semibold text-neutral-700 uppercase mb-2">Start Date</label>
                                <input type="date" name="start_date" class="w-full px-3 py-2 rounded-lg border border-neutral-300 text-sm focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-neutral-700 uppercase mb-2">End Date</label>
                                <input type="date" name="end_date" class="w-full px-3 py-2 rounded-lg border border-neutral-300 text-sm focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-200 transition">
                            </div>
                        </div>
                        <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 rounded-lg bg-gradient-to-r from-primary-600 to-primary-500 hover:from-primary-700 hover:to-primary-600 text-white text-sm font-semibold shadow-md transition">
                            <i class="fas fa-download"></i>
                            Generate Report
                        </button>
                    </form>
                </div>
            </div>

            <!-- Stock Report -->
            <div class="bg-white rounded-2xl shadow-md border border-secondary-200 overflow-hidden hover:shadow-lg transition">
                <div class="h-12 bg-gradient-to-r from-accent-500 to-accent-600 flex items-center px-6">
                    <h3 class="text-white font-semibold flex items-center gap-2">
                        <i class="fas fa-boxes"></i>
                        Stock Report
                    </h3>
                </div>
                <div class="p-6">
                    <p class="text-sm text-neutral-600 mb-4">Export current inventory levels and stock status for all products.</p>
                    <form method="POST" action="<?php echo e(route('reports.stock')); ?>" class="space-y-4">
                        <?php echo csrf_field(); ?>
                        <div class="text-sm text-neutral-500 bg-neutral-50 rounded-lg p-3 border border-neutral-200">
                            <i class="fas fa-info-circle text-accent-600 mr-2"></i>
                            Real-time stock data
                        </div>
                        <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 rounded-lg bg-gradient-to-r from-accent-600 to-accent-500 hover:from-accent-700 hover:to-accent-600 text-white text-sm font-semibold shadow-md transition">
                            <i class="fas fa-download"></i>
                            Generate Report
                        </button>
                    </form>
                </div>
            </div>

            <!-- Performance Report -->
            <div class="bg-white rounded-2xl shadow-md border border-secondary-200 overflow-hidden hover:shadow-lg transition">
                <div class="h-12 bg-gradient-to-r from-secondary-500 to-secondary-600 flex items-center px-6">
                    <h3 class="text-white font-semibold flex items-center gap-2">
                        <i class="fas fa-chart-line"></i>
                        Performance Report
                    </h3>
                </div>
                <div class="p-6">
                    <p class="text-sm text-neutral-600 mb-4">Analyze marketplace performance and artisan metrics in detail.</p>
                    <form method="POST" action="<?php echo e(route('reports.performance')); ?>" class="space-y-4">
                        <?php echo csrf_field(); ?>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-semibold text-neutral-700 uppercase mb-2">Start Date</label>
                                <input type="date" name="start_date" class="w-full px-3 py-2 rounded-lg border border-neutral-300 text-sm focus:outline-none focus:border-secondary-500 focus:ring-2 focus:ring-secondary-200 transition">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-neutral-700 uppercase mb-2">End Date</label>
                                <input type="date" name="end_date" class="w-full px-3 py-2 rounded-lg border border-neutral-300 text-sm focus:outline-none focus:border-secondary-500 focus:ring-2 focus:ring-secondary-200 transition">
                            </div>
                        </div>
                        <button type="submit" class="w-full inline-flex items-center justify-center gap-2 px-4 py-3 rounded-lg bg-gradient-to-r from-secondary-600 to-secondary-500 hover:from-secondary-700 hover:to-secondary-600 text-white text-sm font-semibold shadow-md transition">
                            <i class="fas fa-download"></i>
                            Generate Report
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Recent Reports -->
        <?php if($reports->isNotEmpty()): ?>
            <div class="mt-10 bg-white rounded-2xl shadow-md border border-secondary-200 overflow-hidden">
                <div class="px-6 py-5 border-b border-secondary-200 flex items-center justify-between bg-gradient-to-r from-neutral-50 to-neutral-0">
                    <h2 class="text-lg font-bold text-neutral-900 flex items-center gap-3">
                        <i class="fas fa-history text-primary-600"></i>
                        Recent Reports
                    </h2>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-primary-50 text-primary-700">
                        <?php echo e($reports->count()); ?> Reports
                    </span>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-neutral-200">
                        <thead class="bg-neutral-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Report Type</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Generated</th>
                                <th class="px-6 py-3 text-left text-xs font-semibold text-neutral-700 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-right text-xs font-semibold text-neutral-700 uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-100">
                            <?php $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="hover:bg-neutral-50/50 transition">
                                    <td class="px-6 py-4 align-top text-neutral-900 font-semibold flex items-center gap-2">
                                        <?php if(str_contains($report->report_type, 'sales')): ?>
                                            <i class="fas fa-receipt text-primary-600"></i>
                                            Sales Report
                                        <?php elseif(str_contains($report->report_type, 'stock')): ?>
                                            <i class="fas fa-boxes text-accent-600"></i>
                                            Stock Report
                                        <?php else: ?>
                                            <i class="fas fa-chart-line text-secondary-600"></i>
                                            Performance Report
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-6 py-4 align-top text-neutral-700"><?php echo e($report->created_at->format('d M Y, H:i')); ?></td>
                                    <td class="px-6 py-4 align-top">
                                        <?php
                                            $isGenerated = ($report->status ?? '') === 'generated';
                                        ?>
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                            <?php echo e($isGenerated ? 'bg-emerald-50 text-emerald-700 border border-emerald-200' : 'bg-amber-50 text-amber-700 border border-amber-200'); ?>">
                                            <span class="w-2 h-2 rounded-full mr-2 <?php echo e($isGenerated ? 'bg-emerald-500' : 'bg-amber-500'); ?>"></span>
                                            <?php echo e($isGenerated ? 'Ready' : 'Processing'); ?>

                                        </span>
                                    </td>
                                    <td class="px-6 py-4 align-top text-right">
                                        <a href="<?php echo e(route('reports.show', $report)); ?>" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-primary-300 text-primary-700 bg-primary-50 hover:bg-primary-100 text-sm font-semibold transition">
                                            <i class="fas fa-download"></i>
                                            Download
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        <?php else: ?>
            <div class="mt-10 bg-white rounded-2xl shadow-md border border-dashed border-secondary-300 p-12 text-center">
                <i class="fas fa-inbox text-5xl text-neutral-300 mb-4"></i>
                <h3 class="text-xl font-semibold text-neutral-900 mb-2">No Reports Generated Yet</h3>
                <p class="text-neutral-600 mb-6">Start by generating your first report above to see it listed here.</p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/leezanm/eAsli-app/resources/views/reports/index.blade.php ENDPATH**/ ?>