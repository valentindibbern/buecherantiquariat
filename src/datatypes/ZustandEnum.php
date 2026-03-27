<?php
declare(strict_types=1);

enum ZustandEnum: string
{
    case Gut = "G";
    case Mittel = "M";
    case Schlecht = "S";

    public function label(): string
    {
        return match ($this) {
            self::Gut => "Gut",
            self::Mittel => "Mittel",
            self::Schlecht => "Schlecht",
        };
    }
}
?>
