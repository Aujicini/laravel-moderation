![Run Tests - Current](https://github.com/Aujicini/laravel-moderation/workflows/Run%20Tests%20-%20Current/badge.svg)
![Run Tests - Older](https://github.com/Aujicini/laravel-moderation/workflows/Run%20Tests%20-%20Older/badge.svg)

# Laravel Moderation

A simple content moderation system for your fresh Laravel Application.

## Supported PHP Versions

- <i>PHP 8.0 | Current</i>
- <i>PHP 7.4 | Current</i>
- <i>PHP 7.3 | Support ends 01/01/2022</i>
- <i>PHP 7.2 | Support ends 11/01/2021</i>

## Support Laravel Versions

- <i>Laravel 8 | Current</i>
- <i>Laravel 7 | Support ends 01/01/2022</i>
- <i>Laravel 6 | Support ends 11/01/2021</i>

## Features

- Ticketing System
- User Ban Management
- User Impersonation

## Installation

It's very easy to install, just run the one liner comand line code.

```sh
composer require aujicini/laravel-moderation
```

This package will auto-register it's self, but if you prefer to register the service provider manually then you add this line in your `config/app.php` file in the providers array.

```php
\Aujicini\Moderation\ModerationServiceProvider::class,
```

## Basic Usage
