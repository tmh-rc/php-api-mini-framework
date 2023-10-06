<?php

namespace Core;

class Request
{
    public function method()
    {
        $method = $_POST['_method'] ?? $_SERVER['REQUEST_METHOD'];

        return strtolower($method);
    }

    public function query($key = null, $default = null)
    {
        if (empty($_SERVER['QUERY_STRING'])) {
            return null;
        }

        parse_str($_SERVER['QUERY_STRING'], $query);

        if ($key) {
            return $query[$key] ?? $default;
        }

        return $query;
    }

    public function all()
    {
        return $_POST ?? [];
    }

    public function input($key, $default = null)
    {
        return $this->all()[$key] ?? $default;
    }

    public function has($key)
    {
        return (bool) $this->query($key);
    }
}
