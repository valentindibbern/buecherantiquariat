<?php
declare(strict_types=1);

namespace App\Controllers;

use mysqli;

class CustomerAdminController
{
    private mysqli $connection;

    public function __construct(mysqli $connection)
    {
        $this->connection = $connection;
    }

    public function render(string $search, string $sort, string $dir): void
    {
        $customers = \App\Models\CustomerModel::getAllCustomers(
            $this->connection,
            $search,
            $sort,
            $dir,
        );

        \App\Views\CustomerAdminView::render($customers, $search, $sort, $dir);
    }
}
