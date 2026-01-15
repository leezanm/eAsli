# eAsli - Sistem Pengurusan Artisan & Jualan
## Development Guide

---

## 📋 Ringkasan Proyek

**Nama Sistem**: Sistem Pengurusan Artisan & Jualan (eAsli)  
**Status**: Phase 1 Backend Development - COMPLETE  
**Framework**: Laravel 11  
**Database**: SQLite/MySQL  
**Bahasa**: PHP 8.4  

---

## 🚀 Quick Start

### 1. Environment Setup

```bash
# Masuk ke direktori project
cd /Users/leezanm/eAsli-app

# Install dependencies
composer install

# Setup environment
cp .env.example .env

# Generate application key
php artisan key:generate

# Run database migrations
php artisan migrate
```

### 2. Jalankan Server

```bash
php artisan serve
```

Akses di: **http://localhost:8000**

### 3. Test Database Connection

```bash
php artisan tinker
# Dalam tinker console:
>>> App\Models\Artisan::count()  # Should return 0 initially
>>> exit
```

---

## 📁 Project Structure

```
eAsli-app/
├── app/
│   ├── Models/                    # Database models
│   │   ├── Artisan.php
│   │   ├── Shop.php
│   │   ├── Product.php
│   │   ├── Customer.php
│   │   ├── Sale.php
│   │   └── Report.php
│   ├── Http/
│   │   └── Controllers/           # Business logic controllers
│   │       ├── ArtisanController.php
│   │       ├── ShopController.php
│   │       ├── ProductController.php
│   │       ├── CustomerController.php
│   │       ├── SaleController.php
│   │       └── ReportController.php
│   └── Exceptions/
├── database/
│   ├── migrations/                # Database schema
│   └── seeders/
├── routes/
│   └── web.php                    # All routes
├── resources/
│   └── views/                     # Blade templates (TODO)
├── tests/                         # Unit & Feature tests
├── public/                        # Public assets (CSS, JS, images)
├── storage/
├── bootstrap/
├── config/
├── .env                           # Environment configuration
├── .env.example
├── composer.json
└── artisan                        # Laravel command line
```

---

## 🔧 Konfigurasi Environment (.env)

Pastikan file `.env` sudah dikonfigurasi dengan benar:

```env
APP_NAME=eAsli
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=sqlite
# atau untuk MySQL:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=easli
# DB_USERNAME=root
# DB_PASSWORD=

CACHE_DRIVER=file
SESSION_DRIVER=file
```

---

## 📚 Modul & Fitur

### 1️⃣ Module Artisan (ArtisanController)

**Fungsi Utama:**
- Pendaftaran artisan baru
- Login & logout
- Profil management
- Dashboard dengan statistik

**Routes:**
```
GET  /artisans                    # List all artisans
GET  /artisans/create             # Form daftar artisan
POST /artisans                    # Simpan artisan baru
GET  /artisans/{id}               # Detail artisan
GET  /artisans/{id}/edit          # Form edit
PUT  /artisans/{id}               # Update artisan
DELETE /artisans/{id}             # Delete artisan

GET  /artisans/login              # Form login
POST /artisans/authenticate       # Process login
GET  /artisans/dashboard          # Dashboard artisan
POST /artisans/logout             # Logout
```

**Contoh Database Query:**
```bash
php artisan tinker
>>> $artisan = App\Models\Artisan::create([
      'name' => 'Ahmad Zaini',
      'email' => 'ahmad@example.com',
      'phone' => '01234567890',
      'address' => 'Kuala Lumpur',
      'password' => bcrypt('password123')
    ])
>>> $artisan->shops  # Lihat kedai artisan
```

---

### 2️⃣ Module Kedai (ShopController)

**Fungsi Utama:**
- Create/edit/delete kedai
- Lokasi dengan latitude & longitude
- Tampilan peta kedai aktif
- Pencarian kedai terdekat

