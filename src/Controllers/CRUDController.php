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
        $content = [];

        if ($id !== 0) {
            $content = \App\Models\BookModel::getBookById($this->connection, $id) ?? [];
        }

        \App\Views\CRUDView::render($content);
    }

    public function handlePost(array $postData): void
    {
        $id = (int) ($postData["id"] ?? 0);

        if (isset($postData["delete"]) && $id !== 0) {
            \App\Models\BookModel::deleteBook($this->connection, $id);
            header("Location: " . BASE_URL . "/admin/books");
            exit();
        }

        if ($id === 0) {
            \App\Models\BookModel::createBook($this->connection, $postData);
        } else {
            \App\Models\BookModel::updateBook($this->connection, $postData);
        }

        header("Location: " . BASE_URL . "/admin/books");
        exit();
    }
}
