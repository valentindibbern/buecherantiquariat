<?php
class HeaderComponent
{
    public static function render(string $title, string $sort, string $dir)
    {
        echo <<<EOT
            <nav class="navbar">
                <h1 class="navbar-brand">$title</h1>
                <ul class="horizontal-list">
                    <li class="horizontal-list-element nav-item"><a href="home">Home</a></li>
                    <li class="horizontal-list-element nav-item">
                        <form method="get" action="search" class="search-form">
                            <input name="search" type="search" placeholder="Search..." class="search-input">
                            <button type="submit" class="search-button">Search</button>
                        </form>
                    </li>
                    <li>
                        <form method="get" action="home" class="sort-form">
                            <select name="sort" class="sort-select" onchange="this.form.submit()">
                                <option value="titel" {$sort === "titel" ? "selected" : ""}>Titel</option>
                                <option value="autor" {$sort === "autor" ? "selected" : ""}>Autor</option>
                                <option value="zustand" {$sort === "zustand" ? "selected" : ""}>Zustand</option>
                            </select>
                            <select name="dir" class="sort-select" onchange="this.form.submit()">
                                <option value="asc" {$dir === "asc" ? "selected" : ""}>Aufsteigend</option>
                                <option value="desc" {$dir === "desc" ? "selected" : ""}>Absteigend</option>
                        </form>
                    </li>
                </ul>
            </nav>
        EOT;
    }
}
?>
