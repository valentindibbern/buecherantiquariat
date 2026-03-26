<?php
class UIKachel
{
    public static function render($img, $name, $autor, $zustand)
    {
        echo <<<EOT
             <div class="kachel">
                 <img src="$img" alt="Bild von $name">
                 <div class="kachel-content">
                     <h3>$name</h3>
                     <p>$autor</p>
                     <p>$zustand</p>
                 </div>
             </div>
        EOT;
    }
}
?>
