<?php
declare(strict_types=1);

enum VerkauftEnum: int
{
    case JA = 1;
    case NEIN = 0;

    public function label(): string
    {
        return match ($this) {
            self::JA => "Ja",
            self::NEIN => "Nein",
        };
    }
}
