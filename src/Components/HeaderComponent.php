<?php
namespace App\Components;

class HeaderComponent
{
    public static function render(
        \App\Datatypes\HeaderlocationEnum $headerLocation = \App\Datatypes\HeaderlocationEnum::MINIMAL,
        string             $title = "",
        string             $sort = "title",
        string             $dir = "asc",
        string             $search = "",
    ): void
    {
        $html = <<<HTML
        <h1 class='page-title'><a href='
        HTML;

        $html .= BASE_URL . "/home";

        $html .= <<<HTML
        '>Bücher Antiquariat</a></h1>
        <hr>
        <nav class="navbar">
            <ul class="horizontal-list">
        HTML;

        switch ($headerLocation) {
            case \App\Datatypes\HeaderlocationEnum::ADMIN:
                $html .= LinklistComponent::element(\App\Datatypes\HeaderlocationEnum::ADMIN);
                break;
            case \App\Datatypes\HeaderlocationEnum::ADMIN_BOOKS:
                $html .= SortComponent::element(
                    BASE_URL . "/admin/books",
                    [
                        "id" => "ID",
                        "katalog" => "Katalog",
                        "nummer" => "Nummer",
                        "title" => "Titel",
                        "autor" => "Autor",
                        "zustand" => "Zustand",
                    ],
                    $sort,
                    $dir,
                    [
                        "search" => $search,
                    ],
                );
                $html .= SearchComponent::element(
                    BASE_URL . "/admin/books",
                    $search,
                    [
                        "sort" => $sort,
                        "dir" => $dir,
                    ],
                );
                $html .= LinklistComponent::element(\App\Datatypes\HeaderlocationEnum::ADMIN_BOOKS);
                break;
            case \App\Datatypes\HeaderlocationEnum::ADMIN_CUSTOMERS:
                $html .= SortComponent::element(
                    BASE_URL . "/admin/customers",
                    [
                        "kid" => "KID",
                        "geburtstag" => "Geburtstag",
                        "vorname" => "Vorname",
                        "name" => "Name",
                        "geschlecht" => "Geschlecht",
                        "kunde_seit" => "Kunde seit",
                        "email" => "E-Mail",
                        "kontaktpermail" => "Kontakt per Mail",
                    ],
                    $sort,
                    $dir,
                    [
                        "search" => $search,
                    ],
                );
                $html .= SearchComponent::element(
                    BASE_URL . "/admin/customers",
                    $search,
                    [
                        "sort" => $sort,
                        "dir" => $dir,
                    ],
                );
                $html .= LinklistComponent::element(\App\Datatypes\HeaderlocationEnum::ADMIN_CUSTOMERS);
                break;
            case \App\Datatypes\HeaderlocationEnum::ADMIN_INFO:
                $html .= LinklistComponent::element(\App\Datatypes\HeaderlocationEnum::ADMIN_INFO);
                break;
            case \App\Datatypes\HeaderlocationEnum::CRUD:
                $html .= LinklistComponent::element(\App\Datatypes\HeaderlocationEnum::CRUD);
                break;
            case \App\Datatypes\HeaderlocationEnum::CRUD_BOOK:
                $html .= LinklistComponent::element(\App\Datatypes\HeaderlocationEnum::CRUD_BOOK);
                break;
            case \App\Datatypes\HeaderlocationEnum::CRUD_CUSTOMER:
                $html .= LinklistComponent::element(\App\Datatypes\HeaderlocationEnum::CRUD_CUSTOMER);
                break;
            case \App\Datatypes\HeaderlocationEnum::DETAIL:
                $html .= LinklistComponent::element(\App\Datatypes\HeaderlocationEnum::DETAIL);
                break;
            case \App\Datatypes\HeaderlocationEnum::HOME:
                $html .= SortComponent::element(
                    BASE_URL . "/home",
                    [
                        "title" => "Titel",
                        "autor" => "Autor",
                        "zustand" => "Zustand",
                    ],
                    $sort,
                    $dir,
                );
                $html .= SearchComponent::element(BASE_URL . "/search");
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
                $html .= SortComponent::element(
                    BASE_URL . "/search",
                    [
                        "title" => "Titel",
                        "autor" => "Autor",
                        "zustand" => "Zustand",
                    ],
                    $sort,
                    $dir,
                    [
                        "search" => $search,
                    ],
                );
                $html .= SearchComponent::element(
                    BASE_URL . "/search",
                    $search,
                    [
                        "sort" => $sort,
                        "dir" => $dir,
                    ],
                );
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
