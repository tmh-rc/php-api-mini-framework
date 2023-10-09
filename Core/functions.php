<?php

use Core\Request;
use Core\Response;

if (!function_exists('base_path')) {
    function base_path($path)
    {
        return BASE_PATH . $path;
    }
}

if (!function_exists('dd')) {
    function dd(...$value)
    {
        echo '<pre>';
        var_dump($value);
        echo '</pre>';
        exit();
    }
}

if (!function_exists('p')) {
    function p($array)
    {
        echo '<pre>' . print_r($array, true) . '</pre>';
        exit();
    }
}

if (!function_exists('abort')) {
    function abort($code = 404)
    {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($code);

        echo json_encode(['message' => 'Not found.']);

        exit();
    }
}

if (!function_exists('response')) {
    function response()
    {
        return new Response;
    }
}

if (!function_exists('request')) {
    function request($key = null, $default = null)
    {
        $request = new Request;

        if ($key) {
            return $request->query($key, $default) ?? $request->input($key, $default);
        }

        return $request;
    }
}

if (!function_exists('bcrypt')) {
    function bcrypt($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }
}

if (!function_exists('title_case')) {
    function title_case($str)
    {
        return ucwords(str_replace('_', ' ', $str));
    }
}
