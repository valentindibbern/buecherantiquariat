<?php
declare(strict_types=1);

namespace App\Views;

class AdminView
{
    public static function render(): void
    {
        echo <<<EOT
        <!DOCTYPE html>
        <html lang="de">
            <head>
                <meta charset="UTF-8">
                <link rel="stylesheet" href="css/styles.css">
                <title>Bücher Antiquariat</title>
            </head>
            <body>
        EOT;

        \App\Components\HeaderComponent::render(\App\Datatypes\HeaderlocationEnum::ADMIN, "Admin");

        $html = <<<HTML
        <div class="admin-selection-container">
            <h2>Admin Auswahl</h2>
            <ul class="admin-selection-list">
                <li><a href="admin/books">Bücher verwalten</a></li>
                <li><a href="admin/customers">Kunden verwalten</a></li>
                <li><a href="admin/info">PHP Info</a></li>
            </ul>
        </div>
        </body>
        </html>
        HTML;

        echo $html;
    }
}
