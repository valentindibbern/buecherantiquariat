<?php
declare(strict_types=1);

class DetailController
{
    private $conn;
    private $info;

    public function __construct($conn)
    {
        $this->conn = $conn;
        $this->info = [];
    }

    public function getInfo() {}

    public function render()
    {
        echo "hallo";
    }
}
