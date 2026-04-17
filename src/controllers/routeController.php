<?php
declare(strict_types=1);

class RouteController
{
    private array $routes = [];
    private DetailController $detailController;
    private KachelController $kachelController;
    private SearchController $searchController;

    public function __construct(
        DetailController $detailController,
        KachelController $kachelController,
        SearchController $searchController,
    ) {
        $this->detailController = $detailController;
        $this->kachelController = $kachelController;
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
                (int) CookieModel::getMaxPages($innerConnection),
                (string) ($_GET["sort"] ?? "titel"),
                (string) ($_GET["dir"] ?? "asc"),
            );
        });
        $this->addRoute("/home", function (mysqli $innerConnection) use (
            $outerConnection,
        ) {
            $this->kachelController->render(
                (int) ($_GET["page"] ?? 1),
                (int) CookieModel::getMaxPages($innerConnection),
                (string) ($_GET["sort"] ?? "titel"),
                (string) ($_GET["dir"] ?? "asc"),
            );
        });
        $this->addRoute("/detail", function () {
            $this->detailController->render((int) ($_GET["id"] ?? 1));
        });
        $this->addRoute("/search", function () {
            $this->searchController->render((string) ($_GET["search"] ?? ""));
        });
    }
}
