<?php
declare(strict_types=1);

namespace App\Views;

class CustomerAdminView
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
            \App\Datatypes\HeaderlocationEnum::ADMIN_CUSTOMERS,
            "Kunden Admin",
        );

        echo <<<HTML
        <div class="table-toolbar">
            <h2>Kunden</h2>
            <form method="get" action="admin/customers" class="admin-search-form">
                <input type="hidden" name="sort" value="$sort">
                <input type="hidden" name="dir" value="$dir">
                <input type="search" name="search" value="$searchValue" placeholder="Kunden suchen">
                <button type="submit">Suchen</button>
            </form>
        </div>
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th><a href="admin/customers?search={$searchQueryValue}&sort=kid&dir=
        HTML;
        echo self::nextDirection($sort, $dir, "kid");
        echo <<<HTML
        ">KID</a></th>
                        <th><a href="admin/customers?search={$searchQueryValue}&sort=geburtstag&dir=
        HTML;
        echo self::nextDirection($sort, $dir, "geburtstag");
        echo <<<HTML
        ">Geburtstag</a></th>
                        <th><a href="admin/customers?search={$searchQueryValue}&sort=vorname&dir=
        HTML;
        echo self::nextDirection($sort, $dir, "vorname");
        echo <<<HTML
        ">Vorname</a></th>
                        <th><a href="admin/customers?search={$searchQueryValue}&sort=name&dir=
        HTML;
        echo self::nextDirection($sort, $dir, "name");
        echo <<<HTML
        ">Name</a></th>
                        <th><a href="admin/customers?search={$searchQueryValue}&sort=geschlecht&dir=
        HTML;
        echo self::nextDirection($sort, $dir, "geschlecht");
        echo <<<HTML
        ">Geschlecht</a></th>
                        <th><a href="admin/customers?search={$searchQueryValue}&sort=kunde_seit&dir=
        HTML;
        echo self::nextDirection($sort, $dir, "kunde_seit");
        echo <<<HTML
        ">Kunde seit</a></th>
                        <th><a href="admin/customers?search={$searchQueryValue}&sort=email&dir=
        HTML;
        echo self::nextDirection($sort, $dir, "email");
        echo <<<HTML
        ">E-Mail</a></th>
                        <th><a href="admin/customers?search={$searchQueryValue}&sort=kontaktpermail&dir=
        HTML;
        echo self::nextDirection($sort, $dir, "kontaktpermail");
        echo <<<HTML
        ">Kontakt per Mail</a></th>
                        <th>Aktion</th>
                    </tr>
                </thead>
                <tbody>
        HTML;

        foreach ($contentArray as $customer) {
            $kid = (int) ($customer["kid"] ?? 0);
            $geburtstag = htmlspecialchars((string) ($customer["geburtstag"] ?? ""), ENT_QUOTES);
            $vorname = htmlspecialchars((string) ($customer["vorname"] ?? ""), ENT_QUOTES);
            $name = htmlspecialchars((string) ($customer["name"] ?? ""), ENT_QUOTES);
            $geschlecht = htmlspecialchars((string) ($customer["geschlecht"] ?? ""), ENT_QUOTES);
            $kundeSeit = htmlspecialchars((string) ($customer["kunde_seit"] ?? ""), ENT_QUOTES);
            $email = htmlspecialchars((string) ($customer["email"] ?? ""), ENT_QUOTES);
            $kontaktPerMail = htmlspecialchars((string) ($customer["kontaktpermail"] ?? ""), ENT_QUOTES);

            echo <<<HTML
                <tr>
                    <td>$kid</td>
                    <td>$geburtstag</td>
                    <td>$vorname</td>
                    <td>$name</td>
                    <td>$geschlecht</td>
                    <td>$kundeSeit</td>
                    <td>$email</td>
                    <td>$kontaktPerMail</td>
                    <td><a href="crud/customer?kid=$kid">Bearbeiten</a></td>
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
}
