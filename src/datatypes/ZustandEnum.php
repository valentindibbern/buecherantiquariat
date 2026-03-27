<?php
declare(strict_types=1);

enum ZustandEnum: string
{
    case GUT = "G";
    case MITTEL = "M";
    case SCHLECHT = "S";

    public function label(): string
    {
        return match ($this) {
            self::GUT => "GUT",
            self::MITTEL => "Mittel",
            self::SCHLECHT => "Schlecht",
        };
    }
}
?>
