<?php
declare(strict_types=1);

namespace App\Views;

class SearchView
{
    public static function render(
        array $contentArray,
        string $sort,
        string $dir,
    ): void {
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

        \App\Components\HeaderComponent::render(
            \App\Datatypes\HeaderlocationEnum::SEARCH,
            "Search",
            $sort,
            $dir,
        );

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

        \App\Components\FooterComponent::render();

        echo <<<EOT
                </body>
            </html>
        EOT;
    }
}
