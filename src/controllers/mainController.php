<?php
declare(strict_types=1);

class MainController
{
    private $db;
    private $conn;
    private RouteController $routeController;
    private KachelController $kachelController;
    private DetailController $detailController;

    public function __construct()
    {
        $this->db = new DBConnection();
        $this->conn = $this->db->connect();
        $altconn = $this->conn;

        $this->routeController = new RouteController();
        $this->kachelController = new KachelController($this->conn);
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

        setcookie("totalPages", (string) BookModel::getTotalPages($this->conn));

        $this->routeController->receive();
    }
}
?>
