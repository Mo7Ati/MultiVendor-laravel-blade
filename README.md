# MultiVendor Laravel Blade

A multi-vendor e-commerce platform built with Laravel and Blade. This project includes separate dashboards for administrators, vendors, and delivery personnel, offering a powerful and customizable marketplace solution.

## Features

- Multi-authentication (Admin, Vendor, Delivery)
- Product and category management
- Order tracking
- Admin dashboard with full control
- Vendor and delivery management
- Cart and checkout system
- WhatsApp account verification
- Basic frontend (work in progress)

## Getting Started

### Prerequisites

- PHP 8.1 or higher
- Composer
- MySQL or another supported database
- Node.js and npm

### Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/Mo7Ati/MultiVendor-laravel-blade.git
   cd MultiVendor-laravel-blade
   ```

2. Install PHP dependencies:

   ```bash
   composer install
   ```

3. Install frontend dependencies:

   ```bash
   npm install && npm run dev
   ```

4. Create the `.env` file:

   ```bash
   cp .env.example .env
   ```

5. Generate the application key:

   ```bash
   php artisan key:generate
   ```

6. Configure your `.env` file (especially database credentials).

7. Run the migrations and seed the database:

   ```bash
   php artisan migrate --seed
   ```

8. Serve the application:

   ```bash
   php artisan serve
   ```

### Accessing the Dashboard

The default super admin account is:

- **Email**: `admin@ps.com`
- **Password**: `password`
- This account has full access to all system features.



To access the admin dashboard, visit:

```
http://localhost:8000/admin/dashboard
```

> Make sure you're logged in as an admin user. Use seeded credentials or register a new user and assign admin role manually via database.

## Author

Created by [Mo7Ati](https://github.com/Mo7Ati)

## License

This project is licensed under the MIT License.