<?php
declare(strict_types=1);

include "src/dbconnection.php";
include "src/controllers/routeController.php";
include "src/controllers/kachelController.php";
include "src/controllers/detailController.php";

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
            $this->kachelController->render();
        });
        $this->routeController->addRoute("/detail", function () {
            $this->detailController->render();
        });

        $this->routeController->receive();
    }
}
?>
