<?php
declare(strict_types=1);

namespace App\Views;

class CRUDView
{
    public static function render(array $content): void
    {
        $id = $content["id"] ?? "";
        $title = $content["Title"] ?? "";
        $autor = $content["autor"] ?? "";
        $beschreibung = $content["Beschreibung"] ?? "";
        $katalog = $content["katalog"] ?? "";
        $nummer = $content["nummer"] ?? "";
        $kategorie = $content["kategorie"] ?? "";
        $verkauft = $content["verkauft"] ?? "";
        $kaufer = $content["kaufer"] ?? "";
        $foto = $content["foto"] ?? "";
        $verfasser = $content["verfasser"] ?? "";
        $zustand = $content["zustand"] ?? "";

        $html = <<<HTML
        <html lang="de">
            <head>
                <meta charset="UTF-8">
                <link rel="stylesheet" href="css/styles.css">
                <title>Bücher Antiquariat</title>
            </head>
            <body>
        HTML;

        \App\Components\HeaderComponent::render(\App\Datatypes\HeaderlocationEnum::ADMIN, "Admin");

        $html .= <<<HTML
        <form>
            <h1>Update</h1>
            <label for="id">Id</label>
            <br>
            <input type="text" name="id" value="{$content["id"]}">
            <br>
            <label for="title">Title</label>
            <br>
            <input type="text" name="title" value="{$content["Title"]}">
            <br>
            <label for="autor">Autor</label>
            <br>
            <input type="text" name="autor" value="{$content["autor"]}">
            <br>
            <label for="beschreibung">Beschreibung</label>
            <br>
            <textarea name="beschreibung" cols="30" rows="10">{$content["Beschreibung"]}</textarea>
            <br>
            <label for="katalog">Katalog</label>
            <br>
            <input type="text" name="katalog" value="{$content["katalog"]}">
            <br>
            <label for="nummer">Nummer</label>
            <br>
            <input type="text" name="nummer" value="{$content["nummer"]}">
            <br>
            <label for="kategorie">Kategorie</label>
            <br>
            <input type="text" name="kategorie" value="{$content["kategorie"]}">
            <br>
            <label for="verkauft">Verkauft</label>
            <br>
            <input type="text" name="verkauft" value="{$content["verkauft"]}">
            <br>
            <label for="kaufer">Kaufer</label>
            <br>
            <input type="text" name="kaufer" value="{$content["kaufer"]}">
            <br>
            <label for="foto">Foto</label>
            <br>
            <input type="text" name="foto" value="{$content["foto"]}">
            <br>
            <label for="verfasser">Verfasser</label>
            <br>
            <input type="text" name="verfasser" value="{$content["verfasser"]}">
            <br>
            <label for="zustand">Zustand</label>
            <br>
            <input type="text" name="zustand" value="{$content["zustand"]}">
            <br>
            <input type="submit" value="Save">
        </form>
        HTML;

        echo $html;
    }
}