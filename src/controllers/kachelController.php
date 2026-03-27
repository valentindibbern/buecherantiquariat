<?php

class KachelController
{
    private $conn;
    private $info;

    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->info = [];
    }

    public function update()
    {
        $this->info = BookModel::getBooksByPage($this->conn, $_GET["page"]);
    }

    public function render()
    {
        $this->update();
        KachelView::render($this->info, $_GET["page"], $_GET["total_pages"]);
    }
}
