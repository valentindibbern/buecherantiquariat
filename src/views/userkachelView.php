<?php

include "src/uicomponents/kachel.php";
include "src/uicomponents/header.php";
include "src/uicomponents/footer.php";

class UserKachelView
{
    public static function render($carr)
    {
        $cols = 6;
        $rows = 3;

        UIHeader::render("Home");

        echo '<div class="grid-container">';
        $count = 0;
        foreach ($carr as $item) {
            UIKachel::render(
                $item["foto"],
                $item["Title"],
                $item["autor"],
                $item["zustand"],
            );
            $count++;
            if ($count == $cols * $rows) {
                break;
            } elseif ($count % $cols == 0) {
                echo "<br>";
            }
        }
        echo "</div>";

        UIFooter::render();
    }
}

?>
