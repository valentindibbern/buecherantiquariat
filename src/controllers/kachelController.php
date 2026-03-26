<?php

include "src/views/userKachelView.php";
include "src/models/bookModel.php";

class KachelController
{
    private $conn;
    private $info;

    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    public function render() {}

    public function update()
    {
        $info = BookModel::searchBooks(
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
}
