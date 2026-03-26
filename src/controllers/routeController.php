<?php
declare(strict_types=1);

class RouteController
{
    private array $routes = [];

    public function addRoute(string $path, Closure $handler): void
    {
        $this->routes[$path] = $handler;
    }

    public function receive()
    {
        $base = "/buecherantiquariat";
        $path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $path = str_replace($base, "", $path);

        $this->dispatch($path);
    }

    public function dispatch(string $path): void
    {
        if (array_key_exists($path, $this->routes)) {
            call_user_func($this->routes[$path]);
        } else {
            echo "Page not found";
        }
    }
}
