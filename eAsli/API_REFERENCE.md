# eAsli API Reference

## Complete API Endpoints Documentation

---

## Authentication (Artisan)

### Login
```
GET /artisans/login
GET  /artisans/login
GET  /artisans/login

Shows login form for artisan authentication
```

### Authenticate
```
POST /artisans/authenticate
Body: {
  "email": "artisan@example.com",
  "password": "password123"
}

Response: Redirects to dashboard on success
Status: 302 (Redirect)
```

### Dashboard
```
GET /artisans/dashboard
Headers: Session (authenticated artisan)

Response:
{
  "artisan": { ... },
  "shops": 3,
  "products": 15,
  "sales": 42,
  "totalRevenue": 5240.50
}
```

### Logout
```
POST /artisans/logout
Headers: Session (authenticated)

Response: Redirects to login page
```

---

## Artisan Management

### List All Artisans
```
GET /artisans

Response:
[
  {
    "id": 1,
    "name": "Ahmad Zaini",
    "email": "ahmad@example.com",
    "phone": "01234567890",
    "address": "Kuala Lumpur",
    "status": "active",
    "created_at": "2026-01-09T10:30:00Z",
    "updated_at": "2026-01-09T10:30:00Z"
  },
  ...
]
```

### Create Artisan
```
POST /artisans
Content-Type: application/x-www-form-urlencoded

Body:
{
  "name": "Nur Azizah",
  "email": "nur@example.com",
  "phone": "0198765432",
  "address": "Selangor",
  "description": "Pengrajin batik tradisional",
  "password": "password123",
  "password_confirmation": "password123"
}

Response: 
Status: 302 (Redirect to /artisans)
```

### Get Artisan Detail
```
GET /artisans/{id}

Response:
{
  "id": 1,
  "name": "Ahmad Zaini",
  "email": "ahmad@example.com",
  "phone": "01234567890",
  "address": "Kuala Lumpur",
  "description": "...",
  "status": "active",
  "shops": [ ... ],
  "products": [ ... ],
  "sales": [ ... ]
}
```

### Update Artisan
```
PUT /artisans/{id}
Content-Type: application/x-www-form-urlencoded

Body:
{
  "name": "Ahmad Zaini Updated",
  "email": "ahmad@example.com",
  "phone": "01234567890",
  "address": "Selangor",
  "description": "Updated description",
  "status": "active"
}

Response: Status 302
```

### Delete Artisan
```
DELETE /artisans/{id}

Response: Status 302 (Redirect to artisans list)
Note: Cascades to delete shops, products, sales
```

---

## Shop Management

### List All Shops
```
GET /shops

Response:
[
  {
    "id": 1,
    "artisan_id": 1,
    "name": "Anyam Indah",
    "address": "Jln Merdeka 123, KL",
    "latitude": 3.1390,
    "longitude": 101.6869,
    "status": "active",
    "phone": "0312345678",
    "description": "Kedai anyaman tradisional",
    "artisan": { ... }
  },
  ...
]
```

### Create Shop
```
POST /shops
Content-Type: application/x-www-form-urlencoded

Body:
{
  "artisan_id": 1,
  "name": "Kedai Seni Lokal",
  "address": "Jln Raja Chulan, KL",
  "latitude": 3.1456,
  "longitude": 101.6950,
  "phone": "0312345678",
  "description": "Tempat jualan produk seni lokal"
}

Response: Status 302
```

### View Shop
```
GET /shops/{id}

Response:
{
  "id": 1,
  "name": "Anyam Indah",
  "address": "...",
  "latitude": 3.1390,
  "longitude": 101.6869,
  "status": "active",
  "artisan": { ... },
  "products": [ ... ]
}
```

### Update Shop
```
PUT /shops/{id}

Body:
{
  "name": "Anyam Indah Updated",
  "address": "...",
  "latitude": 3.1390,
  "longitude": 101.6869,
  "status": "active",
  "phone": "...",
  "description": "..."
}

Response: Status 302
```

### Delete Shop
```
DELETE /shops/{id}

Response: Status 302
```

### View Map
```
GET /shops/map

Response: HTML Map View with all active shops
```

