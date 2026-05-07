<?php
declare(strict_types=1);

namespace App\Views;

class CRUDView
{
    public static function render(array $content): void
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
            \App\Datatypes\HeaderlocationEnum::CRUD_BOOK,
            "Buch CRUD",
        );

        echo <<<HTML
        <form method="post" action="
        HTML;
        echo BASE_URL;
        echo <<<HTML
        /crud/book" class="crud-form">
            <h1>$headline</h1>
            <input type="hidden" name="id" value="$id">
        HTML;

        if ($id !== "") {
            echo <<<HTML
            <label for="id_view">Id</label>
            <br>
            <input type="text" id="id_view" value="$id" readonly>
            <br>
            HTML;
        }

        echo <<<HTML
            <label for="title">Title</label>
            <br>
            <input type="text" name="title" value="$title">
            <br>
            <label for="autor">Autor</label>
            <br>
            <input type="text" name="autor" value="$autor">
            <br>
            <label for="beschreibung">Beschreibung</label>
            <br>
            <textarea name="beschreibung" cols="30" rows="10">$beschreibung</textarea>
            <br>
            <label for="katalog">Katalog</label>
            <br>
            <input type="text" name="katalog" value="$katalog">
            <br>
            <label for="nummer">Nummer</label>
            <br>
            <input type="text" name="nummer" value="$nummer">
            <br>
            <label for="kategorie">Kategorie</label>
            <br>
            <input type="text" name="kategorie" value="$kategorie">
            <br>
            <label for="verkauft">Verkauft</label>
            <br>
            <input type="text" name="verkauft" value="$verkauft">
            <br>
            <label for="kaufer">Kaufer</label>
            <br>
            <input type="text" name="kaufer" value="$kaufer">
            <br>
            <label for="foto">Foto</label>
            <br>
            <input type="text" name="foto" value="$foto">
            <br>
            <label for="verfasser">Verfasser</label>
            <br>
            <input type="text" name="verfasser" value="$verfasser">
            <br>
            <label for="zustand">Zustand</label>
            <br>
            <input type="text" name="zustand" value="$zustand">
            <br>
            <div class="crud-button-row">
                <input type="submit" value="Save">
        HTML;

        if ($id !== "") {
            echo <<<HTML
                <button type="submit" name="delete" value="1" onclick="return confirm('Eintrag wirklich löschen?');">Delete</button>
            HTML;
        }

        echo <<<HTML
            </div>
        </form>
        </body>
        </html>
        HTML;
    }
}
