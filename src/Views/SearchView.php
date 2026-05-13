<?php
declare(strict_types=1);

namespace App\Views;

class SearchView
{
    public static function render(
        array $contentArray,
        string $sort,
        string $dir,
        string $search = "",
    ): void {
        echo "<!DOCTYPE html>\n";
        echo "<html lang=\"de\">\n";
        echo "<head>\n";
        echo "<meta charset=\"UTF-8\">\n";
        echo '<link rel="stylesheet" href="' . BASE_URL . '/public/css/styles.css">' . "\n";
        echo "<title>Bücher Antiquariat</title>\n";
        echo "</head>\n";
        echo "<body>\n";

        \App\Components\HeaderComponent::render(
            \App\Datatypes\HeaderlocationEnum::SEARCH,
            "Search",
            $sort,
            $dir,
            $search,
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

        echo "</body></html>";
    }
}
