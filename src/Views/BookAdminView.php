<?php
declare(strict_types=1);

namespace App\Views;

class BookAdminView
{
    public static function render(
        array $contentArray,
        string $search,
        string $sort,
        string $dir,
    ): void {
        $searchValue = htmlspecialchars($search, ENT_QUOTES);
        $sortValue = htmlspecialchars($sort, ENT_QUOTES);
        $dirValue = htmlspecialchars($dir, ENT_QUOTES);

        echo "<!DOCTYPE html>\n";
        echo "<html lang=\"de\">\n";
        echo "<head>\n";
        echo "<meta charset=\"UTF-8\">\n";
        echo '<link rel="stylesheet" href="' . BASE_URL . '/public/css/styles.css">' . "\n";
        echo "<title>Bücher Antiquariat</title>\n";
        echo "</head>\n";
        echo "<body>\n";

        \App\Components\HeaderComponent::render(
            \App\Datatypes\HeaderlocationEnum::ADMIN_BOOKS,
            "Bücher Admin",
            $sort,
            $dir,
            $search,
        );

        echo '<div class="table-container">';
        echo '<table>';
        echo '<thead><tr>';
        echo '<th>ID</th><th>Katalog</th><th>Nummer</th><th>Titel</th><th>Kategorie</th><th>Verkauft</th><th>Käufer</th><th>Autor</th><th>Beschreibung</th><th>Foto</th><th>Verfasser</th><th>Zustand</th>';
        echo '</tr></thead><tbody>';

        foreach ($contentArray as $book) {
            $id = (int) ($book["id"] ?? 0);
            $title = htmlspecialchars((string) ($book["Title"] ?? ""), ENT_QUOTES);
            $titleLabel = $title !== "" ? $title : "Ohne Titel";
            $autor = htmlspecialchars((string) ($book["autor"] ?? ""), ENT_QUOTES);
            $beschreibung = htmlspecialchars((string) ($book["Beschreibung"] ?? ""), ENT_QUOTES);
            $foto = htmlspecialchars((string) ($book["foto"] ?? ""), ENT_QUOTES);
            $zustand = self::zustandLabel((string) ($book["zustand"] ?? ""));
            $verkauft = self::verkauftLabel((int) ($book["verkauft"] ?? 0));
            $kategorie = htmlspecialchars((string) ($book["kategorie"] ?? ""), ENT_QUOTES);
            $katalog = htmlspecialchars((string) ($book["katalog"] ?? ""), ENT_QUOTES);
            $nummer = htmlspecialchars((string) ($book["nummer"] ?? ""), ENT_QUOTES);
            $kaufer = htmlspecialchars((string) ($book["kaufer"] ?? ""), ENT_QUOTES);
            $verfasser = htmlspecialchars((string) ($book["verfasser"] ?? ""), ENT_QUOTES);
            $link = BASE_URL . '/crud/book?id=' . $id . '&search=' . urlencode($search) . '&sort=' . urlencode($sort) . '&dir=' . urlencode($dir);

            echo '<tr>';
            echo '<td>' . $id . '</td>';
            echo '<td>' . $katalog . '</td>';
            echo '<td>' . $nummer . '</td>';
            echo '<td><a class="table-link" href="' . $link . '">' . $titleLabel . '</a></td>';
            echo '<td>' . $kategorie . '</td>';
            echo '<td>' . $verkauft . '</td>';
            echo '<td>' . $kaufer . '</td>';
            echo '<td>' . $autor . '</td>';
            echo '<td class="table-description-cell">' . $beschreibung . '</td>';
            echo '<td>' . $foto . '</td>';
            echo '<td>' . $verfasser . '</td>';
            echo '<td>' . $zustand . '</td>';
            echo '</tr>';
        }

        echo '</tbody></table></div></body></html>';
    }

    private static function verkauftLabel(int $value): string
    {
        return \App\Datatypes\VerkauftEnum::tryFrom($value)?->label() ?? "";
    }

    private static function zustandLabel(string $value): string
    {
        return \App\Datatypes\ZustandEnum::tryFrom($value)?->label() ?? "";
    }
}
