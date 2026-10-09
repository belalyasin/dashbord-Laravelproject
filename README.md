# Laravel Admin Dashboard

Admin dashboard built with Laravel 8.

## Features

- Separate logins for admins and users (two auth guards)
- CRUD for admins, users and specialties

## Tech stack

PHP, Laravel 8, MySQL, Blade

## Getting started

```bash
git clone https://github.com/belalyasin/dashbord-Laravelproject.git
cd dashbord-Laravelproject
composer install
cp .env.example .env      # set the DB_* values
php artisan key:generate
php artisan migrate
php artisan serve
```

The dashboard is under `/cms/admin`.
