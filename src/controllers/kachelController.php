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

    public function update()
    {
        $this->info = BookModel::searchBooks(
            $this->conn,
            1,
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            18,
        );
    }

    public function render()
    {
        $this->update();
        KachelView::render($this->info);
    }
}
