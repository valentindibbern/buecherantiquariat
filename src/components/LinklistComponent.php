<?php
declare(strict_types=1);

class LinklistComponent
{
    public static function element(
        HeaderlocationEnum $headerLocation = HeaderlocationEnum::MINIMAL,
    ): string {
        $html = "";

        $adminLink = '<a href="admin">Admin</a>';
        $homeLink = '<a href="home">Home</a>';
        $logginLink = '<a href="login">Login</a>';
        $logoutLink = '<a href="logout">Logout</a>';

        switch ($headerLocation) {
            case HeaderlocationEnum::ADMIN:
                $html .= $logoutLink;
                break;
            case HeaderlocationEnum::CRUD:
                $html .= $adminLink;
                $html .= $logoutLink;
                break;
            case HeaderlocationEnum::DETAIL:
                $html .= $homeLink;
                $html .= $logginLink;
                break;
            case HeaderlocationEnum::HOME:
                $html .= $logginLink;
                break;
            case HeaderlocationEnum::LOGIN:
                $html .= $homeLink;
                break;
            case HeaderlocationEnum::MINIMAL:
                $html .= $homeLink;
                $html .= $logginLink;
                break;
            case HeaderlocationEnum::SEARCH:
                $html .= $homeLink;
                $html .= $logginLink;
                break;
            default:
                $html .= <<<HTML
                    <p>Element not found</p>
                HTML;
                break;
        }

        return $html;
    }
}
?>
