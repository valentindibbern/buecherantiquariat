<?php

class KachelView
{
    public static function render(
        array $contentArray,
        int $currentPage,
        int $maxPages,
        string $sort,
        string $dir,
    ) {
        echo <<<EOT
            <!DOCTYPE html>
            <html>
                <head>
                    <meta charset="UTF-8">
                    <link rel="stylesheet" href="styles.css">
                    <title>Bücher Antiquariat</title>
                </head>
                <body>
        EOT;

        HeaderComponent::render("Home", $sort, $dir, HeaderlocationEnum::HOME);

        echo '<div class="grid-container">';
        foreach ($contentArray as $item) {
            KachelComponent::render(
                $item["id"],
                $item["foto"],
                $item["Title"],
                $item["autor"],
                $item["zustand"],
            );
        }
        echo "</div>";

        PaginatorComponent::render($currentPage, $maxPages, $sort, $dir);

        FooterComponent::render();

        echo <<<EOT
                </body>
            </html>
        EOT;
    }
}
?>
