<?php

class Router
{
    protected array $routes = [];

    public function add($method, $uri, $controller):void
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method
        ];
    }

    public function get($uri, $controller):void
    {
        $this->add('GET', $uri, $controller);
    }

    public function post($uri, $controller):void
    {
        $this->add('POST', $uri, $controller);
    }

    public function delete($uri, $controller):void
    {
        $this->add('DELETE', $uri, $controller);
    }

    public function patch($uri, $controller):void
    {
        $this->add('PATCH', $uri, $controller);
    }

    public function put($uri, $controller):void
    {
        $this->add('PUT', $uri, $controller);
    }

    public function match(string $uri, string $method): void
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === $method) {
                if (file_exists($route['controller'])) {
                    require_once $route['controller'];
                    exit();
                }
            }
        }

    }
}



