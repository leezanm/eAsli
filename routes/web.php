<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArtisanController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdminController;

// Home Page
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'login'])->name('admin.login');
    Route::post('/authenticate', [AdminController::class, 'authenticate'])->name('admin.authenticate');
    Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});

// Artisan Routes
Route::prefix('artisans')->group(function () {
    Route::get('/', [ArtisanController::class, 'index'])->name('artisans.index');
    Route::get('/login', [ArtisanController::class, 'login'])->name('artisans.login');
    Route::post('/authenticate', [ArtisanController::class, 'authenticate'])->name('artisans.authenticate');
    Route::post('/logout', [ArtisanController::class, 'logout'])->name('artisans.logout');
    Route::get('/dashboard', [ArtisanController::class, 'dashboard'])->name('artisans.dashboard');
    Route::get('/create', [ArtisanController::class, 'create'])->name('artisans.create');
    Route::post('/', [ArtisanController::class, 'store'])->name('artisans.store');
    Route::get('/{artisan}', [ArtisanController::class, 'show'])->name('artisans.show');
    Route::get('/{artisan}/edit', [ArtisanController::class, 'edit'])->name('artisans.edit');
    Route::put('/{artisan}', [ArtisanController::class, 'update'])->name('artisans.update');
    Route::delete('/{artisan}', [ArtisanController::class, 'destroy'])->name('artisans.destroy');
});

// Shop Routes
Route::prefix('shops')->group(function () {
    Route::get('/', [ShopController::class, 'index'])->name('shops.index');
    Route::get('/map', [ShopController::class, 'map'])->name('shops.map');
    Route::get('/nearby', [ShopController::class, 'nearbyShops'])->name('shops.nearby');
    Route::get('/create', [ShopController::class, 'create'])->name('shops.create');
    Route::post('/', [ShopController::class, 'store'])->name('shops.store');
    Route::get('/{shop}', [ShopController::class, 'show'])->name('shops.show');
    Route::get('/{shop}/edit', [ShopController::class, 'edit'])->name('shops.edit');
    Route::put('/{shop}', [ShopController::class, 'update'])->name('shops.update');
    Route::delete('/{shop}', [ShopController::class, 'destroy'])->name('shops.destroy');
});

// Product Routes
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/create', [ProductController::class, 'create'])->name('products.create');
    Route::post('/', [ProductController::class, 'store'])->name('products.store');
    Route::get('/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('products.edit');
    Route::put('/{product}', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/{product}', [ProductController::class, 'destroy'])->name('products.destroy');
    Route::get('/category/{category}', [ProductController::class, 'byCategory'])->name('products.category');
    Route::get('/search/results', [ProductController::class, 'search'])->name('products.search');
    Route::get('/low-stock/list', [ProductController::class, 'lowStock'])->name('products.low-stock');
});

// Shopping Cart Routes (Customer)
Route::prefix('cart')->group(function () {
    Route::get('/', [CartController::class, 'index'])->name('cart.index');
    Route::post('/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::post('/update/{product}', [CartController::class, 'update'])->name('cart.update');
    Route::post('/remove/{product}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
});

// Customer Routes
Route::prefix('customers')->group(function () {
    // Authentication for customer buyers
    Route::get('/login', [CustomerController::class, 'login'])->name('customers.login');
    Route::post('/authenticate', [CustomerController::class, 'authenticate'])->name('customers.authenticate');
    Route::post('/logout', [CustomerController::class, 'logout'])->name('customers.logout');

    // Management & insights (typically for admin)
    Route::get('/', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::post('/', [CustomerController::class, 'store'])->name('customers.store');
    Route::get('/{customer}', [CustomerController::class, 'show'])->name('customers.show');
    Route::get('/{customer}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::put('/{customer}', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/{customer}', [CustomerController::class, 'destroy'])->name('customers.destroy');
    Route::get('/{customer}/history', [CustomerController::class, 'history'])->name('customers.history');
    Route::get('/top/customers', [CustomerController::class, 'topCustomers'])->name('customers.top');
});

// Sales Routes
Route::prefix('sales')->group(function () {
    Route::get('/', [SaleController::class, 'index'])->name('sales.index');
    Route::get('/create', [SaleController::class, 'create'])->name('sales.create');
    Route::post('/', [SaleController::class, 'store'])->name('sales.store');
    Route::get('/{sale}', [SaleController::class, 'show'])->name('sales.show');
    Route::get('/{sale}/edit', [SaleController::class, 'edit'])->name('sales.edit');
    Route::put('/{sale}', [SaleController::class, 'update'])->name('sales.update');
    Route::delete('/{sale}', [SaleController::class, 'destroy'])->name('sales.destroy');
    Route::get('/artisan/{artisan_id}', [SaleController::class, 'byArtisan'])->name('sales.by-artisan');
    Route::get('/date/range', [SaleController::class, 'byDateRange'])->name('sales.by-date');
    Route::get('/stat/overview', [SaleController::class, 'statistics'])->name('sales.statistics');
});

// Report Routes
Route::prefix('reports')->group(function () {
    Route::get('/', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/{report}', [ReportController::class, 'show'])->name('reports.show');
    Route::post('/sales', [ReportController::class, 'generateSalesReport'])->name('reports.sales');
    Route::post('/stock', [ReportController::class, 'generateStockReport'])->name('reports.stock');
    Route::post('/performance', [ReportController::class, 'generatePerformanceReport'])->name('reports.performance');
});
