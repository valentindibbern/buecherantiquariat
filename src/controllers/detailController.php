<?php
declare(strict_types=1);

include "src/uicomponents/footer.php";
include "src/uicomponents/header.php";

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

    public function render() {}
}
