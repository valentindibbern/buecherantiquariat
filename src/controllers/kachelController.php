<?php

include "src/views/userKachelView.php";
include "src/models/bookModel.php";

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
        echo <<<EOT
            <!DOCTYPE html>
            <html>
                <head>
                    <meta charset="UTF-8">
                    <link rel="stylesheet" href="styles.css">
                    <title>Bücher Antiquariat</title>
                </head>
                <body>
        EOT;
        UserKachelView::render($this->info);
        echo <<<EOT
                </body>
            </html>
        EOT;
    }
}
