<?php

namespace Core;

use Exception;
use Middleware\Middleware;

class Router
{
    protected $routes = [];

    public function add($method, $uri, $controller, $action)
    {
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'action' => $action,
            'middleware' => null,
        ];

        return $this;
    }

    public function get($uri, $controller, $action)
    {
        return $this->add('GET', $uri, $controller, $action);
    }

    public function post($uri, $controller, $action)
    {
        return $this->add('POST', $uri, $controller, $action);
    }

    public function delete($uri, $controller, $action)
    {
        return $this->add('DELETE', $uri, $controller, $action);
    }

    public function patch($uri, $controller, $action)
    {
        return $this->add('PATCH', $uri, $controller, $action);
    }

    public function put($uri, $controller, $action)
    {
        return $this->add('PUT', $uri, $controller, $action);
    }

    public function middleware($key)
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $key;

        return $this;
    }

    public function route()
    {
        $uri = parse_url($_SERVER['REQUEST_URI'])['path'];
        $method = request()->method();

        foreach ($this->routes as $route) {
            $pattern = preg_replace('/{\w+}/', '(\w+)', $route['uri']);
            $pattern = "@^$pattern$@";
            if (preg_match($pattern, $uri, $matches) && $route['method'] === strtoupper($method)) {
                Middleware::resolve($route['middleware']);
                unset($matches[0]);
                $obj = new $route['controller'];
                $method = $route['action'];
                $params = $matches;
                try {
                    call_user_func_array([$obj, $method], $params);
                } catch (\Throwable $e) {
                    throw new Exception('Error: '.$e->getMessage());
                }
            }
        }

        abort();
    }
}
