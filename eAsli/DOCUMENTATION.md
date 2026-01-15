# eAsli - Sistem Pengurusan Artisan & Jualan

## 📋 Ringkasan Sistem

Sistem Pengurusan Artisan & Jualan (eAsli) adalah platform berasaskan web yang direka untuk membantu artisan tempatan mengurus kedai, produk, pelanggan, dan jualan mereka dengan lebih cekap.

### Ciri-ciri Utama
- ✅ Paparan produk artisan berdasarkan lokasi kedai di atas map
- 🔹 Pendaftaran & pengurusan artisan
- 🔹 Pengurusan kedai & lokasi
- 🔹 Pengurusan produk & inventori
- 🔹 Pendaftaran & pengurusan pelanggan
- 🔹 Proses jualan & transaksi
- 🔹 Rekod & laporan jualan
- 🔹 Pengurusan pengguna & kebenaran
- 🔹 Antara muka mesra pengguna
- 🔹 Responsif & mudah alih
- 🔹 Keselamatan data & privasi

---

## 🏗️ Arsitektur Sistem

### Stack Teknologi
- **Backend**: Laravel 11 (PHP)
- **Database**: MySQL/SQLite
- **Frontend**: Blade Template + Bootstrap CSS
- **Authentication**: Session-based
- **Maps API**: Google Maps (untuk integrasi lokasi)

### Modul Sistem

#### 1. Modul Artisan
- Pendaftaran artisan dengan email unik
- Autentikasi login/logout
- Profil artisan (nama, alamat, deskripsi)
- Status artisan (aktif/tidak aktif)
- Dashboard artisan untuk melihat ringkasan bisnis

#### 2. Modul Kedai
- Menambah/edit/padam kedai
- Lokasi kedai (latitude/longitude)
- Status kedai (aktif/tutup)
- Pencarian kedai berdekatan berdasarkan lokasi
- Peta interaktif untuk menampilkan semua kedai aktif

#### 3. Modul Produk
- CRUD operasi untuk produk
- Pengurusan stok produk
- Penetapan harga
- Kategori produk
- Gambar produk
- Pencarian produk berdasarkan nama/kategori
- Peringatan stok rendah

#### 4. Modul Pelanggan
- Pendaftaran pelanggan
- Pengurusan profil pelanggan
- Tracking pembelian pelanggan
- Statistik pelanggan (jumlah pesanan, total belanja)

#### 5. Modul Jualan (Transaksi)
- Pencatatan penjualan
- Otomatis mengurang stok produk
- Pengurusan status pembayaran
- Laporan penjualan berdasarkan artisan/tarikh
- Statistik penjualan

#### 6. Modul Laporan
- Laporan penjualan (periode tertentu)
- Laporan stok produk
- Laporan prestasi artisan
- Export laporan (PDF/Excel/JSON)

---

## 📁 Struktur Project

```
eAsli-app/
├── app/
│   ├── Models/
│   │   ├── Artisan.php           # Model artisan dengan relationships
│   │   ├── Shop.php               # Model kedai
│   │   ├── Product.php            # Model produk
│   │   ├── Customer.php           # Model pelanggan
│   │   ├── Sale.php               # Model transaksi penjualan
│   │   └── Report.php             # Model laporan
│   └── Http/
│       └── Controllers/
│           ├── ArtisanController.php      # CRUD artisan + auth
│           ├── ShopController.php         # CRUD kedai + map
│           ├── ProductController.php      # CRUD produk + search
│           ├── CustomerController.php     # CRUD pelanggan
│           ├── SaleController.php         # CRUD penjualan
│           └── ReportController.php       # Generate reports
├── database/
│   └── migrations/
│       ├── *_create_artisans_table.php
│       ├── *_create_shops_table.php
│       ├── *_create_products_table.php
│       ├── *_create_customers_table.php
│       ├── *_create_sales_table.php
│       └── *_create_reports_table.php
├── resources/
│   └── views/
│       ├── artisans/
│       ├── shops/
│       ├── products/
│       ├── customers/
│       ├── sales/
│       └── reports/
├── routes/
│   └── web.php                    # Routing untuk semua modul
└── public/                        # Assets (CSS, JS, images)
```

---

## 🗄️ Database Schema

### Tabel: artisans
```sql
- id (PK)
- name (string)
- email (unique)
- phone (string)
- address (text)
- description (text, nullable)
- password (hashed)
- status (enum: active, inactive)
- timestamps
```

### Tabel: shops
```sql
- id (PK)
- artisan_id (FK → artisans)
- name (string)
- address (text)
- latitude (decimal)
- longitude (decimal)
- status (enum: active, closed)
- phone (string, nullable)
- description (text, nullable)
- timestamps
```

### Tabel: products
```sql
- id (PK)
- artisan_id (FK → artisans)
- name (string)
- description (text, nullable)
- category (string)
- price (decimal)
- stock (integer)
- image_path (string, nullable)
- status (enum: available, unavailable)
- timestamps
```

### Tabel: customers
```sql
- id (PK)
- name (string)
- email (unique)
- phone (string)
- address (text, nullable)
- city (string, nullable)
- postal_code (string, nullable)
- timestamps
```

### Tabel: sales
```sql
- id (PK)
- artisan_id (FK → artisans)
- product_id (FK → products)
- customer_id (FK → customers)
- quantity (integer)
- unit_price (decimal)
- total_price (decimal)
- sale_date (date)
- payment_status (enum: pending, paid, failed)
- notes (text, nullable)
- timestamps
```

