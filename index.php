<?php

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

include "src/controller/controller.php";

$controller = new Controller();
$controller->connect();
$controller->update();

echo "<p>hallo</p>";

echo <<<EOT
        </body>
    </html>
EOT;
?>
