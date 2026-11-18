# Tau Gamma Phi & Tau Gamma Sigma | Triskelion Information System

A comprehensive, role-based enterprise web application and portal built for the **Triskelion Grand Fraternity and Sorority**. It features a custom Black & Gold public landing page, dynamic event and announcement sliders, and 5 dedicated multi-tenant Filament v4 administrative panels.

## 🚀 Key Features

* **Custom Black & Gold Public Landing Page:** Showcases the Three-Legged Stool (*Fortis, Voluntas, Fraternitas*), live directory statistics, interactive upcoming events, and announcements with adaptive horizontal sliders.

* **Multi-Panel Role Architecture:** Separate, secure Filament v4 login portals and access scopes for:
  * **Admin (`/admin`):** System-wide master control and global oversight.
  * **Council (`/council`):** Regional council governance and directives.
  * **Area (`/area`):** Area-level jurisdiction and chapter coordination.
  * **Chapter (`/chapter`):** Local chapter officers and member roster management.
  * **Member (`/member`):** Personal member profile and community portal.

* **Advanced Media Management:** Filament `FileUpload` components with grid layouts, multi-image support, and public disk storage configuration for events and announcements.

## 🛠️ Tech Stack

* **Backend:** Laravel 11, PHP 8.2+
* **Admin Framework:** Filament v4
* **Frontend:** Tailwind CSS, Blade Templates, Custom Typography (Cinzel & Inter)
* **Database:** MySQL / MariaDB

---

## 📋 System Requirements

Ensure your local or server environment meets the following requirements:
* PHP >= 8.2 with extensions: `Ctype`, `DOM`, `Fileinfo`, `Mbstring`, `OpenSSL`, `PCRE`, `PDO`, `Tokenizer`, `XML`.
* Composer
* Node.js & NPM
* MySQL or MariaDB

---

## 📖 Complete Step-by-Step Installation & Seeding Guide

Follow these exact steps to set up, configure, and run the application on your local machine:

### Step 1: Open Project Terminal
Navigate to your project root directory where your application repository is located:
```bash
cd D:\MyWorkRepository\LARAVELAPP\triskelion
```

### Step 2: Install PHP Dependencies
Download and install all required Laravel and package dependencies via Composer:
```bash
composer install
```

### Step 3: Configure Environment Variables
Copy the template environment file to create your active `.env` configuration file:
```bash
cp .env.example .env
```
Open the newly created `.env` file in your code editor and configure your database connection parameters:
```env
APP_NAME="Triskelion Portal"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=triskelion
DB_USERNAME=root
DB_PASSWORD=your_database_password
```

### Step 4: Generate Application Encryption Key
Generate the unique application key used for encryption and sessions:
```bash
php artisan key:generate
```

### Step 5: Configure Storage Disk & Symlink
Verify that your public disk configuration in `config/filesystems.php` points to `storage_app/public`, then create the symbolic link to expose stored upload files to the web server:
```bash
php artisan storage:link
```

### Step 6: Run Migrations and Database Seeders
Run your database migrations and execute the database seeders to populate your database and create your default system admin user:
* **For a fresh database wipe & re-seed:**
  ```bash
  php artisan migrate:fresh --seed
  ```
* **For running only the specific seeder on an existing database:**
  ```bash
  php artisan db:seed --class=AdminUserSeeder
  ```

### Step 7: Clear Caches and Optimize
Clear out any cached configurations or compiled assets:
```bash
php artisan optimize:clear
php artisan filament:cache-clear
```

### Step 8: Start the Local Development Server
Launch the built-in Laravel development server:
```bash
php artisan serve
```

---

## 🌐 Application Access URLs & Default Credentials

Once the development server is running, you can access the application through the following URLs:

* **Public Landing Page:** `http://127.0.0.1:8000`
* **System Admin Panel:** `http://127.0.0.1:8000/admin`
* **Council Portal:** `http://127.0.0.1:8000/council`
* **Area Portal:** `http://127.0.0.1:8000/area`
* **Chapter Portal:** `http://127.0.0.1:8000/chapter`
* **Member Portal:** `http://127.0.0.1:8000/member`

### Default System Administrator Account:
* **Email:** `admin@triskelion.org`
* **Password:** `AdminPassword123!`
* **Panel:** `/admin/login`

---

## 🛡️ License

All rights reserved &copy; Triskelion Information System. Long Live Triskelion!