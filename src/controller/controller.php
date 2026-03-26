<?php

include "src/datatype/stateEnum.php";
include "src/dbconnection.php";
include "src/models/bookModel.php";
include "src/views/userKachelView.php";

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

    public function update()
    {
        $books = BookModel::searchBooks(
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
        $this->render($books);
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
