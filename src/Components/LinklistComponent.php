<?php
declare(strict_types=1);

namespace App\Components;
class LinklistComponent
{
    public static function element(
        \App\Datatypes\HeaderlocationEnum $headerLocation = \App\Datatypes\HeaderlocationEnum::MINIMAL,
    ): string
    {
        $html = "";

        $adminLink = '<a href="admin">Admin</a>';
        $homeLink = '<a href="home">Home</a>';
        $logginLink = '<a href="login">Login</a>';
        $logoutLink = '<a href="logout">Logout</a>';

        switch ($headerLocation) {
            case \App\Datatypes\HeaderlocationEnum::ADMIN:
                $html .= $logoutLink;
                break;
            case \App\Datatypes\HeaderlocationEnum::CRUD:
                $html .= $adminLink;
                $html .= $logoutLink;
                break;
            case \App\Datatypes\HeaderlocationEnum::MINIMAL:
            case \App\Datatypes\HeaderlocationEnum::SEARCH:
            case \App\Datatypes\HeaderlocationEnum::DETAIL:
                $html .= $homeLink;
                $html .= $logginLink;
                break;
            case \App\Datatypes\HeaderlocationEnum::HOME:
                $html .= $logginLink;
                break;
            case \App\Datatypes\HeaderlocationEnum::LOGIN:
                $html .= $homeLink;
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