### Find Nearby Shops
```
GET /shops/nearby?latitude=3.1390&longitude=101.6869&radius=10

Response:
[
  {
    "id": 1,
    "name": "Anyam Indah",
    "address": "...",
    "distance": 0.5,  // km
    "latitude": 3.1390,
    "longitude": 101.6869
  },
  {
    "id": 2,
    "name": "Kedai Batik",
    "address": "...",
    "distance": 2.3,
    "latitude": 3.1456,
    "longitude": 101.6950
  }
]
```

---

## Product Management

### List All Products
```
GET /products

Response:
[
  {
    "id": 1,
    "artisan_id": 1,
    "name": "Tas Tangan Anyaman",
    "description": "Tas anyaman kualitas tinggi",
    "category": "Bags",
    "price": 150.00,
    "stock": 25,
    "image_path": "products/image.jpg",
    "status": "available",
    "artisan": { ... }
  },
  ...
]
```

### Create Product
```
POST /products
Content-Type: multipart/form-data

Body:
{
  "artisan_id": 1,
  "name": "Tas Tangan Baru",
  "description": "Tas anyaman premium",
  "category": "Bags",
  "price": 200.00,
  "stock": 15,
  "image_path": <file>
}

Response: Status 302
```

### Get Product Detail
```
GET /products/{id}

Response:
{
  "id": 1,
  "name": "Tas Tangan Anyaman",
  "category": "Bags",
  "price": 150.00,
  "stock": 25,
  "status": "available",
  "artisan": { ... }
}
```

### Update Product
```
PUT /products/{id}

Body:
{
  "name": "...",
  "description": "...",
  "category": "...",
  "price": 200.00,
  "stock": 20,
  "status": "available",
  "image_path": <optional file>
}

Response: Status 302
```

### Delete Product
```
DELETE /products/{id}

Response: Status 302
```

### Filter by Category
```
GET /products/category?category=Bags

Response:
[
  { ... products in Bags category ... }
]
```

### Search Products
```
GET /products/search?search=tas

Response:
[
  { ... products matching "tas" ... }
]
```

### Low Stock Products
```
GET /products/low-stock

Response:
[
  { ... products with stock < 10 ... }
]
```

---

## Customer Management

### List All Customers
```
GET /customers

Response:
[
  {
    "id": 1,
    "name": "Siti Nurhaliza",
    "email": "siti@example.com",
    "phone": "0198765432",
    "address": "123 Jln Raja",
    "city": "Kuala Lumpur",
    "postal_code": "50050"
  },
  ...
]
```

### Register Customer
```
POST /customers

Body:
{
  "name": "Nur Azizah",
  "email": "nur@example.com",
  "phone": "0187654321",
  "address": "456 Jln Lama",
  "city": "Selangor",
  "postal_code": "40000"
}

Response: Status 302
```

### Get Customer Detail
```
GET /customers/{id}

Response:
{
  "id": 1,
  "name": "Siti Nurhaliza",
  "email": "siti@example.com",
  "phone": "0198765432",
  "address": "...",
  "sales": [
    {
      "id": 1,
      "product": { ... },
      "quantity": 2,
      "total_price": 300.00,
      "sale_date": "2026-01-09"
    }
  ],
  "totalSpent": 1500.50,
  "totalOrders": 5
}
```

### Update Customer
```
PUT /customers/{id}

Body:
{
  "name": "...",
  "email": "...",
  "phone": "...",
  "address": "...",
  "city": "...",
  "postal_code": "..."
}

Response: Status 302
```

### Delete Customer
```
DELETE /customers/{id}

Response: Status 302
```

### Top Customers
```
GET /customers/top

Response:
[
  {
    "id": 1,
    "name": "Siti Nurhaliza",
    "sales_count": 10,
    "sales_sum_total_price": 5000.00,
    "rank": 1
  },
  ...
]
```

---

## Sales Management

### List All Sales
```
GET /sales

Response:
[
  {
    "id": 1,
    "artisan_id": 1,
    "product_id": 1,
    "customer_id": 1,
    "quantity": 2,
    "unit_price": 150.00,
    "total_price": 300.00,
    "sale_date": "2026-01-09",
    "payment_status": "paid",
    "notes": "...",
    "artisan": { ... },
    "product": { ... },
    "customer": { ... }
  },
  ...
]
```

### Record Sale
```
POST /sales

Body:
{
  "artisan_id": 1,
  "product_id": 1,
  "customer_id": 1,
  "quantity": 3,
  "sale_date": "2026-01-09",
  "payment_status": "paid",
  "notes": "Custom order"
}

Response: 
Status: 302
Note: Automatically calculates total_price and deducts stock
```