**Routes:**
```
GET  /shops                       # List kedai
POST /shops                       # Tambah kedai
GET  /shops/{id}                  # Detail kedai
PUT  /shops/{id}                  # Update kedai
DELETE /shops/{id}                # Delete kedai

GET  /shops/map                   # Tampilan peta
GET  /shops/nearby?lat=X&lng=Y    # Cari kedai dekat
```

**Contoh:**
```bash
php artisan tinker
>>> $artisan = App\Models\Artisan::first()
>>> $shop = $artisan->shops()->create([
      'name' => 'Kedai Anyam Ahmad',
      'address' => 'Jln Merdeka, KL',
      'latitude' => 3.1390,
      'longitude' => 101.6869,
      'status' => 'active'
    ])
```

---

### 3️⃣ Module Produk (ProductController)

**Fungsi Utama:**
- CRUD produk
- Pengurusan stok
- Kategori produk
- Pencarian & filter

**Routes:**
```
GET  /products                    # List produk
POST /products                    # Tambah produk
GET  /products/{id}               # Detail produk
PUT  /products/{id}               # Update produk
DELETE /products/{id}             # Delete produk

GET  /products/category?category=X    # Filter kategori
GET  /products/search?search=X        # Cari produk
GET  /products/low-stock              # Stok rendah
```

**Contoh:**
```bash
php artisan tinker
>>> $product = App\Models\Product::create([
      'artisan_id' => 1,
      'name' => 'Anyaman Tangan',
      'category' => 'Handicraft',
      'price' => 150.00,
      'stock' => 50
    ])
>>> $product->decreaseStock(5)  # Kurang stok
```

---

### 4️⃣ Module Pelanggan (CustomerController)

**Fungsi Utama:**
- Pendaftaran pelanggan
- Profil management
- Tracking pembelian
- Top customers

**Routes:**
```
GET  /customers                   # List pelanggan
POST /customers                   # Daftar pelanggan
GET  /customers/{id}              # Detail pelanggan
PUT  /customers/{id}              # Update pelanggan
DELETE /customers/{id}            # Delete pelanggan

GET  /customers/top               # Top customers
```

---

### 5️⃣ Module Jualan (SaleController)

**Fungsi Utama:**
- Pencatatan penjualan
- Auto stock deduction
- Status pembayaran
- Laporan penjualan
- Statistik

**Routes:**
```
GET  /sales                       # List penjualan
POST /sales                       # Catat penjualan
GET  /sales/{id}                  # Detail penjualan
PUT  /sales/{id}                  # Update penjualan
DELETE /sales/{id}                # Delete penjualan (restore stock)

GET  /sales/by-artisan/{id}       # Penjualan per artisan
GET  /sales/by-date?start=X&end=Y # Penjualan per periode
GET  /sales/statistics            # Statistik penjualan
```

**Contoh:**
```bash
php artisan tinker
>>> $sale = App\Models\Sale::create([
      'artisan_id' => 1,
      'product_id' => 1,
      'customer_id' => 1,
      'quantity' => 2,
      'unit_price' => 150.00,
      'total_price' => 300.00,
      'sale_date' => now(),
      'payment_status' => 'paid'
    ])
>>> $product->stock  # Stock sudah berkurang 2
```

---

### 6️⃣ Module Laporan (ReportController)

**Fungsi Utama:**
- Laporan penjualan
- Laporan stok
- Laporan prestasi artisan
- Export (JSON, PDF, Excel)

**Routes:**
```
GET  /reports                     # List laporan
POST /reports/sales               # Generate sales report
POST /reports/stock               # Generate stock report
POST /reports/performance         # Generate performance report
DELETE /reports/{id}              # Delete laporan
```

---

## 🗄️ Database Schema

### Model Relationships

```
Artisan (1) ─────┬─────── (N) Shop
                 ├─────── (N) Product
                 └─────── (N) Sale

Product ──── (N) Sale ──── (N) Customer

Shop ──── (N) Product
```

---

## 🧪 Testing Database

