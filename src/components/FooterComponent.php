<?php
class FooterComponent
{
    public static function render()
    {
        echo <<<EOT
                    <footer class="footer">
                        <span class="footer-text align-center">Valentin Dibber</span>
                        <br>
                        <span class="footer-text align-center">Bücher Antiquariat</span>
                    </footer>
                </body>
            </html>
        EOT;
    }
}
?>
