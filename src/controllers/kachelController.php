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

    public function update(int $page, string $sort, string $dir): void
    {
        $this->info = BookModel::getBooksByPage(
            $this->conn,
            $page,
            $sort,
            $dir,
        );
    }

    public function render(int $page, string $sort, string $dir): void
    {
        $this->update($page, $sort, $dir);
        KachelView::render($this->info, $page, $sort, $dir);
    }
}
