# eAsli - Sistem Pengurusan Artisan & Jualan
## Panduan Pemasangan

### Persyaratan Sistem
- PHP >= 8.1
- Composer
- MySQL/MariaDB
- Node.js (untuk frontend assets)

### Langkah Pemasangan

1. **Clone atau setup project**
```bash
cd /Users/leezanm/eAsli-app
```

2. **Install dependencies**
```bash
composer install
```

3. **Setup environment file**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Konfigurasi database di .env file**
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=easli
DB_USERNAME=root
DB_PASSWORD=
```

5. **Jalankan migrasi database**
```bash
php artisan migrate
```

6. **Seed data (opsional)**
```bash
php artisan db:seed
```

7. **Install frontend assets**
```bash
npm install
npm run dev
```

8. **Jalankan aplikasi**
```bash
php artisan serve
```

Akses di: http://localhost:8000

---

## Struktur Project

```
eAsli-app/
├── app/
│   ├── Models/
│   │   ├── Artisan.php
│   │   ├── Shop.php
│   │   ├── Product.php
│   │   ├── Customer.php
│   │   ├── Sale.php
│   │   └── Report.php
│   └── Http/
│       └── Controllers/
│           ├── ArtisanController.php
│           ├── ShopController.php
│           ├── ProductController.php
│           ├── CustomerController.php
│           ├── SaleController.php
│           └── ReportController.php
├── database/
│   └── migrations/
├── routes/
│   └── web.php
├── resources/
│   └── views/
└── public/
```

---

## API Routes

Akan ditambahkan setelah pembangunan controllers
