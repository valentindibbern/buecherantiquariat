<?php
declare(strict_types=1);

spl_autoload_register(function ($classname) {
    $baseDir = __DIR__ . "/src/";

    $folders = ["controllers/", "components/", "models/", "unique/", "views/"];

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
