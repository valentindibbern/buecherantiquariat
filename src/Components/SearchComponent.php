<?php
declare(strict_types=1);

namespace App\Components;

class SearchComponent
{
    public static function element(): string
    {
        return <<<HTML
        <li class="horizontal-list-element nav-item">
            <form method="get" action="
        HTML
        . BASE_URL .
        <<<HTML
        /search" class="search-form">
                <input name="search" type="search" placeholder="Search..." class="search-input">
                <button type="submit" class="search-button">Search</button>
            </form>
        </li>
        HTML;
    }
}
