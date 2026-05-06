<?php
namespace App\Components;

class HeaderComponent
{
    public static function render(
        \App\Datatypes\HeaderlocationEnum $headerLocation = \App\Datatypes\HeaderlocationEnum::MINIMAL,
        string             $title = "",
        string             $sort = "title",
        string             $dir = "asc",
    ): void
    {
        $html = <<<HTML
        <h1 class='page-title'><a href='home'>Bücher Antiquariat</a></h1>
        <hr>
        <nav class="navbar">
            <ul class="horizontal-list">
        HTML;

        switch ($headerLocation) {
            case \App\Datatypes\HeaderlocationEnum::ADMIN:
                $html .= LinklistComponent::element(\App\Datatypes\HeaderlocationEnum::ADMIN);
                break;
            case \App\Datatypes\HeaderlocationEnum::CRUD:
                $html .= LinklistComponent::element(\App\Datatypes\HeaderlocationEnum::CRUD);
                break;
            case \App\Datatypes\HeaderlocationEnum::DETAIL:
                $html .= LinklistComponent::element(\App\Datatypes\HeaderlocationEnum::DETAIL);
                break;
            case \App\Datatypes\HeaderlocationEnum::HOME:
                $html .= SortComponent::element($sort, $dir);
                $html .= SearchComponent::element();
                $html .= LinklistComponent::element(\App\Datatypes\HeaderlocationEnum::HOME);
                break;
            case \App\Datatypes\HeaderlocationEnum::LOGIN:
                $html .= LinklistComponent::element(\App\Datatypes\HeaderlocationEnum::LOGIN);
                break;
            case \App\Datatypes\HeaderlocationEnum::MINIMAL:
                $html .= LinklistComponent::element(
                    \App\Datatypes\HeaderlocationEnum::MINIMAL,
                );
                break;
            case \App\Datatypes\HeaderlocationEnum::SEARCH:
                $html .= SortComponent::element($sort, $dir);
                $html .= SearchComponent::element();
                $html .= LinklistComponent::element(\App\Datatypes\HeaderlocationEnum::SEARCH);
                break;
            default:
                $html .= <<<HTML
                    <p>Element not found</p>
                HTML;
                break;
        }

        $html .= <<<HTML
                </ul>
            </nav>
            <hr>
        HTML;

        echo $html;
    }
}