<?php
class HeaderComponent
{
    public static function render($title, ?string $sortValue = null)
    {
        $sortControl = "";

        if ($sortValue !== null) {
            $selectedTitleAsc = $sortValue === "title_asc" ? "selected" : "";
            $selectedTitleDesc = $sortValue === "title_desc" ? "selected" : "";
            $selectedAutorAsc = $sortValue === "autor_asc" ? "selected" : "";
            $selectedAutorDesc = $sortValue === "autor_desc" ? "selected" : "";
            $selectedZustandAsc = $sortValue === "zustand_asc" ? "selected" : "";
            $selectedZustandDesc = $sortValue === "zustand_desc" ? "selected" : "";

            $sortControl = <<<EOT
                            <li class="horizontal-list-element nav-item sort-item">
                                <form method="get" action="home" class="sort-form">
                                    <select name="sort_option" class="sort-select" onchange="this.form.submit()">
                                        <option value="title_asc" {$selectedTitleAsc}>Titel A-Z</option>
                                        <option value="title_desc" {$selectedTitleDesc}>Titel Z-A</option>
                                        <option value="autor_asc" {$selectedAutorAsc}>Autor A-Z</option>
                                        <option value="autor_desc" {$selectedAutorDesc}>Autor Z-A</option>
                                        <option value="zustand_asc" {$selectedZustandAsc}>Zustand auf</option>
                                        <option value="zustand_desc" {$selectedZustandDesc}>Zustand ab</option>
                                    </select>
                                </form>
                            </li>
            EOT;
        }

        echo <<<EOT
            <!DOCTYPE html>
            <html>
                <head>
                    <meta charset="UTF-8">
                    <link rel="stylesheet" href="src/css/styles.css">
                    <link rel="stylesheet" href="src/css/input.css">
                    <link rel="stylesheet" href="src/css/output.css">
                    <title>Bücher Antiquariat</title>
                </head>
                <body>
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
                            {$sortControl}
                        </ul>
                    </nav>
        EOT;
    }
}
?>
