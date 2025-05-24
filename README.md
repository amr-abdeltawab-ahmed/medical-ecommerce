# PharmaGo - Medical E-commerce Platform

A Laravel-based e-commerce platform specialized for medical and pharmaceutical products, built with a robust layered architecture for maintainability and scalability.

## Quick Links
- 📝 [Documentation](docs/README.md)
- 💻 [Installation Guide](#installation)

## Installation Steps

1. Clone the repository:
```bash
git clone https://github.com/amr-abdeltawab-ahmed/medical-ecommerce.git
cd medical-ecommerce
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
php artisan migrate
php artisan db:seed
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

## Project Architecture

PharmaGo follows a clean, layered architecture pattern that separates concerns and promotes maintainability:

### Architectural Layers

1. **Presentation Layer (Controllers & Views)**
   - Handles HTTP requests and responses
   - Manages view rendering
   - Validates input data
   - Routes requests to appropriate services

2. **Service Layer**
   - Implements business logic
   - Orchestrates data flow between controllers and repositories
   - Handles complex operations and transactions
   - Ensures business rules and validations

3. **Repository Layer**
   - Manages data persistence
   - Abstracts database operations
   - Provides clean interfaces for data access
   - Implements caching strategies

4. **Model Layer**
   - Defines data structures
   - Implements relationships
   - Handles model-specific logic
   - Provides data attributes and mutators

### Project Structure

```
PharmaGo/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/                 # Admin controllers
│   │   │   └── Customer/             # Customer controllers
│   │   └── Requests/                # Form requests & validation
│   ├── Services/
│   │   ├── Cart/                    # Cart management services
│   │   ├── Checkout/               # Checkout processing services
│   │   └── Product/                # Product management services
│   ├── Repositories/
│   │   ├── Contracts/              # Repository interfaces
│   │   └── Eloquent/              # Concrete repository implementations
│   ├── Models/                    # Eloquent models
│   └── Observers/                # Model observers for events
├── database/
│   ├── migrations/              # Database structure
│   └── seeders/                # Sample data
├── resources/
│   └── views/
│       ├── admin/              # Admin panel views
│       ├── customer/           # Customer facing views
│       └── layouts/           # Base templates
└── routes/
    ├── web.php               # Web routes
    └── api.php              # API routes
```

### Key Components and Their Responsibilities

1. **Controllers (`app/Http/Controllers/`)**
   - Handle HTTP requests
   - Delegate to services
   - Return responses/views
   - Minimal business logic

2. **Services (`app/Services/`)**
   - Implement business logic
   - Coordinate between repositories
   - Handle complex operations
   - Maintain business rules

3. **Repositories (`app/Repositories/`)**
   - Abstract data access
   - Implement CRUD operations
   - Handle data persistence
   - Cache management

4. **Models (`app/Models/`)**
   - Define data structure
   - Manage relationships
   - Implement scopes
   - Handle model events

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
   - Add corresponding service and repository classes
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
