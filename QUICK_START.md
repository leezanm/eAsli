# eAsli System - Phase 2 Quick Start Guide

## 🚀 Getting Started

### 1. Start the Application
```bash
cd /Users/leezanm/eAsli-app
php artisan serve --host=0.0.0.0 --port=8000
```

### 2. Access the Application
Open your browser and navigate to: `http://localhost:8000`

---

## 📋 Key Routes

### Public Pages
| Route | Purpose |
|-------|---------|
| `/` | Homepage & Landing |
| `/shops/map` | Interactive Shop Map |
| `/products` | Browse Products |
| `/customers/create` | Register as Customer |

### Artisan Routes
| Route | Purpose |
|-------|---------|
| `/artisans/login` | Artisan Login |
| `/artisans/create` | Artisan Registration |
| `/artisans/dashboard` | Artisan Dashboard |
| `/shops` | Manage Shops |
| `/shops/create` | Add New Shop |
| `/products` | Manage Products |
| `/products/create` | Add New Product |
| `/sales` | View Sales |
| `/sales/create` | Record Sale |
| `/reports` | View Reports |

### Customer Routes
| Route | Purpose |
|-------|---------|
| `/customers` | Customer Dashboard |
| `/customers/create` | Register Customer |

---

## 🧪 Test Accounts

### Create Test Data

#### 1. Register an Artisan
1. Navigate to `http://localhost:8000/artisans/create`
2. Fill in the form:
   - Name: Artisan Test
   - Email: artisan@test.com
   - Phone: 0123456789
   - Password: password123
3. Click Register
4. Login at `/artisans/login`

#### 2. Create a Shop
1. After login, go to Shops
2. Click "Tambah Kedai Baru"
3. Fill in:
   - Name: Kedai Test
   - Location: Kuala Lumpur
   - Latitude: 3.1357
   - Longitude: 101.6689
   - Status: Aktif
4. Submit

#### 3. Add Products
1. Go to Products
2. Click "Tambah Produk Baru"
3. Fill in:
   - Shop: Select your shop
   - Name: Test Product
   - Category: electronics
   - Price: 99.99
   - Stock: 50
4. Submit

#### 4. Register a Customer
1. Navigate to `http://localhost:8000/customers/create`
2. Fill in:
   - Name: Customer Test
   - Email: customer@test.com
   - Phone: 0187654321
3. Submit

#### 5. Record a Sale
1. Go to Sales (as Artisan)
2. Click "Rekod Jualan Baru"
3. Select:
   - Product: Your test product
   - Customer: Your test customer
   - Quantity: 2
4. Submit

---

## 🎨 User Interface Tips

### Navigation Menu
- **Hamburger Menu**: Click on the mobile menu button to expand/collapse
- **Dropdown Menus**: Hover over user names to see additional options
- **Flash Messages**: Green for success, Red for errors

### Forms
- **Required Fields**: Marked with asterisk (*)
- **Validation**: Real-time validation on submit
- **Help Text**: Small gray text below fields for additional info

### Tables & Lists
- **Sorting**: Click column headers to sort
- **Pagination**: Navigate through pages at the bottom
- **Action Buttons**: View, Edit, Delete for each item

---

## 🗺️ Map Features

### Shop Map (`/shops/map`)
1. **Manual Search**:
   - Enter Latitude and Longitude
   - Set Radius (in km)
   - Click "Cari Kedai Terdekat"

2. **Current Location**:
   - Click "Lokasi Semasa"
   - Browser will detect your location
   - Map auto-centers on your position

3. **Shop Information**:
   - Click shop marker to view details
   - Shop list appears below map
   - Click "Lihat Kedai" to view full details

---

## 📊 Dashboard Features

### Artisan Dashboard
1. **Statistics Cards**:
   - Shops: Total number of shops
   - Products: Total products listed
   - Sales: Total transactions recorded
   - Revenue: Total sales amount

2. **Quick Actions**:
   - Add Shop
   - Add Product
   - Record Sale
   - View Reports

3. **Profile Summary**:
   - Name, email, phone display
   - Current status
   - Edit profile button

---

## 🔍 Search & Filter

### Product Search
1. Navigate to Products page
2. Enter keywords in search box
3. Select category from dropdown
4. Click "Tapis" to filter
5. Results update in real-time

### Sales Filter
- Automatically filters by logged-in artisan
- Shows total sales and revenue
- Lists all transactions

---

## 📈 Reports

### Generate Reports
1. Go to Reports page
2. Choose report type:
   - **Sales Report**: Date range based
   - **Stock Report**: Instant generation
   - **Performance Report**: Instant generation
3. Click generate button
4. Download or view results

---

## ⚙️ Troubleshooting

### Issue: Pages show errors

**Solution**: 
```bash
# Clear application cache
php artisan cache:clear
php artisan config:clear

# Regenerate routes
php artisan route:clear

# Restart server
php artisan serve --host=0.0.0.0 --port=8000
```

### Issue: Database connection error

**Solution**:
```bash
# Run migrations
php artisan migrate

# Seed sample data (optional)
php artisan db:seed
```

### Issue: 404 Not Found

**Solution**:
- Check URL spelling
- Make sure you're using correct route names
- Verify resource is created before viewing

### Issue: Authentication errors

**Solution**:
- Clear session: Press Logout
- Check credentials
- Verify email is registered
- Password is case-sensitive

---

## 📱 Responsive Design

### Mobile Devices
- Fully responsive design
- Hamburger menu on small screens
- Touch-friendly buttons and inputs
- Optimized for portrait and landscape

### Tablets
- Multi-column layouts
- Adaptive navigation
- Optimized spacing

### Desktop
- Full feature access
- Multi-column displays
- Sidebar navigation

---

## 🔐 Security Notes

1. **Login Protection**:
   - Sessions are secure
   - Passwords are hashed
   - CSRF protection enabled

2. **Data Protection**:
   - Form validation
   - SQL injection protection
   - XSS prevention

3. **Best Practices**:
   - Never share login credentials
   - Logout when finished
   - Clear browser cache on shared computers

---

## 📞 Support & Documentation

### Resources
- **Main Documentation**: `/eAsli/DOCUMENTATION.md`
- **API Reference**: `/eAsli/API_REFERENCE.md`
- **Development Guide**: `/eAsli/DEVELOPMENT_GUIDE.md`
- **Phase 2 Report**: `/PHASE_2_DEVELOPMENT.md`

### Common Questions

**Q: How to add a location to a shop?**
A: Enter latitude/longitude in the shop form. You can find coordinates using `/shops/map`

**Q: How to check product stock?**
A: Go to Products page - stock displayed on each card. Low stock (<= 5) shows a red badge.

**Q: How to view customer purchase history?**
A: Go to Customers, click on a customer name, view all transactions.

**Q: How to export reports?**
A: Use the report generation forms to create reports in JSON format (PDF/Excel can be implemented).

---

## 🎯 Next Steps

After Phase 2:
1. Test all features thoroughly
2. Gather user feedback
3. Plan Phase 3 (Deployment)
4. Consider additional features
5. Optimize performance

---

**Last Updated**: 9 January 2026  
**System Version**: 2.0.0 (Phase 2)  
**Status**: Production Ready ✅
