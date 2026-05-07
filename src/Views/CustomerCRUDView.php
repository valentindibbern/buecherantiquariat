<?php
declare(strict_types=1);

namespace App\Views;

class CustomerCRUDView
{
    public static function render(array $content): void
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
        $mSelected = $geschlecht === "M" ? "selected" : "";
        $fSelected = $geschlecht === "F" ? "selected" : "";
        $mailYesSelected = $kontaktPerMail === "1" ? "selected" : "";
        $mailNoSelected = $kontaktPerMail === "0" ? "selected" : "";

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
            \App\Datatypes\HeaderlocationEnum::CRUD_CUSTOMER,
            "Kunden CRUD",
        );

        echo <<<HTML
        <form method="post" action="crud/customer" class="crud-form">
            <h1>$headline</h1>
            <label for="kid">KID</label>
            <br>
            <input type="text" name="kid" value="$kid"
        HTML;

        if ($kid !== "") {
            echo ' readonly';
        }

        echo <<<HTML
            >
            <br>
            <label for="geburtstag">Geburtstag</label>
            <br>
            <input type="date" name="geburtstag" value="$geburtstag">
            <br>
            <label for="vorname">Vorname</label>
            <br>
            <input type="text" name="vorname" value="$vorname">
            <br>
            <label for="name">Name</label>
            <br>
            <input type="text" name="name" value="$name">
            <br>
            <label for="geschlecht">Geschlecht</label>
            <br>
            <select name="geschlecht">
                <option value="M" $mSelected>M</option>
                <option value="F" $fSelected>F</option>
            </select>
            <br>
            <label for="kunde_seit">Kunde seit</label>
            <br>
            <input type="date" name="kunde_seit" value="$kundeSeit">
            <br>
            <label for="email">E-Mail</label>
            <br>
            <input type="text" name="email" value="$email">
            <br>
            <label for="kontaktpermail">Kontakt per Mail</label>
            <br>
            <select name="kontaktpermail">
                <option value="1" $mailYesSelected>Ja</option>
                <option value="0" $mailNoSelected>Nein</option>
            </select>
            <br>
            <div class="crud-button-row">
                <input type="submit" value="Save">
        HTML;

        if ($kid !== "") {
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
