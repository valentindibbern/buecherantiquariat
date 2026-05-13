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

    public function render(int $id, string $search = "", string $sort = "id", string $dir = "asc"): void
    {
        $content = [];

        if ($id !== 0) {
            $content = \App\Models\BookModel::getBookById($this->connection, $id) ?? [];
        }

        \App\Views\CRUDView::render($content, $search, $sort, $dir);
    }

    public function handlePost(array $postData): void
    {
        $id = (int) ($postData["id"] ?? 0);
        $search = urlencode((string) ($postData["search"] ?? ""));
        $sort = urlencode((string) ($postData["sort"] ?? "id"));
        $dir = urlencode((string) ($postData["dir"] ?? "asc"));
        $redirectUrl = BASE_URL . "/admin/books?search=$search&sort=$sort&dir=$dir";

        if (isset($postData["delete"]) && $id !== 0) {
            \App\Models\BookModel::deleteBook($this->connection, $id);
            header("Location: " . $redirectUrl);
            exit();
        }

        if ($id === 0) {
            \App\Models\BookModel::createBook($this->connection, $postData);
        } else {
            \App\Models\BookModel::updateBook($this->connection, $postData);
        }

        header("Location: " . $redirectUrl);
        exit();
    }
}
