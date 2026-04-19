<?php
declare(strict_types=1);

class RouteController
{
    private array $routes = [];
    private DetailController $detailController;
    private KachelController $kachelController;
    private SearchController $searchController;
    private LoginController $loginController;
    private AdminController $adminController;

    public function __construct(
        DetailController $detailController,
        KachelController $kachelController,
        SearchController $searchController,
        LoginController $loginController,
        AdminController $adminController,
    ) {
        $this->detailController = $detailController;
        $this->kachelController = $kachelController;
        $this->searchController = $searchController;
        $this->loginController = $loginController;
        $this->adminController = $adminController;
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
                (int) CookieModel::getMaxPages($innerConnection),
                (string) ($_GET["sort"] ?? "title"),
                (string) ($_GET["dir"] ?? "asc"),
            );
        });
        $this->addRoute("/home", function (mysqli $innerConnection) use (
            $outerConnection,
        ) {
            $this->kachelController->render(
                (int) ($_GET["page"] ?? 1),
                (int) CookieModel::getMaxPages($innerConnection),
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
            $this->searchController->render((string) ($_GET["search"] ?? ""));
        });
        $this->addRoute("/login", function () {
            $this->loginController->render();
        });
        $this->addRoute("/admin", function () {
            $this->adminController->render();
        });
    }
}
