<?php

include "src/datatype/stateEnum.php";
include "src/dbconnection.php";
include "src/controller/routeController.php";
include "src/controller/kachelController.php";

class MainController
{
    private $db;
    private $conn;
    private State $state;
    private RouteController $routeController;

    public function __construct()
    {
        $this->state = State::UserKacheln;

        $this->db = new DBConnection();
        $this->conn = $this->db->connect();

        $this->kachelController = new KachelController($this->conn);
        $this->routeController = new RouteController();
        $this->routeController->addRoute("/", "");
    }

    public function update()
    {
        $this->$info = BookModel::searchBooks(
            $this->conn,
            1,
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            18,
        );
    }

    public function render($info)
    {
        switch ($this->state) {
            case State::UserKacheln:
                UserKachelView::render($info);
                break;
        }
    }
}
?>
