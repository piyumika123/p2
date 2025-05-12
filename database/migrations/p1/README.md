# Supermarket Stock Management System

This project is a Supermarket Stock Management System that allows for the management of supermarket inventory. It includes a model for handling stock items and a migration for creating the necessary database table.

## Project Structure

```
p1
├── app
│   ├── Models
│   │   └── SupermarketStock.php
├── database
│   └── migrations
│       └── 2023_10_01_000000_create_supermarket_stock_table.php
├── composer.json
├── .env
└── README.md
```

## Features

- **SupermarketStock Model**: Defines the structure of the supermarket stock items, including properties such as item name, quantity, purchase price, loyalty value, and branch ID.
- **Database Migration**: Creates the `supermarket_stock` table with the necessary columns to store stock information.

## Installation

1. Clone the repository.
2. Run `composer install` to install dependencies.
3. Set up your `.env` file with the appropriate database connection settings.
4. Run the migration using `php artisan migrate` to create the database table.

## Usage

You can interact with the SupermarketStock model to manage stock items in your application. Use Eloquent methods to create, read, update, and delete stock records.

## Contributing

Feel free to submit issues or pull requests for improvements or bug fixes.