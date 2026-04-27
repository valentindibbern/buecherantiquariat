<?php
declare(strict_types=1);

class SortComponent
{
    public static function element(string $sort, string $dir): string
    {
        $titelSelected = $sort === "title" ? "selected" : "";
        $autorSelected = $sort === "autor" ? "selected" : "";
        $zustandSelected = $sort === "zustand" ? "selected" : "";

        $ascSelected = $dir === "asc" ? "selected" : "";
        $descSelected = $dir === "desc" ? "selected" : "";

        return <<<HTML
        <li class="horizontal-list-element nav-item">
            <form method="get" action="home" class="sort-form">
                <select name="sort" class="sort-select" onchange="this.form.submit()">
                    <option value="title" $titelSelected>Titel</option>
                    <option value="autor" $autorSelected>Autor</option>
                    <option value="zustand" $zustandSelected>Zustand</option>
                </select>
                <select name="dir" class="sort-select" onchange="this.form.submit()">
                    <option value="asc" $ascSelected>Aufsteigend</option>
                    <option value="desc" $descSelected>Absteigend</option>
                </select>
            </form>
        </li>
        HTML;
    }
}

?>
