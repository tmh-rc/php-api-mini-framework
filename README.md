# PHP API Mini Framework

## Installation

Setup database credentials in `config/app.php`

```php
'database' => [
    'dsn' => [
        'host' => 'localhost',
        'port' => 3306,
        'dbname' => 'php_api',
        'charset' => 'utf8mb4',
    ],
    'user' => 'root',
    'password' => 'root',
],
```

To create a database, the tables, and insert dummy data, run the following command:

```
php artisan setup
```

Run the dev server (the output will give the address):

```
php artisan serve
```
or
```
php -S localhost:3000 -t public/
```

### Formatting

Firstly, install PHP dependencies
```
composer install
```

Format
```
vendor/bin/pint
```

see more detail:
https://laravel.com/docs/10.x/pint#running-pint

### Todo

- [ ] Validation
- [ ] Middleware
- [ ] Authentication