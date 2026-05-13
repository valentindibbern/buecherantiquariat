<?php
declare(strict_types=1);

namespace App\Views;

class CustomerCRUDView
{
    public static function render(array $content, string $search = "", string $sort = "kid", string $dir = "asc"): void
    {
        $kid = htmlspecialchars((string) ($content["kid"] ?? ""), ENT_QUOTES);
        $geburtstag = htmlspecialchars((string) ($content["geburtstag"] ?? ""), ENT_QUOTES);
        $vorname = htmlspecialchars((string) ($content["vorname"] ?? ""), ENT_QUOTES);
        $name = htmlspecialchars((string) ($content["name"] ?? ""), ENT_QUOTES);
        $geschlecht = (string) ($content["geschlecht"] ?? "M");
        $kundeSeit = htmlspecialchars((string) ($content["kunde_seit"] ?? ""), ENT_QUOTES);
        $email = htmlspecialchars((string) ($content["email"] ?? ""), ENT_QUOTES);
        $kontaktPerMail = (string) ($content["kontaktpermail"] ?? "0");
        $headline = $kid === "" ? "Neuer Kunde" : "Kunde bearbeiten";
        $searchValue = htmlspecialchars($search, ENT_QUOTES);
        $sortValue = htmlspecialchars($sort, ENT_QUOTES);
        $dirValue = htmlspecialchars($dir, ENT_QUOTES);
        $mSelected = $geschlecht === "M" ? "selected" : "";
        $fSelected = $geschlecht === "F" ? "selected" : "";
        $mailYesSelected = $kontaktPerMail === "1" ? "selected" : "";
        $mailNoSelected = $kontaktPerMail === "0" ? "selected" : "";

        echo "<!DOCTYPE html>\n";
        echo "<html lang=\"de\">\n";
        echo "<head>\n";
        echo "<meta charset=\"UTF-8\">\n";
        echo '<link rel="stylesheet" href="' . BASE_URL . '/public/css/styles.css">' . "\n";
        echo "<title>Bücher Antiquariat</title>\n";
        echo "</head>\n";
        echo "<body>\n";

        \App\Components\HeaderComponent::render(
            \App\Datatypes\HeaderlocationEnum::CRUD_CUSTOMER,
            "Kunden CRUD",
            $sort,
            $dir,
            $search,
        );

        echo '<form method="post" action="' . BASE_URL . '/crud/customer" class="crud-form">';
        echo '<h1>' . $headline . '</h1>';
        echo '<input type="hidden" name="search" value="' . $searchValue . '">';
        echo '<input type="hidden" name="sort" value="' . $sortValue . '">';
        echo '<input type="hidden" name="dir" value="' . $dirValue . '">';
        echo '<label for="kid">KID</label><br><input type="text" name="kid" value="' . $kid . '"';

        if ($kid !== "") {
            echo ' readonly';
        }

        echo '><br>';
        echo '<label for="geburtstag">Geburtstag</label><br><input type="date" name="geburtstag" value="' . $geburtstag . '"><br>';
        echo '<label for="vorname">Vorname</label><br><input type="text" name="vorname" value="' . $vorname . '"><br>';
        echo '<label for="name">Name</label><br><input type="text" name="name" value="' . $name . '"><br>';
        echo '<label for="geschlecht">Geschlecht</label><br><select name="geschlecht">';
        echo '<option value="M" ' . $mSelected . '>M</option>';
        echo '<option value="F" ' . $fSelected . '>F</option>';
        echo '</select><br>';
        echo '<label for="kunde_seit">Kunde seit</label><br><input type="date" name="kunde_seit" value="' . $kundeSeit . '"><br>';
        echo '<label for="email">E-Mail</label><br><input type="text" name="email" value="' . $email . '"><br>';
        echo '<label for="kontaktpermail">Kontakt per Mail</label><br><select name="kontaktpermail">';
        echo '<option value="1" ' . $mailYesSelected . '>Ja</option>';
        echo '<option value="0" ' . $mailNoSelected . '>Nein</option>';
        echo '</select><br>';
        echo '<div class="crud-button-row"><input type="submit" value="Save">';

        if ($kid !== "") {
            echo '<button type="submit" name="delete" value="1" onclick="return confirm(\'Eintrag wirklich löschen?\');">Delete</button>';
        }

        echo '</div></form></body></html>';
    }
}
