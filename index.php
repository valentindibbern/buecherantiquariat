<?php
declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

//spl_autoload_register(function ($classname) {
//    $baseDir = __DIR__ . "/src/";
//
//    $folders = [
//        "Controllers/",
//        "Components/",
//        "Datatypes/",
//        "Models/",
//        "unique/",
//        "Views/",
//    ];
//
//    foreach ($folders as $folder) {
//        $file = $baseDir . $folder . $classname . ".php";
//        if (file_exists($file)) {
//            include $file;
//            return;
//        }
//    }
//});

$controller = new App\Controllers\MainController();

