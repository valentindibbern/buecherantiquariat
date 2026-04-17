<?php
class HeaderComponent
{
    public static function render(string $title, string $sort, string $dir)
    {
        $sort = strtolower($sort);
        $dir = strtolower($dir);

        if ($sort == "titel") {
            $sort = "title";
        }

        $titelSelected = $sort === "title" ? "selected" : "";
        $autorSelected = $sort === "autor" ? "selected" : "";
        $zustandSelected = $sort === "zustand" ? "selected" : "";

        $ascSelected = $dir === "asc" ? "selected" : "";
        $descSelected = $dir === "desc" ? "selected" : "";

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
                </ul>
            </nav>
        EOT;
    }
}
?>
