<?php

use Core\Router;
use Core\Exceptions\ValidationException;

const BASE_PATH = __DIR__ . '/../';

require BASE_PATH . 'Core/autoload.php';
require BASE_PATH . 'Core/functions.php';

$router = new Router;
require base_path('routes/api.php');
try {
    $router->route();
} catch (ValidationException $e) {
    return response()->json([
        'errors' => $e->getErrors(),
    ], 422);
} catch (\Throwable $e) {
    throw new Exception('Error: ' . $e->getMessage());
}
