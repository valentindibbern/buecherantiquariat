<?php
namespace App\Components;

class FooterComponent
{
    public static function render(): void
    {
        echo <<<EOT
            <footer class="footer">
                <span class="footer-text align-center">Valentin Dibber</span>
                <br>
                <span class="footer-text align-center">Bücher Antiquariat</span>
            </footer>
        EOT;
    }
}