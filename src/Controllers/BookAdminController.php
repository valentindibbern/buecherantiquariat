<?php
declare(strict_types=1);

namespace App\Controllers;

use mysqli;

class BookAdminController
{
    private mysqli $connection;

    public function __construct(mysqli $connection)
    {
        $this->connection = $connection;
    }

    public function render(string $search, string $sort, string $dir): void
    {
        $books = \App\Models\BookModel::getAdminBooks(
            $this->connection,
            $search,
            $sort,
            $dir,
        );

        \App\Views\BookAdminView::render($books, $search, $sort, $dir);
    }
}
