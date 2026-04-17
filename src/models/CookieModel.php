<?php
declare(strict_types=1);

class CookieModel
{
    private static $maxPagesName = "__Secure-maxPages";

    public static function configureMaxPages(mysqli $connection): void
    {
        self::setMaxPages($connection);
    }

    public static function refreshMaxPages(mysqli $connection): int
    {
        if (!isset($_COOKIE[static::$maxPagesName])) {
            return self::setMaxPages($connection);
        }

        return self::getMaxPages($connection);
    }

    public static function isMaxPages(): bool
    {
        return isset($_COOKIE[static::$maxPagesName]);
    }

    public static function setMaxPages(mysqli $connection): int
    {
        $maxPages = BookModel::getTotalPages($connection);
        setcookie(
            static::$maxPagesName,
            (string) $maxPages,
            600,
            "/",
            "",
            true,
            true,
        );
        return $maxPages;
    }

    public static function getMaxPages(mysqli $connection): int
    {
        return self::refreshMaxPages($connection);
    }
}

?>
