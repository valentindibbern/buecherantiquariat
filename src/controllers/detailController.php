<?php
declare(strict_types=1);

class DetailController
{
    private $conn;
    private $info;

    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->info = [];
    }

    public function getBook(int $id = 1): void
    {
        $this->info = BookModel::getBookById($this->conn, $id);
    }

    public function render(int $id): void
    {
        $this->getBook($id);
        DetailView::render($this->info);
    }
}
