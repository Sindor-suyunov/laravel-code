# About

Helpful UI web interface for generating code (migration, model,factory,controller .. ) in Laravel (save your time)

## Installation and usage

**1. Install package to your laravel project**

```bash
composer require sindor/laravel-code
```
**2. Publish files**

```bash
php artisan vendor:publish --tag=laravel-code
```

**3. Go to link (home_url + /laravel-code)**

```bash
http://localhost/laravel-code/
```
**4. Enjoy :)**

# Configuration

**You can configure generating Class namespace and saving path**

```bash
  path: config/laravel-code.php
```

**You can customize stub files(templates)**

```bash
  path: stubs/laravel-code/*
```
