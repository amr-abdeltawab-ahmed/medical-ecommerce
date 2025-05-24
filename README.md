# PharmaGo - Medical E-commerce Platform

A Laravel-based e-commerce platform specialized for medical and pharmaceutical products.

## Quick Links
- 📝 [Documentation](docs/README.md)
- 💻 [Installation Guide](#installation)

## Installation Steps

1. Clone the repository:
```bash
git clone https://github.com/amr-abdeltawab-ahmed/PharmaGo.git
cd PharmaGo
```

2. Install dependencies:
```bash
composer install
npm install
```

3. Environment setup:
```bash
cp .env.example .env
php artisan key:generate
```

4. Database setup:
```bash
# Configure your database in .env file first
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=pharmago
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Run migrations and seeders
php artisan migrate --seed
```

5. Final setup:
```bash
php artisan storage:link
npm run build
```

## Admin Credentials
```
Email: admin@example.com
Password: password
```

## Project Structure

### Key Components

```
PharmaGo/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/                 # Admin controllers
│   │   │   ├── ProductController.php
│   │   │   └── OrderController.php
│   │   └── Customer/             # Customer controllers
│   │       ├── HomeController.php
│   │       ├── CartController.php
│   │       └── CheckoutController.php
│   └── Models/                   # Eloquent models
├── database/
│   ├── migrations/              # Database structure
│   └── seeders/                # Sample data
└── resources/
    └── views/
        ├── admin/              # Admin panel views
        ├── customer/           # Customer facing views
        └── layouts/           # Base templates
```

## Developer Documentation

### Core Features
1. **Product Management**
   - CRUD operations for medical products
   - Category management
   - Stock tracking

2. **Shopping System**
   - Cart management
   - Checkout process
   - Order tracking

3. **User Management**
   - Customer accounts
   - Admin dashboard
   - Role-based access

### How to Extend

1. **Adding New Features**
   - Create new controller in appropriate namespace
   - Add routes in `routes/web.php`
   - Create views in `resources/views`

2. **Customizing UI**
   - Modify Blade templates in `resources/views`
   - Update styles in `resources/css`
   - Tailwind configuration in `tailwind.config.js`

3. **Database Modifications**
   - Create new migration: `php artisan make:migration`
   - Update existing tables: Create new migration
   - Add seeders: `php artisan make:seeder`

## Database Setup

The database structure and sample data can be set up in two ways:

1. **Using Migrations & Seeders** (Recommended)
```bash
php artisan migrate --seed
```

2. **Using SQL File**
- Import `database/pharmago.sql` to your MySQL server

## Contributing
1. Fork the repository
2. Create feature branch (`git checkout -b feature/AmazingFeature`)
3. Commit changes (`git commit -m 'Add AmazingFeature'`)
4. Push to branch (`git push origin feature/AmazingFeature`)
5. Open a Pull Request

## License
This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Support
For support, email amr.abdeltawabb@gmail.com
