<?php
declare(strict_types=1);

namespace App\Views;

class AdminView
{
    public static function render(): void
    {
        echo "<!DOCTYPE html>\n";
        echo "<html lang=\"de\">\n";
        echo "<head>\n";
        echo "<meta charset=\"UTF-8\">\n";
        echo '<link rel="stylesheet" href="' . BASE_URL . '/public/css/styles.css">' . "\n";
        echo "<title>Bücher Antiquariat</title>\n";
        echo "</head>\n";
        echo "<body>\n";

        \App\Components\HeaderComponent::render(\App\Datatypes\HeaderlocationEnum::ADMIN, "Admin");

        echo '<div class="admin-selection-container">';
        echo '<h2>Admin Auswahl</h2>';
        echo '<ul class="admin-selection-list">';
        echo '<li><a href="' . BASE_URL . '/admin/books">Bücher verwalten</a></li>';
        echo '<li><a href="' . BASE_URL . '/admin/customers">Kunden verwalten</a></li>';
        echo '<li><a href="' . BASE_URL . '/admin/info">PHP Info</a></li>';
        echo '</ul>';
        echo '</div></body></html>';
    }
}
