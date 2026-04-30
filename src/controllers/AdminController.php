<?php
declare(strict_types=1);

class AdminController
{
    private mysqli $connection;

    public function __construct(mysqli $connection)
    {
        $this->connection = $connection;
    }

    public function render(): void
    {
        $books = BookModel::getAllBooks($this->connection);
        AdminView::render($books);
    }
}

?>
