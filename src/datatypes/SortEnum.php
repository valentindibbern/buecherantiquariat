<?php
declare(strict_types=1);

enum SortEnum: int
{
    case AA = 1;
    case AD = 2;
    case TA = 3;
    case TD = 4;
    case ZA = 5;
    case ZD = 6;

    public function toString(): string
    {
        return match ($this) {
            self::AA => "Author Ascending",
            self::AD => "Author Descending",
            self::TA => "Title Ascending",
            self::TD => "Title Descending",
            self::ZA => "Zustand Descending",
            self::ZD => "Zustand Descending",
        };
    }

    public function toHTML(): array
    {
        return match ($this) {
            self::AA => ["autor", "ASC"],
            self::AD => ["autor", "DESC"],
            self::TA => ["Titel", "ASC"],
            self::TD => ["Titel", "DESC"],
            self::ZA => ["zustand", "ASC"],
            self::ZD => ["zustand", "DESC"],
        };
    }
}
?>
