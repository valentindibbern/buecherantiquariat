<?php
declare(strict_types=1);

namespace App\Views;

class KachelView
{
    public static function render(
        array $contentArray,
        int $currentPage,
        int $maxPages,
        string $sort,
        string $dir,
    ): void
    {
        echo <<<EOT
            <!DOCTYPE html>
            <html lang="">
                <head>
                    <meta charset="UTF-8">
                    <link rel="stylesheet" href="css/styles.css">
                    <title>Bücher Antiquariat</title>
                </head>
                <body>
        EOT;

        \App\Components\HeaderComponent::render(\App\Datatypes\HeaderlocationEnum::HOME, "Home", $sort, $dir);

        echo '<div class="grid-container">';
        foreach ($contentArray as $item) {
            \App\Components\KachelComponent::render(
                $item["id"],
                $item["foto"],
                $item["Title"],
                $item["autor"],
                $item["zustand"],
            );
        }
        echo "</div>";

        \App\Components\PaginatorComponent::render($currentPage, $maxPages, $sort, $dir);

        \App\Components\FooterComponent::render();

        echo <<<EOT
                </body>
            </html>
        EOT;
    }
}