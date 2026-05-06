<?php
declare(strict_types=1);

namespace App\Controllers;
use Closure;
use mysqli;

class RouteController
{
    private array $routes = [];

    private \App\Controllers\AdminController $adminController;
    private \App\Controllers\CRUDController $crudController;
    private \App\Controllers\DetailController $detailController;
    private \App\Controllers\KachelController $kachelController;
    private \App\Controllers\LoginController $loginController;
    private \App\Controllers\SearchController $searchController;

    public function __construct(
        \App\Controllers\AdminController $adminController,
        \App\Controllers\CRUDController $crudController,
        \App\Controllers\DetailController $detailController,
        \App\Controllers\KachelController $kachelController,
        \App\Controllers\LoginController $loginController,
        \App\Controllers\SearchController $searchController,
    ) {
        $this->adminController = $adminController;
        $this->crudController = $crudController;
        $this->detailController = $detailController;
        $this->kachelController = $kachelController;
        $this->loginController = $loginController;
        $this->searchController = $searchController;
    }

    public function addRoute(string $path, Closure $handler): void
    {
        $this->routes[$path] = $handler;
    }

    public function receive(mysqli $connection): void
    {
        $base = "/buecherantiquariat";
        $path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
        $path = str_replace($base, "", $path);

        $this->dispatch($path, $connection);
    }

    public function dispatch(string $path, mysqli $connection): void
    {
        if (array_key_exists($path, $this->routes)) {
            call_user_func($this->routes[$path], $connection);
        } else {
            echo "Page not found.<br>";
            echo $path;
        }
    }

    public function configureRoutes(mysqli $outerConnection): void
    {
        $this->addRoute("/", function (mysqli $innerConnection) use (
            $outerConnection,
        ) {
            $this->kachelController->render(
                (int) ($_GET["page"] ?? 1),
                (int) \App\Models\CookieModel::getMaxPages($innerConnection),
                (string) ($_GET["sort"] ?? "title"),
                (string) ($_GET["dir"] ?? "asc"),
            );
        });
        $this->addRoute("/home", function (mysqli $innerConnection) use (
            $outerConnection,
        ) {
            $this->kachelController->render(
                (int) ($_GET["page"] ?? 1),
                (int) \App\Models\CookieModel::getMaxPages($innerConnection),
                (string) ($_GET["sort"] ?? "title"),
                (string) ($_GET["dir"] ?? "asc"),
            );
        });
        $this->addRoute("/detail", function () {
            $this->detailController->render(
                (int) ($_GET["id"] ?? 1),
                (string) ($_GET["sort"] ?? "title"),
                (string) ($_GET["dir"] ?? "asc"),
            );
        });
        $this->addRoute("/search", function () {
            $this->searchController->render(
                (string) ($_GET["search"] ?? ""),
                (string) ($_GET["sort"] ?? "title"),
                (string) ($_GET["dir"] ?? "asc"),
            );
        });
        $this->addRoute("/login", function () {
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $this->loginController->authenticate();
            } elseif ($_SERVER["REQUEST_METHOD"] === "GET") {
                $this->loginController->render();
            } else {
                echo "Problem";
            }
        });
        $this->addRoute("/admin", function () {
            if (empty($_SESSION["authenticated"])) {
                header("Location: " . BASE_URL . "/login");
                exit();
            }
            $this->adminController->render();
        });
        $this->addRoute("/crud", function () {
            if (empty($_SESSION["authenticated"])) {
                header("Location: " . BASE_URL . "/login");
                exit();
            }
            $this->crudController->render((int) ($_GET["id"] ?? 0));
        });
        $this->addRoute("/info", function () {
            \App\Views\PHPInfoView::render();
        });
    }
}
