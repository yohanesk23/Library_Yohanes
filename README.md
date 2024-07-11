# Laravel Application For Library Management System

## Table of Contents

- [Introduction](#introduction)
- [Requirements](#requirements)
- [Installation](#installation)
- [Configuration](#configuration)
- [Running the Application](#running-the-application)

## Introduction

This is a Laravel application designed to provide a robust foundation for web projects. It follows best practices and is built with scalability and performance in mind.

## Requirements

- PHP >= 8.0
- Composer
- MySQL or PostgreSQL
- Node.js & NPM
- Git (optional, for version control)

## Installation

1. **Clone the repository**

    ```bash
    git clone https://github.com/yourusername/your-laravel-app.git
    cd your-laravel-app
    ```

2. **Install PHP dependencies**

    ```bash
    composer install
    ```

3. **Install Node.js dependencies**

    ```bash
    npm install
    ```

## Configuration

1. **Copy the `.env.example` file to `.env`**

    ```bash
    cp .env.example .env
    ```

2. **Generate an application key**

    ```bash
    php artisan key:generate
    ```

3. **Configure environment variables**

    Open the `.env` file and update the following variables:

    ```plaintext
    APP_NAME=Laravel
    APP_ENV=local
    APP_KEY=base64:...
    APP_DEBUG=true
    APP_URL=http://localhost

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database
    DB_USERNAME=your_username
    DB_PASSWORD=your_password

    BROADCAST_DRIVER=log
    CACHE_DRIVER=file
    QUEUE_CONNECTION=sync
    SESSION_DRIVER=file
    SESSION_LIFETIME=120
    ```

4. **Run database migrations**

    ```bash
    php artisan migrate
    ```

## Running the Application

1. **Start the development server**

    ```bash
    php artisan serve
    ```

    Visit `http://localhost:8000` in your browser.

## Deploy the application on Hostinger

### Step 1: Prepare the Environment

1. **PHP Version**: Ensure that your Hostinger account is using PHP version >= 8.0. You can set this in the Hostinger control panel under the "PHP Configuration" section.
2. **Composer**: Make sure you have Composer installed on your local machine to manage PHP dependencies.

### Step 2: Upload Files to Hostinger

1. **Connect via FTP**: Use an FTP client (like FileZilla) to connect to your Hostinger account. You will need your FTP credentials provided by Hostinger.
2. **Upload Project Files**: Upload all files from your Laravel project to the `public_html` directory on Hostinger.

### Step 3: Configure the Database

1. **Create a Database**: In the Hostinger control panel, go to the "Databases" section and create a new MySQL database. Note down the database name, username, and password.
2. **Update .env File**: Edit the `.env` file in your Laravel project to include the database details:

    ```plaintext
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_username
    DB_PASSWORD=your_database_password
    ```

### Step 4: Install Dependencies

1. **SSH Access**: If you have SSH access, you can connect to your Hostinger account via SSH and navigate to your project directory.
2. **Run Composer**: Install PHP dependencies by running:

    ```bash
    composer install
    ```

3. **Run NPM**: Install Node.js dependencies by running:

    ```bash
    npm install
    npm run prod
    ```

### Step 5: Run Migrations

1. **Migrate Database**: Run the following command to migrate your database:

    ```bash
    php artisan migrate
    ```

### Step 6: Set Up the Web Server

1. **Web Server Configuration**: Ensure that the web server is pointing to the `public` directory of your Laravel project. You can do this in the Hostinger control panel under the "Website" section.
2. **Set File Permissions**: Make sure that the `storage` and `bootstrap/cache` directories are writable by the web server:

    ```bash
    chmod -R 775 storage
    chmod -R 775 bootstrap/cache
    ```

3. **.htaccess File**: Ensure that you have a `.htaccess` file in your `public` directory with the following content to handle URL rewriting:

    ```plaintext
    <IfModule mod_rewrite.c>
        <IfModule mod_negotiation.c>
            Options -MultiViews -Indexes
        </IfModule>

        RewriteEngine On

        # Handle Authorization Header
        RewriteCond %{HTTP:Authorization} .
        RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

        # Redirect Trailing Slashes If Not A Folder...
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteCond %{REQUEST_URI} (.+)/$
        RewriteRule ^ %1 [L,R=301]

        # Send Requests To Front Controller...
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteRule ^ index.php [L]
    </IfModule>
    ```

Now your Laravel application should be deployed and running on Hostinger.
