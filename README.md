# Laravel Filament Project

## Installation Guide

### Prerequisites
Ensure you have the following installed on your system:
- PHP (>= 8.0)
- Composer
- MySQL or any supported database
- Node.js & npm (if using frontend assets)

### Step 1: Clone the Repository
```sh
git clone <repository-url>
cd <project-folder>
```

### Step 2: Install Dependencies
Run the following command to install all PHP dependencies:
```sh
composer update
```

### Step 3: Configure Environment Variables
Copy the example environment file and set up your database credentials:
```sh
cp .env.example .env
```
Open `.env` and update the database configuration:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password
```

### Step 4: Generate Application Key
```sh
php artisan key:generate
```

### Step 5: Run Database Migrations
```sh
php artisan migrate
```

### Step 6: Seed the Database (Optional)
If your project includes seeders, populate the database with initial data:
```sh
php artisan db:seed
```

### Step 7: Run the Development Server
```sh
php artisan serve
```
Access the application at: [http://127.0.0.1:8000](http://127.0.0.1:8000)

## Admin Panel (Filament)
If your project includes Filament Admin Panel, you can access it at:
```
http://127.0.0.1:8000/admin
```
### Create Admin User
Run the following command to create an admin user:
```sh
php artisan make:filament-user
```
Follow the prompts to set up an admin account.

## Additional Commands
Clear cache if necessary:
```sh
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

Happy coding! 🚀

