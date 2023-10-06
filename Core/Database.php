<?php

namespace Core;

use Exception;
use PDO;
use PDOException;

class Database
{
    public $connection;

    public $statement;

    public function __construct($config, $username = 'root', $password = '')
    {
        $dsn = 'mysql:'.http_build_query($config, '', ';');

        $this->connection = new PDO($dsn, $username, $password, [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }

    public function query($query, $params = [])
    {
        try {
            $this->statement = $this->connection->prepare($query);

            $this->statement->execute($params);
        } catch (PDOException $e) {
            throw new Exception('Error: '.$e->getMessage());
        }

        return $this;
    }

    public function get()
    {
        return $this->statement->fetchAll();
    }

    public function first()
    {
        return $this->statement->fetch();
    }

    public function firstOrfail()
    {
        $result = $this->first();

        if (! $result) {
            abort();
        }

        return $result;
    }

    public function lastInsertId()
    {
        return $this->connection->lastInsertId();
    }
}
