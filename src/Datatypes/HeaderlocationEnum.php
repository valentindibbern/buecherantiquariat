<?php
declare(strict_types=1);

namespace App\Datatypes;

enum HeaderlocationEnum: string
{
    case ADMIN = "admin";
    case ADMIN_BOOKS = "admin_books";
    case ADMIN_CUSTOMERS = "admin_customers";
    case ADMIN_INFO = "admin_info";
    case CRUD = "crud";
    case CRUD_BOOK = "crud_book";
    case CRUD_CUSTOMER = "crud_customer";
    case DETAIL = "detail";
    case HOME = "home";
    case LOGIN = "login";
    case MINIMAL = "minimal";
    case SEARCH = "search";
}
