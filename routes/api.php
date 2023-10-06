<?php

use Controllers\HomeController;
use Controllers\UserController;

$router->get('/', HomeController::class, 'index');
$router->get('/users', UserController::class, 'index');
$router->get('/users/{id}', UserController::class, 'show');
$router->post('/users', UserController::class, 'store');
$router->put('/users/{id}', UserController::class, 'update');
$router->delete('/users/{id}', UserController::class, 'destroy');
