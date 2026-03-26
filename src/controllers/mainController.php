<?php

include "src/datatype/stateEnum.php";
include "src/dbconnection.php";
include "src/controllers/routeController.php";
include "src/controllers/kachelController.php";

class MainController
{
    private $db;
    private $conn;
    private State $state;
    // private RouteController $routeController;

    public function __construct()
    {
        $this->state = State::UserKacheln;

        $this->db = new DBConnection();
        $this->conn = $this->db->connect();
        $altconn = $this->conn;

        $this->kachelController = new KachelController($this->conn);
        // $this->routeController = new RouteController();
        // $this->routeController->addRoute("/", function () {
        //     require "src/controllers/kachelController.php";
        //     new KachelController($this->conn)->render();
        // });
    }

    public function render()
    {
        switch ($this->state) {
            case State::UserKacheln:
                $this->kachelController->update();
                $this->kachelController->render();
                break;
        }
    }
}
?>
