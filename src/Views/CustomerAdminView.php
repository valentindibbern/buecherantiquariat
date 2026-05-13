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
        $linkSearch = urlencode($search);
        $linkSort = urlencode($sort);
        $linkDir = urlencode($dir);

        echo "<!DOCTYPE html>\n";
        echo "<html lang=\"de\">\n";
        echo "<head>\n";
        echo "<meta charset=\"UTF-8\">\n";
        echo '<link rel="stylesheet" href="' . BASE_URL . '/public/css/styles.css">' . "\n";
        echo "<title>Bücher Antiquariat</title>\n";
        echo "</head>\n";
        echo "<body>\n";

        \App\Components\HeaderComponent::render(
            \App\Datatypes\HeaderlocationEnum::ADMIN_CUSTOMERS,
            "Kunden Admin",
            $sort,
            $dir,
            $search,
        );

        echo '<div class="table-container">';
        echo '<table>';
        echo '<thead><tr>';
        echo '<th>KID</th><th>Geburtstag</th><th>Vorname</th><th>Name</th><th>Geschlecht</th><th>Kunde seit</th><th>E-Mail</th><th>Kontakt per Mail</th>';
        echo '</tr></thead><tbody>';

        foreach ($contentArray as $customer) {
            $kid = (int) ($customer["kid"] ?? 0);
            $geburtstag = htmlspecialchars((string) ($customer["geburtstag"] ?? ""), ENT_QUOTES);
            $vorname = htmlspecialchars((string) ($customer["vorname"] ?? ""), ENT_QUOTES);
            $name = htmlspecialchars((string) ($customer["name"] ?? ""), ENT_QUOTES);
            $nameLabel = $name !== "" ? $name : "Ohne Namen";
            $geschlecht = htmlspecialchars((string) ($customer["geschlecht"] ?? ""), ENT_QUOTES);
            $kundeSeit = htmlspecialchars((string) ($customer["kunde_seit"] ?? ""), ENT_QUOTES);
            $email = htmlspecialchars((string) ($customer["email"] ?? ""), ENT_QUOTES);
            $kontaktPerMail = htmlspecialchars((string) ($customer["kontaktpermail"] ?? ""), ENT_QUOTES);
            $link = BASE_URL . '/crud/customer?kid=' . $kid . '&search=' . $linkSearch . '&sort=' . $linkSort . '&dir=' . $linkDir;

            echo '<tr>';
            echo '<td>' . $kid . '</td>';
            echo '<td>' . $geburtstag . '</td>';
            echo '<td>' . $vorname . '</td>';
            echo '<td><a class="table-link" href="' . $link . '">' . $nameLabel . '</a></td>';
            echo '<td>' . $geschlecht . '</td>';
            echo '<td>' . $kundeSeit . '</td>';
            echo '<td>' . $email . '</td>';
            echo '<td>' . $kontaktPerMail . '</td>';
            echo '</tr>';
        }

        echo '</tbody></table></div></body></html>';
    }
}
