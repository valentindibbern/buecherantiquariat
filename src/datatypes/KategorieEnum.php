<?php
declare(strict_types=1);

enum KategorieEnum: int
{
    case BIBELN = 1;
    case GEOGRAPHIE = 2;
    case GESCHICHTSWISSENSAFTEN = 3;
    case NATURWISSENSCHAFTEN = 4;
    case KINDERBUECHER = 5;
    case MODERNELITERATUR = 6;
    case MODERNEKUNST = 7;
    case KUNSTWISSENSCHAFTEN = 8;
    case ARCHITEKTUR = 9;
    case TECHNIK = 10;
    case MEDIZIN = 11;
    case OZEANIEN = 12;
    case AFRIKA = 13;
    case OLDBOOKS = 14;

    public function label(): string
    {
        return match ($this) {
            self::BIBELN
                => "Alte Drucke, Bibeln, Klassische Autoren in den Originalsprachen",
            self::GEOGRAPHIE => "Geographie und Reisen",
            self::GESCHICHTSWISSENSAFTEN => "Geschichtswissenschaften",
            self::NATURWISSENSCHAFTEN => "Naturwissenschaften",
            self::KINDERBUECHER => "Kinderbücher",
            self::MODERNELITERATUR => "Moderne Literatur und Kunst",
            self::MODERNEKUNST => "Moderne Kunst und Künstlergraphik",
            self::KUNSTWISSENSCHAFTEN => "Kunstwissenschaften",
            self::ARCHITEKTUR => "Architektur",
            self::TECHNIK => "Technik",
            self::MEDIZIN => "Naturwissenschaften - Medizin",
            self::OZEANIEN => "Ozeanien",
            self::AFRIKA => "Afrika",
            self::OLDBOOKS => "Old Books",
        };
    }
}

?>
