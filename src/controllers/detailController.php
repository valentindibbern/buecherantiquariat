<?php
declare(strict_types=1);

namespace App\Controllers;
use mysqli;

class DetailController
{
    private mysqli $conn;
    private array $info;

    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->info = [];
    }

    public function getBook(int $id): void
    {
        $this->info = \App\Models\BookModel::getBookById($this->conn, $id);
    }

    public function render(int $id, string $sort, string $dir): void
    {
        $this->getBook($id);
        \App\Views\DetailView::render($this->info, $sort, $dir);
    }
}
