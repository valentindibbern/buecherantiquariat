<?php

class KachelView
{
    public static function render(
        array $contentArray,
        int $currentPage,
        string $sort,
        string $dir,
    ) {
        $sortValue = $sort . "_" . $dir;

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

        HeaderComponent::render("Home", $sortValue);

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

        PaginatorComponent::render(
            $currentPage,
            (int) $_COOKIE["totalPages"],
            $sort,
            $dir,
        );

        FooterComponent::render();

        echo <<<EOT
                </body>
            </html>
        EOT;
    }
}
?>
