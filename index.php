<?php
declare(strict_types=1);

if (!defined('MINIMUM_PHP_VERSION')) {
    define('MINIMUM_PHP_VERSION', '8.1.0');
}

if (version_compare(PHP_VERSION, MINIMUM_PHP_VERSION, '<')) {
    http_response_code(500);
    header('Content-Type: text/html; charset=UTF-8');

    $currentVersion = htmlspecialchars(PHP_VERSION, ENT_QUOTES, 'UTF-8');
    $requiredVersion = htmlspecialchars(MINIMUM_PHP_VERSION, ENT_QUOTES, 'UTF-8');

    echo <<<HTML
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>PHP-Version nicht unterstuetzt</title>
</head>
<body>
    <h1>PHP-Version nicht unterstuetzt</h1>
    <p>Diese Anwendung benoetigt mindestens PHP {$requiredVersion}.</p>
    <p>Aktuell ausgefuehrt wird PHP {$currentVersion}.</p>
</body>
</html>
HTML;
    exit;
}

spl_autoload_register(function ($classname) {
    $baseDir = __DIR__ . "/src/";

    $folders = [
        "controllers/",
        "components/",
        "datatypes/",
        "models/",
        "unique/",
        "views/",
    ];

    foreach ($folders as $folder) {
        $file = $baseDir . $folder . $classname . ".php";
        if (file_exists($file)) {
            include $file;
            return;
        }
    }
});

$controller = new MainController();
?>
