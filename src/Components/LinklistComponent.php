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

        $adminLink = '<a href="' . BASE_URL . '/admin">Admin</a>';
        $adminBooksLink = '<a href="' . BASE_URL . '/admin/books">Bücher</a>';
        $adminCustomersLink = '<a href="' . BASE_URL . '/admin/customers">Kunden</a>';
        $adminInfoLink = '<a href="' . BASE_URL . '/admin/info">Info</a>';
        $newBookLink = '<a href="' . BASE_URL . '/crud/book?create=1">Neues Buch</a>';
        $newCustomerLink = '<a href="' . BASE_URL . '/crud/customer?create=1">Neuer Kunde</a>';
        $homeLink = '<a href="' . BASE_URL . '/home">Home</a>';
        $logginLink = '<a href="' . BASE_URL . '/login">Login</a>';
        $logoutLink = '<a href="' . BASE_URL . '/logout">Logout</a>';

        switch ($headerLocation) {
            case \App\Datatypes\HeaderlocationEnum::ADMIN:
                $html .= $adminBooksLink;
                $html .= $adminCustomersLink;
                $html .= $adminInfoLink;
                $html .= $logoutLink;
                break;
            case \App\Datatypes\HeaderlocationEnum::ADMIN_BOOKS:
                $html .= $adminLink;
                $html .= $adminCustomersLink;
                $html .= $newBookLink;
                $html .= $adminInfoLink;
                $html .= $logoutLink;
                break;
            case \App\Datatypes\HeaderlocationEnum::ADMIN_CUSTOMERS:
                $html .= $adminLink;
                $html .= $adminBooksLink;
                $html .= $newCustomerLink;
                $html .= $adminInfoLink;
                $html .= $logoutLink;
                break;
            case \App\Datatypes\HeaderlocationEnum::ADMIN_INFO:
                $html .= $adminLink;
                $html .= $adminBooksLink;
                $html .= $adminCustomersLink;
                $html .= $logoutLink;
                break;
            case \App\Datatypes\HeaderlocationEnum::CRUD:
                $html .= $adminLink;
                $html .= $logoutLink;
                break;
            case \App\Datatypes\HeaderlocationEnum::CRUD_BOOK:
                $html .= $adminBooksLink;
                $html .= $newBookLink;
                $html .= $adminInfoLink;
                $html .= $logoutLink;
                break;
            case \App\Datatypes\HeaderlocationEnum::CRUD_CUSTOMER:
                $html .= $adminCustomersLink;
                $html .= $newCustomerLink;
                $html .= $adminInfoLink;
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
