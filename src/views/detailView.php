<?php
declare(strict_types=1);

namespace App\Views;

class DetailView
{
    public static function render(array $book, string $sort, string $dir): void
    {
        $titel = $book["Title"] ?? "Titel nicht verfügbar";
        $image = $book["foto"] ?? "Bild nicht verfügbar";
        $description = $book["Beschreibung"] ?? "Beschreibung nicht verfügbar";
        $author = $book["autor"] ?? "Autor nicht verfügbar";
        $zustand =
            \App\Datatypes\ZustandEnum::from($book["zustand"])->label() ??
            "Zustand nicht verfügbar";
        $verkauft =
            \App\Datatypes\VerkauftEnum::from($book["verkauft"])->label() ??
            "Verkaufstatus nicht verfügbar";
        $katalog = $book["katalog"] ?? "Katalog nicht verfügbar";
        $nummer = $book["nummer"] ?? "Nummer nicht verfügbar";
        $kategorie = $book["kategorie"] ?? "Kategorie nicht verfügbar";

        echo "<!DOCTYPE html>\n";
        echo "<html lang=\"de\">\n";
        echo "<head>\n";
        echo "<meta charset=\"UTF-8\">\n";
        echo '<link rel="stylesheet" href="' . BASE_URL . '/public/css/styles.css">' . "\n";
        echo "<title>Bücher Antiquariat</title>\n";
        echo "</head>\n";
        echo "<body>\n";

        \App\Components\HeaderComponent::render(
            \App\Datatypes\HeaderlocationEnum::DETAIL,
            $titel,
            $sort,
            $dir,
        );

        echo '<div class="detail-container">';
        echo '<img src="' . $image . '" class="detail-image" alt="Image of Book">';
        echo '<p class="detail-description">' . $description . '</p>';
        echo '<ul class="detail-list">';
        echo '<li class="detail-autor">Autor: ' . $author . '</li>';
        echo '<li class="detail-zustand">Zustand: ' . $zustand . '</li>';
        echo '<li class="detail-verkauft">Verkauft: ' . $verkauft . '</li>';
        echo '<li class="detail-katalog">Katalog: ' . $katalog . '</li>';
        echo '<li class="detail-nummer">Nummer: ' . $nummer . '</li>';
        echo '<li class="detail-kategorie">Kategorie: ' . $kategorie . '</li>';
        echo '</ul></div>';

        \App\Components\FooterComponent::render();

        echo "</body></html>";
    }
}
