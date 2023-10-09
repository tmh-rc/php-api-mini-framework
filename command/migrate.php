<?php

use Core\Database;

require_once 'command.php';

$db = new Database($config['database']['dsn'], $username, $password);

try {
    $sql = 'CREATE TABLE users (
            id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL,
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )';
    $db->query($sql);
    echo "Table users created successfully. \n";
} catch (PDOException $e) {
    echo $sql . "\n" . $e->getMessage();
}
