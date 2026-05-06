<?php
declare(strict_types=1);

namespace App\Controllers;

use mysqli;

class CRUDController
{
    private mysqli $connection;

    public function __construct(mysqli $connection)
    {
        $this->connection = $connection;
    }

    public function render(int $id): void
    {
        if ($id === 0) {
            \App\Views\CRUDView::render([]);
        }

        $content = \App\Models\BookModel::getBookById($this->connection, $id);
        \App\Views\CRUDView::render($content);
    }
}