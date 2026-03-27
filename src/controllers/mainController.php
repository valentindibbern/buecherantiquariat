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
            $this->kachelController->render((int) ($_GET["page"] ?? 1));
        });
        $this->routeController->addRoute("/home", function () {
            $this->kachelController->render((int) ($_GET["page"] ?? 1));
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
