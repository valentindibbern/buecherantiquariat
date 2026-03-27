<?php

class KachelView
{
    public static function render($contentArray, $currentPage, $totalPages)
    {
        $cols = 6;
        $rows = 3;

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

        HeaderComponent::render("Home");

        echo '<div class="grid-container">';
        $count = 0;
        foreach ($contentArray as $item) {
            KachelComponent::render(
                $item["id"],
                $item["foto"],
                $item["Title"],
                $item["autor"],
                $item["zustand"],
            );
            $count++;
            if ($count == $cols * $rows) {
                break;
            }
        }
        echo "</div>";
        echo "<div class='page-buttons'>";
        echo "";
        echo "</div>";

        FooterComponent::render();

        echo <<<EOT
                </body>
            </html>
        EOT;
    }
}

?>
