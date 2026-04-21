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

    public function update(string $querry): void
    {
        $this->info = BookModel::searchBooks($this->conn, $querry);
    }

    public function render(string $querry, string $sort, string $dir): void
    {
        $this->update($querry);
        SearchView::render($this->info, $sort, $dir);
    }
}
