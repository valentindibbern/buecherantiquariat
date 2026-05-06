<?php
declare(strict_types=1);

namespace App\Views;

class LoginView
{
    public static function render(): void
    {
        echo <<<EOT
            <!DOCTYPE html>
            <html lang="de">
            <head>
                <meta charset="UTF-8">
                <link rel="stylesheet" href="styles.css">
                <title>Bücher Antiquariat</title>
            </head>
            <body>
        EOT;

        \App\Components\HeaderComponent::render(\App\Datatypes\HeaderlocationEnum::LOGIN, "Login");

        echo <<<EOT
            <form method="post" action="">
                <label for="username">Nutzername:</label>
                <input type="text" id="username" name="username" placeholder="Username" required>
                <label for="password">Passwort:</label>
                <input type="password" id="password" name="password" placeholder="Password" required>
                <input type="submit" value="Login">
            </form>
        EOT;
    }
}