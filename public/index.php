<?php

use Core\Router;

const BASE_PATH = __DIR__.'/../';

require BASE_PATH.'Core/autoload.php';
require BASE_PATH.'Core/functions.php';

$router = new Router;
require base_path('routes/api.php');
$router->route();
