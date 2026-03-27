<?php
declare(strict_types=1);

class PaginatorComponent
{
    public static function render(int $currentPage)
    {
        $previousPage = $currentPage - 1;
        $nextPage = $currentPage + 1;
        $totalPages = $_COOKIE["totalPages"];

        switch ($currentPage) {
            case 1:
                echo <<<EOT
                <div class="paginator">
                    <ul>
                        <li class="current-page">1</li>
                        <li class="next-page"><a href="home?page={$nextPage}">{$nextPage}</a></li>
                        <li class="last-page"><a href="home?page={$totalPages}">{$totalPages}</a></li>
                    </ul>
                </div>
                EOT;
                break;
            case 2:
                echo <<<EOT
                <div class="paginator">
                    <ul>
                        <li class="first-page"><a href="home?page=1">1</a></li>
                        <li class="current-page">{$currentPage}</li>
                        <li class="next-page"><a href="home?page={$nextPage}">{$nextPage}</a></li>
                        <li class="last-page"><a href="home?page={$totalPages}">{$totalPages}</a></li>
                    </ul>
                </div>
                EOT;
                break;
            case $totalPages - 1:
                echo <<<EOT
                <div class="paginator">
                    <ul>
                        <li class="first-page"><a href="home?page=1">1</a></li>
                        <li class="previous-page"><a href="home?page={$previousPage}">{$previousPage}</a></li>
                        <li class="current-page">{$currentPage}</li>
                        <li class="last-page"><a href="home?page={$totalPages}">{$totalPages}</a></li>
                    </ul>
                </div>
                EOT;
                break;
            case $totalPages:
                echo <<<EOT
                <div class="paginator">
                    <ul>
                        <li class="first-page"><a href="home?page=1">1</a></li>
                        <li class="previous-page"><a href="home?page={$previousPage}">{$previousPage}</a></li>
                        <li class="current-page">{$currentPage}</li>
                    </ul>
                </div>
                EOT;
                break;
            default:
                echo <<<EOT
                <div class="paginator">
                    <ul>
                        <li class="first-page"><a href="home?page=1">1</a></li>
                        <li class="previous-page"><a href="home?page={$previousPage}">{$previousPage}</a></li>
                        <li class="current-page">{$currentPage}</li>
                        <li class="next-page"><a href="home?page={$nextPage}">{$nextPage}</a></li>
                        <li class="last-page"><a href="home?page={$totalPages}">{$totalPages}</a></li>
                    </ul>
                </div>
                EOT;
                break;
        }
    }
}
?>
