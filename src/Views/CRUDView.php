<?php
declare(strict_types=1);

namespace App\Views;

class CRUDView
{
    public static function render(array $content, string $search = "", string $sort = "id", string $dir = "asc"): void
    {
        $id = htmlspecialchars((string) ($content["id"] ?? ""), ENT_QUOTES);
        $title = htmlspecialchars((string) ($content["Title"] ?? ""), ENT_QUOTES);
        $autor = htmlspecialchars((string) ($content["autor"] ?? ""), ENT_QUOTES);
        $beschreibung = htmlspecialchars((string) ($content["Beschreibung"] ?? ""), ENT_QUOTES);
        $katalog = htmlspecialchars((string) ($content["katalog"] ?? ""), ENT_QUOTES);
        $nummer = htmlspecialchars((string) ($content["nummer"] ?? ""), ENT_QUOTES);
        $kategorie = htmlspecialchars((string) ($content["kategorie"] ?? ""), ENT_QUOTES);
        $verkauft = htmlspecialchars((string) ($content["verkauft"] ?? ""), ENT_QUOTES);
        $kaufer = htmlspecialchars((string) ($content["kaufer"] ?? ""), ENT_QUOTES);
        $foto = htmlspecialchars((string) ($content["foto"] ?? ""), ENT_QUOTES);
        $verfasser = htmlspecialchars((string) ($content["verfasser"] ?? ""), ENT_QUOTES);
        $zustand = htmlspecialchars((string) ($content["zustand"] ?? ""), ENT_QUOTES);
        $headline = $id === "" ? "Neues Buch" : "Buch bearbeiten";
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
            \App\Datatypes\HeaderlocationEnum::CRUD_BOOK,
            "Buch CRUD",
            $sort,
            $dir,
            $search,
        );

        echo '<form method="post" action="' . BASE_URL . '/crud/book" class="crud-form">';
        echo '<h1>' . $headline . '</h1>';
        echo '<input type="hidden" name="id" value="' . $id . '">';
        echo '<input type="hidden" name="search" value="' . $searchValue . '">';
        echo '<input type="hidden" name="sort" value="' . $sortValue . '">';
        echo '<input type="hidden" name="dir" value="' . $dirValue . '">';

        if ($id !== "") {
            echo '<label for="id_view">Id</label><br><input type="text" id="id_view" value="' . $id . '" readonly><br>';
        }

        echo '<label for="title">Titel</label><br><input type="text" name="title" value="' . $title . '"><br>';
        echo '<label for="autor">Autor</label><br><input type="text" name="autor" value="' . $autor . '"><br>';
        echo '<label for="beschreibung">Beschreibung</label><br><textarea name="beschreibung" cols="30" rows="10">' . $beschreibung . '</textarea><br>';
        echo '<label for="katalog">Katalog</label><br><input type="text" name="katalog" value="' . $katalog . '"><br>';
        echo '<label for="nummer">Nummer</label><br><input type="text" name="nummer" value="' . $nummer . '"><br>';
        echo '<label for="kategorie">Kategorie</label><br><input type="text" name="kategorie" value="' . $kategorie . '"><br>';
        echo '<label for="verkauft">Verkauft</label><br><input type="text" name="verkauft" value="' . $verkauft . '"><br>';
        echo '<label for="kaufer">Kaufer</label><br><input type="text" name="kaufer" value="' . $kaufer . '"><br>';
        echo '<label for="foto">Foto</label><br><input type="text" name="foto" value="' . $foto . '"><br>';
        echo '<label for="verfasser">Verfasser</label><br><input type="text" name="verfasser" value="' . $verfasser . '"><br>';
        echo '<label for="zustand">Zustand</label><br><input type="text" name="zustand" value="' . $zustand . '"><br>';
        echo '<div class="crud-button-row"><input type="submit" value="Save">';

        if ($id !== "") {
            echo '<button type="submit" name="delete" value="1" onclick="return confirm(\'Eintrag wirklich löschen?\');">Delete</button>';
        }

        echo '</div></form></body></html>';
    }
}
