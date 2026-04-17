<?php

class SearchView
{
    public static function render(array $contentArray): void
    {
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

        HeaderComponent::render("Search");

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

        FooterComponent::render();

        echo <<<EOT
                </body>
            </html>
        EOT;
    }
}
?>