### Create Test Data

```bash
php artisan tinker

# Create Artisan
$artisan = App\Models\Artisan::create([
    'name' => 'Nurul Ahmad',
    'email' => 'nurul@example.com',
    'phone' => '0123456789',
    'address' => 'Selangor',
    'password' => bcrypt('password123')
]);

# Create Shop
$shop = $artisan->shops()->create([
    'name' => 'Anyam Indah',
    'address' => 'Jln Lama 123',
    'latitude' => 3.1390,
    'longitude' => 101.6869,
    'status' => 'active'
]);

# Create Product
$product = $artisan->products()->create([
    'name' => 'Tas Tangan',
    'category' => 'Bags',
    'price' => 200,
    'stock' => 30,
    'status' => 'available'
]);

# Create Customer
$customer = App\Models\Customer::create([
    'name' => 'Siti Nurhaliza',
    'email' => 'siti@example.com',
    'phone' => '0198765432',
    'address' => 'KL',
    'city' => 'Kuala Lumpur'
]);

# Create Sale
$sale = App\Models\Sale::create([
    'artisan_id' => $artisan->id,
    'product_id' => $product->id,
    'customer_id' => $customer->id,
    'quantity' => 2,
    'unit_price' => 200,
    'total_price' => 400,
    'sale_date' => now(),
    'payment_status' => 'paid'
]);

# Verify
$product->refresh();
echo $product->stock;  # Should be 28 (30-2)

exit
```

---

## 📊 Model Methods

### Artisan Model
```php
$artisan->shops()           // Get all shops
$artisan->products()        // Get all products
$artisan->sales()           // Get all sales
$artisan->reports()         // Get all reports
```

### Product Model
```php
$product->decreaseStock(5)  // Reduce stock
$product->increaseStock(3)  // Increase stock
$product->artisan()         // Get artisan
$product->sales()           // Get sales transactions
```

### Customer Model
```php
$customer->getTotalSpent()  // Total spent
$customer->getTotalOrders() // Total orders
$customer->sales()          // Get purchases
```

### Sale Model
```php
$sale->calculateTotalPrice()  // Compute total
$sale->artisan()              // Get artisan
$sale->product()              // Get product
$sale->customer()             // Get customer
```

---

## 🔑 Key Features Checklist

- [x] Database migrations & models
- [x] Artisan authentication
- [x] CRUD operations (all modules)
- [x] Stock management (auto deduct/restore)
- [x] Location-based search
- [x] Sales transactions
- [x] Report generation
- [ ] Blade views & UI
- [ ] Bootstrap styling
- [ ] Google Maps integration
- [ ] PDF/Excel export
- [ ] Email notifications
- [ ] Unit tests
- [ ] API documentation

---

## 🐛 Troubleshooting

### Issue: "Class does not exist" error
```bash
composer dump-autoload
php artisan clear-compiled
```

### Issue: Database error
```bash
# Check migrations
php artisan migrate:status

# Reset database (caution!)
php artisan migrate:reset
php artisan migrate
```

### Issue: Routes not working
```bash
php artisan route:cache
php artisan route:clear
```

---

## 📖 Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Eloquent ORM](https://laravel.com/docs/eloquent)
- [Blade Templates](https://laravel.com/docs/blade)
- [Migrations](https://laravel.com/docs/migrations)

---

## 📝 Catatan Penting

1. **Password Storage**: Semua password di-hash dengan bcrypt
2. **Stock Management**: Otomatis berkurang saat penjualan
3. **Data Integrity**: Foreign key constraints aktif
4. **Session**: Authentication berbasis session (PHP native)

---

## 🚀 Next Phase: Frontend Development

Seterusnya perlu:
1. Buat Blade views di `resources/views/`
2. Styling dengan Bootstrap 5
3. JavaScript untuk form validation
4. Google Maps integration
5. PDF/Excel export libraries

---

**Version**: 1.0.0-beta  
**Last Updated**: 9 January 2026
