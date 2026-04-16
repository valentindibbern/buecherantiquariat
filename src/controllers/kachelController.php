<?php

class KachelController
{
    private $connection;
    private $info;

    public function __construct($connection)
    {
        $this->connection = $connection;
        $this->info = [];
    }

    public function update(int $page, SortEnum $sort): void
    {
        $this->info = BookModel::getBooksByPage(
            $this->connection,
            $page,
            $sort,
        );
    }

    public function render(int $page, SortEnum $sort): void
    {
        $this->update($page, $sort);
        KachelView::render($this->info, $page, $sort);
    }
}
