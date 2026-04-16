<?php
declare(strict_types=1);

class CookieModel
{
    public static function configureMaxPages(mysqli $connection): void
    {
        self::setMaxPages($connection);
    }

    public static function refreshMaxPages(): void
    {
        if (isset($_COOKIE["__Secure-maxPages"])) {
            $this->setMaxPages();
        }
    }

    public static function isMaxPages(): bool
    {
        return isset($_COOKIE["__Secure-maxPages"]);
    }

    public static function setMaxPages(mysqli $connection): bool
    {
        return setcookie(
            "__Secure-maxPages",
            (string) BookModel::getTotalPages($connection),
            600,
            "/",
            "",
            true,
            true,
        );
    }

    public static function getMaxPages(): ?int
    {
        return $_COOKIE["__Secure-maxPages"] ?? null;
    }
}

?>
