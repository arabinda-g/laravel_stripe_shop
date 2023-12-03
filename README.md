# Laravel Stripe Shop

## About
This is a simple shop application built with Laravel and Stripe.

## Requirements
- PHP 8.1 or higher
- Composer
- MySQL
- Node.js
- NPM

## Installation
1. Clone the repository
2. Run `composer install`
3. Copy `.env.example` to `.env`
4. Run `npm install`
5. Run `npm run dev`

## Configuration
1. Create a new database
2. Update the database credentials in `.env`
3. Update the Stripe credentials in `.env`
4. Generate a new application key with `php artisan key:generate`
5. Run `php artisan migrate`
6. Run `php artisan db:seed`
7. Run `php artisan serve`
