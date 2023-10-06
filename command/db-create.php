<?php

use Core\Database;

require_once 'command.php';

$database = $config['database']['dsn']['dbname'];
$dsn = [
    'host' => $config['database']['dsn']['host'],
];

$db = new Database($config, $username, $password);

try {
    $sql = "DROP DATABASE IF EXISTS $database";
    $db->query($sql);
    $sql = "CREATE DATABASE $database";
    $db->query($sql);
    echo "Database created successfully. \n";
} catch (PDOException $e) {
    echo $sql."\n".$e->getMessage();
}
