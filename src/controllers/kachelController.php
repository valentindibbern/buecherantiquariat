<?php

class KachelController
{
    private $conn;
    private $info;
    private $page;
    private $total_pages;

    public function __construct($conn, ?int $page = 1)
    {
        $this->conn = $conn;
        $this->info = [];
        $this->page = $page;
    }

    public function update()
    {
        $this->info = BookModel::getBooksByPage($this->conn, $this->page);
    }

    public function render()
    {
        $this->update();
        KachelView::render($this->info, $this->page);
    }
}
