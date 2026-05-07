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
                <link rel="stylesheet" href="
        EOT;

        echo BASE_URL . '/css/styles.css';

        echo <<<EOT
        ">
                <title>Bücher Antiquariat</title>
            </head>
            <body>
        EOT;

        \App\Components\HeaderComponent::render(\App\Datatypes\HeaderlocationEnum::ADMIN, "Admin");

        $html = <<<HTML
        <div class="admin-selection-container">
            <h2>Admin Auswahl</h2>
            <ul class="admin-selection-list">
                <li><a href="
        HTML;

        $html .= BASE_URL . '/admin/books';

        $html .= <<<HTML
        ">Bücher verwalten</a></li>
                <li><a href="
        HTML;

        $html .= BASE_URL . '/admin/customers';

        $html .= <<<HTML
        ">Kunden verwalten</a></li>
                <li><a href="
        HTML;

        $html .= BASE_URL . '/admin/info';

        $html .= <<<HTML
        ">PHP Info</a></li>
            </ul>
        </div>
        </body>
        </html>
        HTML;

        echo $html;
    }
}
