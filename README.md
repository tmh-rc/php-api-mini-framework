# PHP API Mini Framework

A PHP API mini framework like [Laravel](https://laravel.com) without using any php packages. Include routing system, Facade, helper functions.

## Usage

### Routing

Support RESTful Routes
```php
// routes/api.php
use Controllers\HomeController;
use Controllers\UserController;

$router->get('/', HomeController::class, 'index');
$router->get('/users', UserController::class, 'index');
$router->get('/users/{id}', UserController::class, 'show');
$router->post('/users', UserController::class, 'store');
$router->put('/users/{id}', UserController::class, 'update');
$router->delete('/users/{id}', UserController::class, 'destroy');
```

### Controllers
Support RESTful Controllers
```php
// Controllers/UserController.php
class UserController
{
    public function index()
    {
        $users = DB::query('select * from users')->get();

        return response()->json([
            'data' => $users,
        ]);
    }

    public function show($id)
    {
        $user = DB::query('select * from users where id=:id', [
            'id' => $id,
        ])->first();

        return response()->json([
            'data' => $user,
        ]);
    }

    public function store()
    {
        $name = request('name');
        $email = request('email');
        $password = request('password');

        $result = DB::query('insert into users (name, email, password) values (:name, :email, :password)', [
            'name' => $name,
            'email' => $email,
            'password' => bcrypt($password),
        ]);

        return $this->show($result->lastInsertId());
    }
```

### Facade

Support Facade as [Laravel](https://laravel.com/docs/10.x/facades#main-content)

```php
use Core\Facades\DB;

DB::query('select * from users')->get();
DB::query('select * from users where id=:id', ['id' => 1])->first();
DB::query('select * from users where id=:id', ['id' => 1])->firstOrFail();
```

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

## Formatting

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

## Todo

- [x] Validation
- [ ] Middleware
- [ ] Authentication