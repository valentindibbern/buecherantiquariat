<?php
namespace App\Components;
class KachelComponent
{
    public static function render($id, $img, $name, $autor, $zustand): void
    {
        $img = $img ?? "Bild nicht verfügbar";
        $name = $name ?? "Name nicht verfügbar";
        $autor = $autor ?? "Autor nicht verfügbar";
        $zustand =
            \App\Datatypes\ZustandEnum::from($zustand)->label() ?? "Zustand nicht verfügbar";

        echo <<<EOT
            <a href="
        EOT;

        echo BASE_URL . "/detail?id=$id";

        echo <<<EOT
            ">
                <div class="kachel">
                    <img class="kachel-img" src="$img" alt="Bild von $name">
                    <div class="kachel-content">
                        <h3>$name</h3>
                        <p>$autor</p>
                        <p>$zustand</p>
                    </div>
                </div>
            </a>
        EOT;
    }
}
