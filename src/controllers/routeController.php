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
            echo "Page not found.<br>";
            echo $path;
        }
    }

    public function configureRoutes(): void
    {
        $this->addRoute("/", function () {
            $this->kachelController->render(
                (int) ($_GET["page"] ?? 1),
                $_GET["sort"] ?? SortEnum::TA,
            );
        });
        $this->addRoute("/home", function () {
            $this->kachelController->render(
                (int) ($_GET["page"] ?? 1),
                $_GET["sort"] ?? SortEnum::TA,
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
