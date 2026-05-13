<?php
declare(strict_types=1);

namespace App\Components;

class PaginatorComponent
{
    private static function homeUrl(int $page): string
    {
        return BASE_URL . "/home?page=$page";
    }

    public static function render(
        int    $currentPage,
        int    $totalPages,
        string $sort,
        string $dir,
    ): void
    {
        $previousPage = $currentPage - 1;
        $nextPage = $currentPage + 1;

        switch ($currentPage) {
            case 1:
                echo <<<EOT
                <hr>
                <div class="paginator-container align-center">
                    <ul class="horizontal-list centered-list">
                        <li class="horizontal-list-element align-center current-page">1</li>
                        <li class="horizontal-list-element margin-left-auto next-page"><a href="
                EOT;
                echo self::homeUrl($nextPage);
                echo <<<EOT
                ">{$nextPage}</a></li>
                        <li class="horizontal-list-element margin-left-auto last-page"><a href="
                EOT;
                echo self::homeUrl($totalPages);
                echo <<<EOT
                ">{$totalPages}</a></li>
                    </ul>
                </div>
                <hr>
                EOT;
                break;
            case 2:
                echo <<<EOT
                <hr>
                <div class="paginator-container align-center">
                    <ul class="horizontal-list centered-list">
                        <li class="horizontal-list-element margin-right-auto previous-page"><a href="
                EOT;
                echo self::homeUrl(1);
                echo <<<EOT
                ">1</a></li>
                        <li class="horizontal-list-element align-center current-page">{$currentPage}</li>
                        <li class="horizontal-list-element margin-left-auto next-page"><a href="
                EOT;
                echo self::homeUrl($nextPage);
                echo <<<EOT
                ">{$nextPage}</a></li>
                        <li class="horizontal-list-element margin-left-auto last-page"><a href="
                EOT;
                echo self::homeUrl($totalPages);
                echo <<<EOT
                ">{$totalPages}</a></li>
                    </ul>
                </div>
                <hr>
                EOT;
                break;
            case $totalPages - 1:
                echo <<<EOT
                <hr>
                <div class="paginator-container align-center">
                    <ul class="horizontal-list centered-list">
                        <li class="horizontal-list-element margin-right-auto first-page"><a href="
                EOT;
                echo self::homeUrl(1);
                echo <<<EOT
                ">1</a></li>
                        <li class="horizontal-list-element margin-right-auto previous-page"><a href="
                EOT;
                echo self::homeUrl($previousPage);
                echo <<<EOT
                ">{$previousPage}</a></li>
                        <li class="horizontal-list-element align-center current-page">{$currentPage}</li>
                        <li class="horizontal-list-element margin-left-auto last-page"><a href="
                EOT;
                echo self::homeUrl($totalPages);
                echo <<<EOT
                ">{$totalPages}</a></li>
                    </ul>
                </div>
                <hr>
                EOT;
                break;
            case $totalPages:
                echo <<<EOT
                <hr>
                <div class="paginator-container align-center">
                    <ul class="horizontal-list centered-list">
                        <li class="horizontal-list-element margin-right-auto first-page"><a href="
                EOT;
                echo self::homeUrl(1);
                echo <<<EOT
                ">1</a></li>
                        <li class="horizontal-list-element margin-right-auto previous-page"><a href="
                EOT;
                echo self::homeUrl($previousPage);
                echo <<<EOT
                ">{$previousPage}</a></li>
                        <li class="horizontal-list-element align-center current-page">{$currentPage}</li>
                    </ul>
                </div>
                <hr>
                EOT;
                break;
            default:
                echo <<<EOT
                <hr>
                <div class="paginator-container align-center">
                    <ul class="horizontal-list centered-list">
                        <li class="horizontal-list-element margin-right-auto first-page"><a href="
                EOT;
                echo self::homeUrl(1);
                echo <<<EOT
                ">1</a></li>
                        <li class="horizontal-list-element margin-right-auto previous-page"><a href="
                EOT;
                echo self::homeUrl($previousPage);
                echo <<<EOT
                ">{$previousPage}</a></li>
                        <li class="horizontal-list-element align-center current-page">{$currentPage}</li>
                        <li class="horizontal-list-element margin-left-auto next-page"><a href="
                EOT;
                echo self::homeUrl($nextPage);
                echo <<<EOT
                ">{$nextPage}</a></li>
                        <li class="horizontal-list-element margin-left-auto last-page"><a href="
                EOT;
                echo self::homeUrl($totalPages);
                echo <<<EOT
                ">{$totalPages}</a></li>
                    </ul>
                </div>
                <hr>
                EOT;
                break;
        }
    }
}
