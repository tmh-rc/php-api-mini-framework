<?php

const BASE_PATH = __DIR__ . '/../';
require 'Core/autoload.php';
require 'Core/functions.php';

$config = require_once base_path('config/app.php');
$username = $config['database']['user'];
$password = $config['database']['password'];
