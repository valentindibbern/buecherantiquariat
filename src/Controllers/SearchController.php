<?php

namespace App\Controllers;

use mysqli;

class SearchController
{
    private mysqli $conn;
    private array $info;

    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->info = [];
    }

    public function update(string $querry): void
    {
        $this->info = \App\Models\BookModel::searchBooks($this->conn, $querry);
    }

    public function render(string $querry, string $sort, string $dir): void
    {
        $this->update($querry);
        \App\Views\SearchView::render($this->info, $sort, $dir);
    }
}
