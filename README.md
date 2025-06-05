# Apikenz - Multi-user Employee Management System (API)

**Apikenz** is a Laravel-based employee management system built with Sanctum authentication and a RESTful API structure. It provides a comprehensive solution for managing employees across multiple departments, enabling communication, time tracking, profiles, and reporting features.

## 🚀 Key Features

- **Multi-user system** with secure Laravel Sanctum authentication
- **Employee profiles** with editable personal and professional info
- **4 Departments**, each with internal:
  - **Chat system** for employees to communicate with each other
  - **Time tracking** (start time, end time)
  - **Task count** and productivity monitoring
- **Role-based access** to ensure proper data control
- **Weekly and monthly employee performance reports**
- **API-based structure** to support frontend/mobile integrations

## 🔐 Authentication

Built using **Laravel Sanctum** for API token-based authentication.

- Registration & login for employees
- Role-based access to routes
- Secure logout and token invalidation

## 🧪 Tech Stack

- PHP 8.2.x
- Laravel Framework
- Laravel Sanctum
- MySQL
- Eloquent ORM
- Laravel API Resources
- Postman (for API testing)

## ⚙️ Installation

```bash
# 1. Clone the repository
git clone https://github.com/Amany359/Apikenz.git

# 2. Navigate into the project directory
cd Apikenz

# 3. Install PHP dependencies
composer install

# 4. Copy .env and configure your database
cp .env.example .env

# 5. Generate app key
php artisan key:generate

# 6. Run migrations and seed data
php artisan migrate --seed

# 7. Serve the app
php artisan serve
