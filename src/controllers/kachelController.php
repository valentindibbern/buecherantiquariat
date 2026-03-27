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

    public function update(int $page): void
    {
        $this->info = BookModel::getBooksByPage($this->conn, $page);
    }

    public function render(int $page): void
    {
        $this->update($page);
        KachelView::render($this->info, $page);
    }
}
