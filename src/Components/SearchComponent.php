<?php
declare(strict_types=1);

namespace App\Components;

class SearchComponent
{
    public static function element(
        string $actionUrl,
        string $search = "",
        array $hiddenFields = [],
    ): string
    {
        $actionUrl = htmlspecialchars($actionUrl, ENT_QUOTES);
        $search = htmlspecialchars($search, ENT_QUOTES);

        $html = <<<HTML
        <li class="horizontal-list-element nav-item">
            <form method="get" action="
        HTML;
        $html .= $actionUrl;
        $html .= <<<HTML
        " class="search-form">
        HTML;

        foreach ($hiddenFields as $name => $value) {
            $name = htmlspecialchars((string) $name, ENT_QUOTES);
            $value = htmlspecialchars((string) $value, ENT_QUOTES);
            $html .= <<<HTML
                <input type="hidden" name="$name" value="$value">
            HTML;
        }

        $html .= <<<HTML
                <input name="search" type="search" value="$search" placeholder="Search..." class="search-input">
                <button type="submit" class="search-button">Search</button>
            </form>
        </li>
        HTML;

        return $html;
    }
}
