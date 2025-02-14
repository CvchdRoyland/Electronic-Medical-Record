# Patient Registration System
## Royland C. Badua  
Computer Programmer I  
## CAGAYAN VALLEY CENTER FOR HEALTH DEVELOPMENT  

## Installation Guide

### Prerequisites

Ensure you have the following installed on your system:

- PHP (>= 8.1)
- Composer
- MySQL or any supported database
- Node.js & npm (if using frontend assets)

### Step 1: Clone the Repository

```sh
git clone https://github.com/CvchdRoyland/Electronic-Medical-Record.git
cd Electronic-Medical-Record
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
APP_URL=http://127.0.0.1:8000

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

Run the seeder to populate the database with initial data:

```sh
php artisan db:seed
```

Run the command to create a symbolic link for file storage:

```sh
php artisan storage:link
```

### Step 7: Start the Development Server

```sh
php artisan serve
```

Access the application at: [http://127.0.0.1:8000](http://127.0.0.1:8000)

## Admin Panel (Filament)

Access the Filament Admin Panel at:

```
http://127.0.0.1:8000/emr
```

**Default Admin Credentials:**
- **Username:** admin@admin.com
- **Password:** password

### Additional Commands

Clear cache if necessary:

```sh
php artisan config:clear
php artisan cache:clear
php artisan view:clear
```

Happy coding! 🚀

