<?php
declare(strict_types=1);

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
            CRUDView::render([]);
        }

        $content = BookModel::getBookById($this->connection, $id);
        CRUDView::render($content);
    }
}

?>
