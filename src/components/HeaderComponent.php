<?php
class HeaderComponent
{
    public static function render($title)
    {
        echo <<<EOT
            <!DOCTYPE html>
            <html>
                <head>
                    <meta charset="UTF-8">
                    <link rel="stylesheet" href="src/css/styles.css">
                    <link rel="stylesheet" href="src/css/input.css">
                    <link rel="stylesheet" href="src/css/output.css">
                    <title>Bücher Antiquariat</title>
                </head>
                <body>
                    <nav class="navbar">
                        <h1 class="navbar-brand">$title</h1>
                        <ul class="horizontal-list">
                            <li class="horizontal-list-element nav-item"><a href="home">Home</a></li>
                            <li class="horizontal-list-element nav-item">
                                <form method="get" action="search" class="search-form">
                                    <input name="search" type="search" placeholder="Search..." class="search-input">
                                    <button type="submit" class="search-button">Search</button>
                                </form>
                            </li>
                        </ul>
                    </nav>
        EOT;
    }
}
?>
