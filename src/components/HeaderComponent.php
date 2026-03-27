<?php
class HeaderComponent
{
    public static function render($title)
    {
        echo <<<EOT
            <nav class="navbar">
                <h1 class="navbar-brand">$title</h1>
                <ul class="navbar-left-nav">
                    <li class="nav-item-lef-rigt"><a href="home">Home</a></li>
                    <li class="nav-item-right">Login</li>
                </ul>
            </nav>
        EOT;
    }
}
?>
