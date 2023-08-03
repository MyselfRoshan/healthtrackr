<?php

namespace App;

use App\Http\Middleware\Middleware;

class Router
{
    private $routes = [];

    private function add($uri, $controller, $method)
    {
        $this->routes[] = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'middleware' => null
        ];
        // $this->routes[] = compact('uri', 'controller', 'method');
        return $this;
    }
    public function get($uri, $controller)
    {
        return $this->add($uri, $controller, 'GET');
    }
    public function post($uri, $controller)
    {
        return $this->add($uri, $controller, 'POST');
    }
    public function delete($uri, $controller)
    {
        return $this->add($uri, $controller, 'DELETE');
    }
    public function put($uri, $controller)
    {
        return $this->add($uri, $controller, 'PUT');
    }
    public function patch($uri, $controller)
    {
        return $this->add($uri, $controller, 'PATCH');
    }

    public function route($uri, $method)
    {
        foreach ($this->routes as $route) {
            if ($route['uri'] === $uri && $route['method'] === strtoupper($method)) {
                Middleware::resolve($route['middleware']);
                return require base_path("app/Http/Controllers/{$route['controller']}");
            }
        }
        $this->abort();
    }


    public function only($value)
    {
        $this->routes[array_key_last($this->routes)]['middleware'] = $value;
        return $this;
    }


    protected function abort($code = 404)
    {
        http_response_code($code);

        require base_path("/views/{$code}.php");

        die();
    }
}