### Tabel: reports
```sql
- id (PK)
- artisan_id (FK → artisans, nullable)
- type (enum: sales, stock, performance)
- start_date (date)
- end_date (date)
- content (longText/JSON)
- file_path (string, nullable)
- format (enum: pdf, excel, json)
- timestamps
```

---

## 🔗 Routes API

### Artisan Routes
```
GET  /artisans                    # List artisans
GET  /artisans/create             # Show create form
POST /artisans                    # Store artisan
GET  /artisans/{id}               # Show artisan detail
GET  /artisans/{id}/edit          # Show edit form
PUT  /artisans/{id}               # Update artisan
DELETE /artisans/{id}             # Delete artisan

GET  /artisans/login              # Show login form
POST /artisans/authenticate       # Authenticate artisan
GET  /artisans/dashboard          # Show dashboard
POST /artisans/logout             # Logout
```

### Shop Routes
```
GET  /shops                       # List shops
GET  /shops/create                # Show create form
POST /shops                       # Store shop
GET  /shops/{id}                  # Show shop detail
GET  /shops/{id}/edit             # Show edit form
PUT  /shops/{id}                  # Update shop
DELETE /shops/{id}                # Delete shop

GET  /shops/map                   # Show map view
GET  /shops/nearby?lat=X&lng=Y&radius=10  # Find nearby shops
```

### Product Routes
```
GET  /products                    # List products
GET  /products/create             # Show create form
POST /products                    # Store product
GET  /products/{id}               # Show product detail
GET  /products/{id}/edit          # Show edit form
PUT  /products/{id}               # Update product
DELETE /products/{id}             # Delete product

GET  /products/category?category=X      # Filter by category
GET  /products/search?search=X          # Search products
GET  /products/low-stock                # Show low stock items
```

### Customer Routes
```
GET  /customers                   # List customers
GET  /customers/create            # Show create form
POST /customers                   # Store customer
GET  /customers/{id}              # Show customer detail
GET  /customers/{id}/edit         # Show edit form
PUT  /customers/{id}              # Update customer
DELETE /customers/{id}            # Delete customer

GET  /customers/top               # Show top customers
```

### Sales Routes
```
GET  /sales                       # List sales
GET  /sales/create                # Show create form
POST /sales                       # Record sale
GET  /sales/{id}                  # Show sale detail
GET  /sales/{id}/edit             # Show edit form
PUT  /sales/{id}                  # Update sale
DELETE /sales/{id}                # Delete sale (restore stock)

GET  /sales/by-artisan/{artisan_id}     # Sales by artisan
GET  /sales/by-date?start=X&end=Y       # Sales by date range
GET  /sales/statistics                  # Sales statistics
```

### Report Routes
```
GET  /reports                     # List reports
GET  /reports/create              # Show create form
GET  /reports/{id}                # Show report detail
DELETE /reports/{id}              # Delete report

POST /reports/sales               # Generate sales report
POST /reports/stock               # Generate stock report
POST /reports/performance         # Generate performance report
```

---

## 🚀 Cara Menggunakan

### 1. Install & Setup
```bash
cd eAsli-app
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

### 2. Akses Sistem
```
http://localhost:8000
```

### 3. Pendaftaran Artisan
- Klik "Daftar Artisan" / "Register Artisan"
- Isi maklumat lengkap
- Login dengan email dan password

### 4. Pengurusan Kedai & Produk
- Login sebagai artisan
- Tambah kedai baru dengan lokasi (lat/lng)
- Tambah produk dengan kategori dan harga
- Urus stok produk

### 5. Mencatat Penjualan
- Pilih produk yang ingin dijual
- Pilih pelanggan (pendaftar baru atau sedia ada)
- Sistem akan otomatis mengurang stok
- Rekodkan status pembayaran

### 6. Generate Laporan
- Pilih jenis laporan (Penjualan, Stok, Prestasi)
- Tentukan periode tarikh
- Export dalam format PDF/Excel/JSON

---

## 🔒 Keselamatan

- ✅ Password di-hash menggunakan bcrypt
- ✅ Validasi input untuk semua form
- ✅ Foreign key constraints untuk data integrity
- ✅ Session-based authentication
- ✅ CSRF protection (Laravel built-in)

### Rekomendasi Tambahan:
- Implement 2FA (Two-Factor Authentication)
- Setup SSL/HTTPS di production
- Regular database backups
- Rate limiting untuk API
- Activity logging untuk audit trail

---

## 📝 Panduan Pengembangan Lanjutan

### Tambahan Features yang Disarankan:
1. **Google Maps Integration** - Tampilan kedai di peta interaktif
2. **Email Notification** - Notifikasi untuk penjualan/pesanan
3. **Export PDF/Excel** - Gunakan paket `maatwebsite/excel` atau `barryvdh/laravel-dompdf`
4. **SMS Gateway** - Integrasi untuk notifikasi via SMS
5. **Payment Gateway** - Integrasi Stripe, PayPal, atau gerbang lokal
6. **User Roles** - Admin, Artisan, Customer roles dengan permissions
7. **Image Upload** - Disimpan di cloud storage (AWS S3, Google Cloud)
8. **REST API** - Untuk mobile app development
9. **Dashboard Analytics** - Chart dan graphs untuk visualisasi data
10. **Multi-language Support** - Bahasa Melayu & Inggeris

### Testing
```bash
php artisan test              # Run all tests
php artisan test --filter=TestName
```

### Deployment
```bash
# Prepare for production
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Set up monitoring
php artisan queue:failed     # Check failed jobs
php artisan logs             # Check application logs
```

---

## 📞 Support & Contact

Untuk pertanyaan atau bantuan teknis, sila hubungi tim development.

---

**Version**: 1.0.0  
**Status**: Development Phase  
**Last Updated**: 9 January 2026
