<?php

include "src/uicomponents/kachel.php";
include "src/uicomponents/header.php";
include "src/uicomponents/footer.php";

class UserBookList
{
    private $cols = 6;
    private $rows = 3;

    public static function render($carr)
    {
        Header::render();

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

        Footer::render();
    }
}

?>
