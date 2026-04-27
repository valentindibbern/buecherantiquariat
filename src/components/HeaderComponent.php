<?php
class HeaderComponent
{
    public static function render(
        string $title = "",
        string $sort = "title",
        string $dir = "asc",
        HeaderlocationEnum $headerLocation = HeaderlocationEnum::MINIMAL,
    ) {
        $html = <<<HTML
        <h1 class='page-title'><a href='home'>Bücher Antiquariat</a></h1>
        <hr>
        <nav class="navbar">
            <ul class="horizontal-list">
        HTML;

        switch ($headerLocation) {
            case HeaderlocationEnum::ADMIN:
                break;
            case HeaderlocationEnum::DETAIL:
                $html .= LinklistComponent::element(HeaderlocationEnum::DETAIL);
                break;
            case HeaderlocationEnum::HOME:
                $html .= SortComponent::element($sort, $dir);
                $html .= SearchComponent::element();
                $html .= LinklistComponent::element(HeaderlocationEnum::HOME);
                break;
            case HeaderlocationEnum::LOGIN:
                $html .= LinklistComponent::element(HeaderlocationEnum::LOGIN);
                break;
            case HeaderlocationEnum::MINIMAL:
                $html .= LinklistComponent::element(
                    HeaderlocationEnum::MINIMAL,
                );
                break;
            case HeaderlocationEnum::SEARCH:
                $html .= SortComponent::element($sort, $dir);
                $html .= SearchComponent::element();
                $html .= LinklistComponent::element(HeaderlocationEnum::SEARCH);
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
?>
