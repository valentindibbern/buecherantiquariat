<?php
declare(strict_types=1);

namespace App\Views;

class AdminView
{
    public static function render(array $contentArray): void
    {
        echo <<<EOT
        <!DOCTYPE html>
        <html lang="de">
            <head>
                <meta charset="UTF-8">
                <link rel="stylesheet" href="styles.css">
                <title>Bücher Antiquariat</title>
            </head>
            <body>
        EOT;

        \App\Components\HeaderComponent::render(\App\Datatypes\HeaderlocationEnum::ADMIN, "Admin");

        $html = <<<HTML
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Katalog</th>
                        <th>Nummer</th>
                        <th>Title</th>
                        <th>Kategorie</th>
                        <th>Verkauft</th>
                        <th>Käufer</th>
                        <th>Author</th>
                        <th>Beschreibung</th>
                        <th>Foto</th>
                        <th>Verfasser</th>
                        <th>Zustand</th>
                    </tr>
                </thead>
                <tbody>
        HTML;

        foreach ($contentArray as $book) {
            $html .= <<<HTML
                <tr>
                    <td>{$book["id"]}</td>
                    <td>{$book["katalog"]}</td>
                    <td>{$book["nummer"]}</td>
                    <td>{$book["Title"]}</td>
                    <td>{$book["kategorie"]}</td>
                    <td>{$book["verkauft"]}</td>
                    <td>{$book["kaufer"]}</td>
                    <td>{$book["autor"]}</td>
                    <td>{$book["Beschreibung"]}</td>
                    <td>{$book["foto"]}</td>
                    <td>{$book["verfasser"]}</td>
                    <td>{$book["zustand"]}</td>
                </tr>
            HTML;
        }

        $html .= <<<HTML
                    </tbody>
                </table>
            </div>
            </body>
        </html>
        HTML;

        echo $html;
    }
}