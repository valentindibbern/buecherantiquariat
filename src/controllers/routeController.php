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
        echo "init-path: " . $path . "<br>";

        $path = substr($path, strlen($base));
        echo "base-removed: " . $path . "<br>";

        if ($path === "" || $path === false) {
            $path = "/";
        }

        if ($path[0] != "/") {
            $path = "/" . $path;
        }

        echo "normalized-path: " . $path . "<br>";

        $this->patternDispatch($path);
    }

    public function patternDispatch(string $path): void
    {
        foreach ($this->routes as $route => $handler) {
            $pattern = preg_replace("#\{\w+\}#", "([^\/]+)", $route);

            if (preg_match("#^$pattern$#", $path, $matches)) {
                print_r($matches);
                return;
            }
        }
    }

    // legacy handle method
    // public function simpleDispatch(string $path): void
    // {
    //     if (array_key_exists($path, $this->routes)) {
    //         call_user_func($this->routes[$path]);
    //     } else {
    //         echo "Page not found";
    //     }
    // }

    // // legacy handle method
    // public function handle($path)
    // {
    //     switch ($path) {
    //         case "/":
    //             echo "home";
    //             break;
    //         case "about":
    //             echo "about";
    //             break;
    //         default:
    //             echo $path;
    //             echo "404";
    //             break;
    //     }
    // }
}
