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
        $searchQueryValue = urlencode($search);

        echo <<<EOT
        <!DOCTYPE html>
        <html lang="de">
            <head>
                <meta charset="UTF-8">
                <link rel="stylesheet" href="css/styles.css">
                <title>Bücher Antiquariat</title>
            </head>
            <body>
        EOT;

        \App\Components\HeaderComponent::render(
            \App\Datatypes\HeaderlocationEnum::ADMIN_BOOKS,
            "Bücher Admin",
        );

        echo <<<HTML
        <div class="table-toolbar">
            <h2>Bücher</h2>
            <form method="get" action="admin/books" class="admin-search-form">
                <input type="hidden" name="sort" value="$sort">
                <input type="hidden" name="dir" value="$dir">
                <input type="search" name="search" value="$searchValue" placeholder="Bücher suchen">
                <button type="submit">Suchen</button>
            </form>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th><a href="admin/books?search={$searchQueryValue}&sort=id&dir=
        HTML;
        echo self::nextDirection($sort, $dir, "id");
        echo <<<HTML
        ">ID</a></th>
                        <th><a href="admin/books?search={$searchQueryValue}&sort=katalog&dir=
        HTML;
        echo self::nextDirection($sort, $dir, "katalog");
        echo <<<HTML
        ">Katalog</a></th>
                        <th><a href="admin/books?search={$searchQueryValue}&sort=nummer&dir=
        HTML;
        echo self::nextDirection($sort, $dir, "nummer");
        echo <<<HTML
        ">Nummer</a></th>
                        <th><a href="admin/books?search={$searchQueryValue}&sort=Title&dir=
        HTML;
        echo self::nextDirection($sort, $dir, "Title");
        echo <<<HTML
        ">Title</a></th>
                        <th>Kategorie</th>
                        <th>Verkauft</th>
                        <th>Käufer</th>
                        <th><a href="admin/books?search={$searchQueryValue}&sort=autor&dir=
        HTML;
        echo self::nextDirection($sort, $dir, "autor");
        echo <<<HTML
        ">Autor</a></th>
                        <th>Beschreibung</th>
                        <th>Foto</th>
                        <th>Verfasser</th>
                        <th><a href="admin/books?search={$searchQueryValue}&sort=zustand&dir=
        HTML;
        echo self::nextDirection($sort, $dir, "zustand");
        echo <<<HTML
        ">Zustand</a></th>
                        <th>Aktion</th>
                    </tr>
                </thead>
                <tbody>
        HTML;

        foreach ($contentArray as $book) {
            $id = (int) ($book["id"] ?? 0);
            $title = htmlspecialchars((string) ($book["Title"] ?? ""), ENT_QUOTES);
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

            echo <<<HTML
                <tr>
                    <td>$id</td>
                    <td>$katalog</td>
                    <td>$nummer</td>
                    <td>$title</td>
                    <td>$kategorie</td>
                    <td>$verkauft</td>
                    <td>$kaufer</td>
                    <td>$autor</td>
                    <td class="table-description-cell">$beschreibung</td>
                    <td>$foto</td>
                    <td>$verfasser</td>
                    <td>$zustand</td>
                    <td><a href="crud/book?id=$id">Bearbeiten</a></td>
                </tr>
            HTML;
        }

        echo <<<HTML
                </tbody>
            </table>
        </div>
        </body>
        </html>
        HTML;
    }

    private static function nextDirection(
        string $currentSort,
        string $currentDir,
        string $column,
    ): string {
        if ($currentSort === $column && strtolower($currentDir) === "asc") {
            return "desc";
        }

        return "asc";
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
