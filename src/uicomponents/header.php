<?php
class UIHeader
{
    public static function render($title)
    {
        echo <<<EOT
            <nav class="navbar">
                <h1 class="navbar-brand"><a href="#" class="navbar-brand">$title von Bücher Antiquariat</a></h1>
                <ul class="navbar-left-nav">
                    <li class="nav-item-lef-rigt"><a href="#" class="nav-link">Home</a></li>
                    <li class="nav-item-right"><a href="#" class="nav-link">Login</a></li>
                </ul>
            </nav>
        EOT;
    }
}
?>
