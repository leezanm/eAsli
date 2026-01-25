<?php $__env->startSection('title', 'Products'); ?>

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto px-4 py-10">
    <!-- Page header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl md:text-4xl font-bold text-neutral-900 flex items-center gap-3">
                <span class="inline-flex items-center justify-center w-11 h-11 rounded-2xl bg-gradient-to-br from-primary-500 to-primary-600 text-white shadow-lg">
                    <i class="fas fa-box text-lg"></i>
                </span>
                <span>Products</span>
            </h1>
            <p class="mt-2 text-neutral-600 text-sm md:text-base">Manage all your products in one elegant view.</p>
        </div>
        <div class="flex items-center gap-3">
            <?php if(auth('web')->check()): ?>
                <a href="<?php echo e(route('admin.dashboard')); ?>" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-neutral-300 text-sm font-medium text-neutral-700 hover:bg-neutral-50 transition">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Dashboard</span>
                </a>
            <?php elseif(Auth::guard('artisan')->check() ): ?>
                <a href="<?php echo e(route('artisans.dashboard')); ?>" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-neutral-300 text-sm font-medium text-neutral-700 hover:bg-neutral-50 transition">
                    <i class="fas fa-arrow-left"></i>
                    <span>Back to Dashboard</span>
                </a>
            <?php else: ?>
                <button onclick="location.href='<?php echo e(url('/')); ?>'" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-neutral-300 text-sm font-medium text-neutral-700 hover:bg-neutral-50 transition">
                    <i class="fas fa-arrow-left"></i>
                    <span>Home</span>
                </button>
            <?php endif; ?>
            <?php if(auth()->guard('artisan')->check()): ?>
                <a href="<?php echo e(route('products.create')); ?>" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-gradient-to-r from-primary-600 to-primary-500 text-white text-sm font-semibold shadow-md hover:from-primary-700 hover:to-primary-600 transition">
                    <i class="fas fa-plus"></i>
                    <span>Add New Product</span>
                </a>
            <?php endif; ?>
        </div>
    </div>

    <!-- Search & Filter -->
    <div class="bg-white rounded-2xl shadow-md border border-secondary-200 mb-8 p-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
            <div>
                <label for="searchInput" class="block text-xs font-semibold text-neutral-700 uppercase tracking-wider mb-2">Search</label>
                <input type="text" id="searchInput" class="w-full rounded-lg border border-neutral-300 px-3 py-2 text-sm focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-200" placeholder="Search products...">
            </div>
            <div>
                <label for="categoryFilter" class="block text-xs font-semibold text-neutral-700 uppercase tracking-wider mb-2">Category</label>
                <select id="categoryFilter" class="w-full rounded-lg border border-neutral-300 px-3 py-2 text-sm focus:outline-none focus:border-primary-500 focus:ring-2 focus:ring-primary-200">
                    <option value="">All Categories</option>
                    <option value="electronics">Electronics</option>
                    <option value="clothing">Clothing</option>
                    <option value="food">Food</option>
                    <option value="crafts">Crafts</option>
                    <option value="furniture">Furniture</option>
                </select>
            </div>
            <div class="flex gap-3 md:justify-end">
                <button type="button" class="inline-flex items-center justify-center gap-2 px-4 py-2 rounded-lg bg-gradient-to-r from-accent-500 to-accent-600 text-white text-sm font-semibold shadow-md hover:from-accent-600 hover:to-accent-700 w-full md:w-auto" onclick="filterProducts()">
                    <i class="fas fa-filter"></i>
                    <span>Filter</span>
                </button>
            </div>
        </div>
    </div>

    <?php if($products->isEmpty()): ?>
        <!-- Empty state -->
        <div class="bg-white rounded-2xl border border-secondary-200 shadow-md py-12 px-6 text-center">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-secondary-100 text-secondary-700 mb-4">
                <i class="fas fa-inbox text-2xl"></i>
            </div>
            <h2 class="text-xl font-semibold text-neutral-900 mb-1">No products yet</h2>
            <p class="text-neutral-600 mb-4">Start by adding a new product to your catalogue.</p>
            <?php if(auth()->guard('artisan')->check()): ?>
                <a href="<?php echo e(route('products.create')); ?>" class="inline-flex items-center gap-2 px-5 py-3 rounded-lg bg-gradient-to-r from-accent-500 to-accent-600 text-white text-sm font-semibold shadow-md hover:from-accent-600 hover:to-accent-700 transition">
                    <i class="fas fa-plus"></i>
                    <span>Add Product</span>
                </a>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <!-- Products grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="bg-white rounded-2xl border border-secondary-200 shadow-md hover:shadow-xl transition transform hover:-translate-y-1 flex flex-col">
                    <div class="p-6 flex-1 flex flex-col gap-3">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <h2 class="text-lg font-semibold text-neutral-900 line-clamp-2"><?php echo e($product->name); ?></h2>
                                <?php if($product->artisan): ?>
                                    <p class="mt-1 text-xs text-neutral-600">by <span class="font-semibold text-primary-700"><?php echo e($product->artisan->name); ?></span></p>
                                <?php endif; ?>
                            </div>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-primary-50 text-primary-700">
                                <?php echo e(ucfirst($product->category)); ?>

                            </span>
                        </div>

                        <?php if($product->description): ?>
                            <p class="text-sm text-neutral-600 line-clamp-3"><?php echo e(Str::limit($product->description, 120)); ?></p>
                        <?php endif; ?>

                        <div class="mt-2 flex items-center justify-between text-sm">
                            <p class="font-bold text-primary-700">RM <?php echo e(number_format($product->price, 2)); ?></p>
                            <p class="text-xs text-neutral-600">
                                <span class="font-semibold">Stock:</span>
                                <span class="ml-1"><?php echo e($product->stock); ?> units</span>
                            </p>
                        </div>

                        <?php if($product->stock <= 5): ?>
                            <p class="mt-1 text-xs font-semibold text-red-600 flex items-center gap-1">
                                <i class="fas fa-exclamation-triangle"></i>
                                <span>Low stock</span>
                            </p>
                        <?php endif; ?>
                    </div>

                    <div class="border-t border-neutral-200 px-6 py-4 flex items-center justify-between gap-3 bg-neutral-0/60">
                        <a href="<?php echo e(route('products.show', $product)); ?>" class="inline-flex items-center gap-2 text-xs font-semibold text-primary-700 hover:text-primary-800">
                            <i class="fas fa-eye"></i>
                            <span>View</span>
                        </a>
                        <?php if(!auth('artisan')->check() && !auth('web')->check()): ?>
                            <form method="POST" action="<?php echo e(route('cart.add', $product)); ?>" class="inline-flex">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="quantity" value="1">
                                <button type="submit" class="inline-flex items-center justify-center px-3 py-2 text-xs font-semibold text-accent-700 bg-accent-50 rounded-lg hover:bg-accent-100 transition">
                                    <i class="fas fa-cart-plus mr-1"></i> Add
                                </button>
                            </form>
                        <?php endif; ?>

                        <?php if(auth()->guard('artisan')->check()): ?>
                            <div class="flex items-center gap-3">
                                <a href="<?php echo e(route('products.edit', $product)); ?>" class="inline-flex items-center gap-1 px-3 py-1 rounded-md border border-primary-300 text-xs font-semibold text-primary-700 hover:bg-primary-50">
                                    <i class="fas fa-edit"></i>
                                    <span>Edit</span>
                                </a>
                                <form method="POST" action="<?php echo e(route('products.destroy', $product)); ?>" onsubmit="return confirm('Are you sure you want to delete this product?')">
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

<script>
function filterProducts() {
    const search = document.getElementById('searchInput').value;
    const category = document.getElementById('categoryFilter').value;

    window.location.href = `<?php echo e(route('products.index')); ?>?search=${encodeURIComponent(search)}&category=${encodeURIComponent(category)}`;
}

document.getElementById('searchInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') filterProducts();
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/leezanm/eAsli-app/resources/views/products/index.blade.php ENDPATH**/ ?>