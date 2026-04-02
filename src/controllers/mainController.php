<?php
declare(strict_types=1);

class MainController
{
    private $db;
    private $conn;
    private RouteController $routeController;
    private KachelController $kachelController;
    private SearchController $searchController;
    private DetailController $detailController;

    private function getHomeSortState(): array
    {
        $sortOption = (string) ($_GET["sort_option"] ?? "");
        $allowedSorts = [
            "title" => true,
            "autor" => true,
            "zustand" => true,
        ];
        $allowedDirections = [
            "asc" => true,
            "desc" => true,
        ];

        if ($sortOption !== "") {
            $parts = explode("_", $sortOption);

            if (
                count($parts) === 2 &&
                array_key_exists($parts[0], $allowedSorts) &&
                array_key_exists($parts[1], $allowedDirections)
            ) {
                return [$parts[0], $parts[1]];
            }
        }

        $sort = (string) ($_GET["sort"] ?? "title");
        $dir = (string) ($_GET["dir"] ?? "asc");

        if (!array_key_exists($sort, $allowedSorts)) {
            $sort = "title";
        }

        if (!array_key_exists($dir, $allowedDirections)) {
            $dir = "asc";
        }

        return [$sort, $dir];
    }

    public function __construct()
    {
        $this->db = new DBConnection();
        $this->conn = $this->db->connect();
        $altconn = $this->conn;

        $this->routeController = new RouteController();
        $this->kachelController = new KachelController($this->conn);
        $this->searchController = new SearchController($this->conn);
        $this->detailController = new DetailController($this->conn);

        $this->routeController->addRoute("/", function () {
            [$sort, $dir] = $this->getHomeSortState();
            $this->kachelController->render(
                (int) ($_GET["page"] ?? 1),
                $sort,
                $dir,
            );
        });
        $this->routeController->addRoute("/home", function () {
            [$sort, $dir] = $this->getHomeSortState();
            $this->kachelController->render(
                (int) ($_GET["page"] ?? 1),
                $sort,
                $dir,
            );
        });
        $this->routeController->addRoute("/detail", function () {
            $this->detailController->render((int) ($_GET["id"] ?? 1));
        });
        $this->routeController->addRoute("/search", function () {
            $this->searchController->render((string) ($_GET["search"] ?? ""));
        });

        setcookie("totalPages", (string) BookModel::getTotalPages($this->conn));

        $this->routeController->receive();
    }
}
?>
