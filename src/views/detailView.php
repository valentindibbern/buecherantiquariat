<?php
class DetailView
{
    public static function render(array $book, string $sort, string $dir)
    {
        $titel = $book["Title"] ?? "Titel nicht verfügbar";
        $image = $book["foto"] ?? "Bild nicht verfügbar";
        $description = $book["Beschreibung"] ?? "Beschreibung nicht verfügbar";
        $author = $book["autor"] ?? "Autor nicht verfügbar";
        $zustand =
            ZustandEnum::from($book["zustand"])->label() ??
            "Zustand nicht verfügbar";
        $verkauft =
            VerkauftEnum::from($book["verkauft"])->label() ??
            "Verkaufstatus nicht verfügbar";
        $katalog = $book["katalog"] ?? "Katalog nicht verfügbar";
        $nummer = $book["nummer"] ?? "Nummer nicht verfügbar";
        $kategorie = $book["kategorie"] ?? "Kategorie nicht verfügbar";

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

        HeaderComponent::render($titel, $sort, $dir);

        echo <<<EOT
            <div class="detail-container">
                <img src="$image" class="detail-image">
                <p class="detail-description">$description</p>
                <ul class="detail-list">
                    <li class="detail-autor">Autor: $author</li>
                    <li class="detail-zustand">Zustand: $zustand</li>
                    <li class="detail-verkauft">Verkauft: $verkauft</li>
                    <li class="detail-katalog">Katalog: $katalog</li>
                    <li class="detail-nummer">Nummer: $nummer</li>
                    <li class="detail-kategorie">Kategorie: $kategorie</li>
                </ul>
            </div>
        EOT;

        FooterComponent::render();

        echo <<<EOT
                </body>
            </html>
        EOT;
    }
}
