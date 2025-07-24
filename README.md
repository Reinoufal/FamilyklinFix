# FamilyKlin - Hydrocleaning Service System

![Laravel](https://img.shields.io/badge/Laravel-11.x-red.svg)
![PHP](https://img.shields.io/badge/PHP-8.2+-blue.svg)
![Filament](https://img.shields.io/badge/Filament-3.x-orange.svg)
![Tailwind CSS](https://img.shields.io/badge/Tailwind%20CSS-3.x-blue.svg)

**FamilyKlin** adalah sistem manajemen layanan hydrocleaning profesional yang mengutamakan kualitas, kebersihan, dan kepuasan pelanggan. Kami melayani rumah tangga, kantor, dan tempat usaha lainnya dengan teknologi modern dan tim profesional.

## 🚀 Fitur Utama

### 🔧 Manajemen Layanan
- **20+ Layanan Hydrocleaning** dengan teknologi terbaru
- **Layanan Cuci Biasa** untuk kebutuhan standar
- **Search & Filter** dengan sorting berdasarkan nama, harga, dan tanggal
- **Real-time filtering** untuk pengalaman pengguna yang optimal

### 🛏️ Sistem Produk & Booking
- **Product Options System** untuk semua kategori produk:
  - **Kasur**: Services + Size options
  - **Sofa**: Services + Jumlah Dudukan
  - **Perlengkapan Bayi**: Services + Kondisi
  - **Add-On Products**: Services + Jumlah/Custom options
- **Dynamic Pricing** dengan real-time calculation
- **Booking Forms** dengan informasi pelanggan lengkap
- **Price Breakdown** yang detail dan transparan

### 👨‍💼 Admin Panel
- **Filament Admin Panel** dengan authentication
- **Product Management** dengan kategori dan options
- **Service Management** dengan pricing
- **User Management** dengan role-based access

### 🎨 User Interface
- **Responsive Design** dengan Tailwind CSS
- **Interactive Components** dengan JavaScript
- **Modern UI/UX** yang user-friendly
- **Mobile-First Approach**

## 📋 Kategori Layanan

### 🏠 Hydrocleaning Services
- Hydrocleaning Rumah Tinggal (Rp 250.000)
- Hydrocleaning Kantor (Rp 400.000)
- Deep Cleaning Kamar Mandi (Rp 150.000)
- Pembersihan Karpet & Sofa (Rp 200.000)
- Hydrocleaning Dapur (Rp 180.000)
- Dan 10+ layanan lainnya

### 🧽 Cuci Biasa Services
- Cuci Mobil Reguler (Rp 50.000)
- Cuci Motor Standar (Rp 25.000)
- Cuci Sepatu Reguler (Rp 30.000)
- Cuci Tas & Ransel (Rp 40.000)
- Cuci Helm Standar (Rp 20.000)

## 🛠️ Teknologi

- **Backend**: Laravel 11.x
- **Frontend**: Blade Templates + Tailwind CSS
- **Admin Panel**: Filament 3.x
- **Database**: MySQL
- **Asset Building**: Vite
- **Authentication**: Laravel Breeze + Custom Admin Auth

## 📦 Instalasi

### Prerequisites
- PHP 8.2+
- Composer
- Node.js & NPM
- MySQL

### Setup Instructions

1. **Clone Repository**
   ```bash
   git clone https://github.com/Reinoufal/FamilyklinFix
   cd FamilyklinFIx
   ```

2. **Install Dependencies**
   ```bash
   composer install
   npm install
   ```

3. **Environment Setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Database Configuration**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=familyklin
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Database Setup**
   ```bash
   php artisan migrate:fresh --seed
   ```

6. **Build Assets**
   ```bash
   npm run build
   ```

7. **Run Application**
   ```bash
   php artisan serve
   ```

## 🔐 Default Admin Credentials

- **Email**: `admin@admin.com`
- **Password**: `password`

## 📱 Halaman Utama

- **Homepage**: `/` - Landing page dengan informasi perusahaan
- **Services**: `/services` - Daftar layanan dengan search & filter
- **Products**: `/products` - Katalog produk dengan booking system
- **Admin Panel**: `/admin` - Dashboard admin dengan Filament

## 🎯 Product Options

### Kasur
- **Services**: HydroVaccum, Cuci Bersih
- **Size**: Single (100x200), Single (120x200), Queen (160x200), King (180x200), Super King (200x200)

### Sofa
- **Services**: Deep Clean Vacuum, Fabric Protection, Stain Removal, Deodorizing Treatment
- **Jumlah Dudukan**: 1 Seater, 2 Seater, 3 Seater, L-Shape, Sectional

### Perlengkapan Bayi
- **Services**: Gentle Baby-Safe Clean, Anti-Bacterial Treatment, Hypoallergenic Clean
- **Kondisi**: Normal Cleaning, Heavy Stains, Deep Sanitization

### Add-On Products
- **Car Interior**: Interior Vacuum, Seat Deep Clean, Dashboard Polish, Carpet Shampoo
- **Karpet**: Deep Vacuum, Stain Treatment, Deodorizing
- **Gorden**: Dust Removal, Fabric Refresh, Anti-Bacterial

## 🚀 Deployment

### Production Setup
1. Set `APP_ENV=production` in `.env`
2. Set `APP_DEBUG=false`
3. Configure proper database credentials
4. Run `php artisan config:cache`
5. Run `php artisan route:cache`
6. Run `php artisan view:cache`

## 🤝 Contributing

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit your changes (`git commit -m 'Add some AmazingFeature'`)
4. Push to the branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## 📄 License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## 📞 Contact

**FamilyKlin**
- Website: [familyklin.com](http://familyklin.com)
- Email: info@familyklin.com
- Phone: +62 xxx-xxxx-xxxx

---

**Developed with ❤️ for professional hydrocleaning services**
