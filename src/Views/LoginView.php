<?php
declare(strict_types=1);

namespace App\Views;

class LoginView
{
    public static function render(): void
    {
        echo "<!DOCTYPE html>\n";
        echo "<html lang=\"de\">\n";
        echo "<head>\n";
        echo "<meta charset=\"UTF-8\">\n";
        echo '<link rel="stylesheet" href="' . BASE_URL . '/public/css/styles.css">' . "\n";
        echo "<title>Bücher Antiquariat</title>\n";
        echo "</head>\n";
        echo "<body>\n";

        \App\Components\HeaderComponent::render(\App\Datatypes\HeaderlocationEnum::LOGIN, "Login");

        echo '<form method="post" action="">';
        echo '<label for="username">Nutzername:</label>';
        echo '<input type="text" id="username" name="username" placeholder="Username" required>';
        echo '<label for="password">Passwort:</label>';
        echo '<input type="password" id="password" name="password" placeholder="Password" required>';
        echo '<input type="submit" value="Login">';
        echo '</form></body></html>';
    }
}
