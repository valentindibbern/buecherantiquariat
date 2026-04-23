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

    public function update(int $page, string $sort, string $dir): void
    {
        $this->info = BookModel::getBooksByPage(
            $this->connection,
            $page,
            $sort,
            $dir,
        );
    }

    public function prepareInfo(): void
    {
        foreach ($this->info as &$book) {
            $book["verkauft"] =
                VerkauftEnum::from($book["verkauft"])->label() ??
                "Verkaufstatus nicht verfügbar";
            $book["zustand"] =
                ZustandEnum::from($book["zustand"])->label() ??
                "Zustand nicht verfügbar";
        }
    }

    public function render(
        int $page,
        int $maxPages,
        string $sort,
        string $dir,
    ): void {
        $this->update($page, $sort, $dir);
        KachelView::render($this->info, $page, $maxPages, $sort, $dir);
    }
}
