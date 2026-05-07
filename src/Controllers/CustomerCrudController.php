<?php
declare(strict_types=1);

namespace App\Controllers;

use mysqli;

class CustomerCrudController
{
    private mysqli $connection;

    public function __construct(mysqli $connection)
    {
        $this->connection = $connection;
    }

    public function render(int $kid): void
    {
        $content = [];

        if ($kid !== 0) {
            $content = \App\Models\CustomerModel::getCustomerById($this->connection, $kid) ?? [];
        }

        \App\Views\CustomerCRUDView::render($content);
    }

    public function handlePost(array $postData): void
    {
        $kid = (int) ($postData["kid"] ?? 0);

        if (isset($postData["delete"]) && $kid !== 0) {
            \App\Models\CustomerModel::deleteCustomer($this->connection, $kid);
            header("Location: " . BASE_URL . "/admin/customers");
            exit();
        }

        $existingCustomer = \App\Models\CustomerModel::getCustomerById(
            $this->connection,
            $kid,
        );

        if ($existingCustomer === null) {
            \App\Models\CustomerModel::createCustomer($this->connection, $postData);
        } else {
            \App\Models\CustomerModel::updateCustomer($this->connection, $postData);
        }

        header("Location: " . BASE_URL . "/admin/customers");
        exit();
    }
}
