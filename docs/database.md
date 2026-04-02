# Datenbank

## Quelle

Die vorhandene SQL-Struktur liegt in `assets/books.sql`.

## Aktive Anwendungsdaten

Die Anwendung arbeitet derzeit direkt mit der Tabelle `buecher`.

Wichtige Felder aus dem Code:

- `id`: Primarschluessel des Buchs
- `katalog`: Katalognummer
- `nummer`: laufende Nummer
- `Title`: Titel
- `kategorie`: numerische Kategorie
- `verkauft`: Verkaufsstatus
- `kaufer`: Referenz auf einen Kaeufer
- `autor`: Autor oder Kurzbezeichnung
- `Beschreibung`: Langbeschreibung
- `foto`: Bildpfad
- `verfasser`: weitere Kennzeichnung
- `zustand`: Kurzcode fuer Erhaltungszustand

## Tabellen aus dem Dump

Im Dump sind mindestens diese Tabellen sichtbar:

- `buecher`
- `benutzer`

Im aktuellen PHP-Code wird aber nur `buecher` verwendet.

## Query-Verhalten

`src/models/BookModel.php` fuehrt vier Query-Typen aus:

- Gesamtanzahl aller Buecher
- Seitenweise Laden mit `LIMIT` und `OFFSET`
- Laden eines Buchs per ID
- Suche per `LIKE`

## Suchlogik

Die Suche prueft aktuell nur diese Spalten:

- `Title`
- `autor`
- `zustand`

Beschreibung, Kategorie und Verkaufsstatus werden in der Suche derzeit nicht beruecksichtigt.

## Seitengroesse

Die Startseiten-Paginierung geht von 18 Eintraegen pro Seite aus.
