<?php
declare(strict_types=1);

class PopupComponent
{
    public static function popup(string $message): void
    {
        echo "<script>alert('$message');</script>";
    }
}

?>
