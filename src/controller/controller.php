<?php

include "src/datatype/stateEnum.php";
include "src/dbconnection.php";
include "src/model/readBooks.php";
include "src/views/userBookList.php";

class Controller
{
    private $db;
    private $conn;
    private State $state;

    public function __construct()
    {
        $this->db = new DBConnection();
        $this->state = State::UserKacheln;
    }

    public function connect()
    {
        $this->conn = $this->db->connect();
    }

    public function setState(State $state)
    {
        $this->state = $state;
    }

    public function getState(): State
    {
        return $this->state;
    }

    public function render() {}
}
?>
