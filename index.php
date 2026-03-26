<?php
include "src/controllers/mainController.php";

$controller = new MainController();

echo <<<EOT
    <!DOCTYPE html>
    <html>
        <head>
            <meta charset="UTF-8">
            <link rel="stylesheet" href="styles.css">
            <title>Bücher Antiquariat</title>
        </head>
        <body>
EOT;

$controller->update();

echo <<<EOT
        </body>
    </html>
EOT;
?>
