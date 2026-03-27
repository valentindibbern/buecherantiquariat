<?php

class SearchController
{
    private $conn;
    private $info;

    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->info = [];
    }

    public function update(int $querry): void
    {
        $this->info = BookModel::searchBooks($this->conn, $querry);
    }

    public function render(int $querry): void
    {
        $this->update($querry);
        KachelView::render($this->info);
    }
}
