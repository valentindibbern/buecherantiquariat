<?php
class FooterComponent
{
    public static function render()
    {
        echo <<<EOT
            <footer class="footer">
                <span class="footer-text">Valentin Dibber</span>
                <br>
                <span class="footer-text">Bücher Antiquariat</span>
            </footer>
        EOT;
    }
}
?>
