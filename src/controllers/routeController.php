<?php
class RouteController
{
    protected $routes = [];

    public function addRoute(string $path, callable $handler)
    {
        $this->routes[$path] = $handler;
    }

    public function handle(string $path)
    {
        if (isset($this->routes[$path])) {
            $handler = $this->routes[$path];
            $handler();
        } else {
            http_response_code(404);
            echo "Not Found";
        }
    }
}