### Get Sale Detail
```
GET /sales/{id}

Response:
{
  "id": 1,
  "artisan_id": 1,
  "product": { ... },
  "customer": { ... },
  "quantity": 2,
  "unit_price": 150.00,
  "total_price": 300.00,
  "sale_date": "2026-01-09",
  "payment_status": "paid"
}
```

### Update Sale
```
PUT /sales/{id}

Body:
{
  "payment_status": "paid",  // or pending, failed
  "notes": "Updated notes"
}

Response: Status 302
Note: Cannot change quantity/product (prevents double stock deduction)
```

### Cancel Sale
```
DELETE /sales/{id}

Response: Status 302
Note: Automatically restores stock to inventory
```

### Sales by Artisan
```
GET /sales/by-artisan/1

Response:
[
  { ... sales for artisan 1 ... }
]
```

### Sales by Date Range
```
GET /sales/by-date?start_date=2026-01-01&end_date=2026-01-31

Response:
[
  { ... sales between dates ... }
]
```

### Sales Statistics
```
GET /sales/statistics

Response:
{
  "totalSales": 150,
  "totalRevenue": 15000.50,
  "paidSales": 12000.00,
  "pendingSales": 3000.00,
  "averageSaleValue": 100.00
}
```

---

## Report Management

### List All Reports
```
GET /reports

Response:
[
  {
    "id": 1,
    "artisan_id": 1,
    "type": "sales",
    "start_date": "2026-01-01",
    "end_date": "2026-01-31",
    "format": "json",
    "created_at": "2026-01-09T10:30:00Z"
  },
  ...
]
```

### Generate Sales Report
```
POST /reports/sales

Body:
{
  "artisan_id": 1,           // optional
  "start_date": "2026-01-01",
  "end_date": "2026-01-31",
  "format": "json"           // or pdf, excel
}

Response:
{
  "period": "2026-01-01 to 2026-01-31",
  "total_revenue": 5000.00,
  "total_quantity": 50,
  "total_transactions": 20,
  "average_transaction": 250.00,
  "sales": [ ... ]
}
```

### Generate Stock Report
```
POST /reports/stock

Body:
{
  "artisan_id": 1,           // optional
  "format": "json"
}

Response:
{
  "total_products": 50,
  "low_stock_count": 5,
  "low_stock_products": [ ... ],
  "generated_at": "2026-01-09T10:30:00Z"
}
```

### Generate Performance Report
```
POST /reports/performance

Body:
{
  "artisan_id": 1,           // optional
  "start_date": "2026-01-01",
  "end_date": "2026-01-31",
  "format": "json"
}

Response:
[
  {
    "artisan": "Ahmad Zaini",
    "total_sales": 25,
    "total_revenue": 3500.00,
    "average_sale": 140.00,
    "products_sold": 75
  },
  ...
]
```

### Get Report Detail
```
GET /reports/{id}

Response:
{
  "id": 1,
  "type": "sales",
  "start_date": "2026-01-01",
  "end_date": "2026-01-31",
  "content": { ... },
  "format": "json",
  "file_path": "reports/sales_2026-01.pdf"
}
```

### Delete Report
```
DELETE /reports/{id}

Response: Status 302
```

---

## Error Responses

### 404 Not Found
```
{
  "message": "Resource not found"
}
```

### 422 Validation Error
```
{
  "message": "The given data was invalid",
  "errors": {
    "email": ["Email already exists"]
  }
}
```

### 500 Server Error
```
{
  "message": "Server error occurred"
}
```

---

## Status Codes

| Code | Meaning |
|------|---------|
| 200 | OK - Request successful |
| 302 | Redirect - After form submission |
| 400 | Bad Request - Invalid parameters |
| 404 | Not Found - Resource doesn't exist |
| 422 | Unprocessable Entity - Validation failed |
| 500 | Server Error |

---

## Rate Limiting

Currently: No rate limiting (recommended to add in production)

---

## Authentication

- Method: Session-based (Laravel default)
- Store: Session file/database
- Duration: Browser session
- Logout: Clears artisan_id from session

---

**API Version**: 1.0.0  
**Last Updated**: 9 January 2026  
**Status**: Complete for backend phase
