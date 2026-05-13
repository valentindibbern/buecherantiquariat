<?php
declare(strict_types=1);

namespace App\Controllers;

use mysqli;

class AdminController
{
    private mysqli $connection;

    public function __construct(mysqli $connection)
    {
        $this->connection = $connection;
    }

    public function render(): void
    {
        \App\Views\AdminView::render();
    }
}
