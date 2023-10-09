<?php

use Core\Database;

require_once 'command.php';

$db = new Database($config['database']['dsn'], $username, $password);

try {
    $password = '$2y$10$FOUbMZ3pZFiX97M/iFeyLu1aihqL8qfPjzuc4CGXX05FN.1VfTyTi';
    $sql = "INSERT INTO users
                (`name`, `email`, `password`)
            VALUES
                ('Mg Mg', 'mgmg@example.com', '$password'),
                ('Aung Aung', 'aungaung@example.com', '$password'),
                ('Hla Hla', 'hlahla@example.com', '$password'),
                ('Tun Tun', 'tuntun@example.com', '$password')";
    $db->query($sql);
    echo "New records created successfully. \n";
} catch (PDOException $e) {
    echo $sql . "\n" . $e->getMessage();
}
