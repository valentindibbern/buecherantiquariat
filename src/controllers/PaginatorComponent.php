<?php
declare(strict_types=1);

class PaginatorComponent
{
    public static function render(int $currentPage, int $totalPages)
    {
        echo <<<EOT
        <div class="paginator">
            <ul>
                <li class="first-page"><a href="home?page=1">1</a></li>
                <li class="previous-page"><a href="home?page=">{$currentPage - 1}</a></li>
                <li class="current-page">{$currentPage}</li>
                <li class="next-page"><a href="home?page={$currentPage + 1}">{$currentPage + 1}</a></li>
                <li class="last-page"><a href="home?page={$totalPages}">{$totalPages}</a></li>
            </ul>
        </div>
        EOT;
    }
}
?>
