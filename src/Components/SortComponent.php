<?php
declare(strict_types=1);

namespace App\Components;

class SortComponent
{
    public static function element(
        string $actionUrl,
        array $sortOptions,
        string $sort,
        string $dir,
        array $hiddenFields = [],
    ): string
    {
        $actionUrl = htmlspecialchars($actionUrl, ENT_QUOTES);
        $sort = htmlspecialchars($sort, ENT_QUOTES);
        $dir = htmlspecialchars($dir, ENT_QUOTES);

        $html = <<<HTML
        <li class="horizontal-list-element nav-item">
            <form method="get" action="$actionUrl" class="sort-form">
        HTML;

        foreach ($hiddenFields as $name => $value) {
            $name = htmlspecialchars((string) $name, ENT_QUOTES);
            $value = htmlspecialchars((string) $value, ENT_QUOTES);
            $html .= <<<HTML
                <input type="hidden" name="$name" value="$value">
            HTML;
        }

        $html .= <<<HTML
                <select name="sort" class="sort-select" onchange="this.form.submit()">
        HTML;

        foreach ($sortOptions as $value => $label) {
            $value = htmlspecialchars((string) $value, ENT_QUOTES);
            $label = htmlspecialchars((string) $label, ENT_QUOTES);
            $selected = ((string) $value === $sort) ? "selected" : "";
            $html .= <<<HTML
                    <option value="$value" $selected>$label</option>
            HTML;
        }

        $html .= <<<HTML
                </select>
                <select name="dir" class="sort-select" onchange="this.form.submit()">
                    <option value="asc" 
        HTML;
        $html .= self::selectedAttr($dir, "asc");
        $html .= <<<HTML
                    >Aufsteigend</option>
                    <option value="desc" 
        HTML;
        $html .= self::selectedAttr($dir, "desc");
        $html .= <<<HTML
                    >Absteigend</option>
                </select>
            </form>
        </li>
        HTML;

        return $html;
    }

    private static function selectedAttr(string $current, string $expected): string
    {
        return strtolower($current) === strtolower($expected) ? "selected" : "";
    }
}
