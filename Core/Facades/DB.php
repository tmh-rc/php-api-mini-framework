<?php

namespace Core\Facades;

use Core\Database;

/**
 * @see \Core\Database
 */
class DB extends Facade
{
    protected static function getFacadeAccessor()
    {
        $config = require base_path('config/app.php');

        $username = $config['database']['user'];
        $password = $config['database']['password'];
        $dsn = $config['database']['dsn'];

        return new Database($dsn, $username, $password);
    }
}
