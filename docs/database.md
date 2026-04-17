# Datenbank

## Quelle

Die vorhandene SQL-Struktur liegt in `assets/books.sql`.

Der Dump nennt die Datenbank `bookstest`, waehrend die Anwendung den Datenbanknamen aus `.env.local` liest.

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
- Seitenweises Laden mit `ORDER BY`, `LIMIT` und `OFFSET`
- Laden eines Buchs per ID
- Suche per `LIKE`

## Sortierung

Die Katalogansicht erlaubt aktuell Sortierung ueber die Query-Parameter `sort` und `dir`.

Intern werden nur diese Spalten zugelassen:

- `Title`
- `autor`
- `zustand`

Fuer die Richtung werden nur `ASC` und `DESC` akzeptiert.

## Suchlogik

Die Suche prueft aktuell nur diese Spalten:

- `Title`
- `autor`
- `zustand`

Beschreibung, Kategorie und Verkaufsstatus werden in der Suche derzeit nicht beruecksichtigt.

## Seitengroesse

Die Startseiten-Paginierung geht von 18 Eintraegen pro Seite aus.

Die Gesamtseitenzahl wird beim Start ueber `BookModel::getTotalPages()` berechnet und anschliessend per Cookie `__Secure-maxPages` zwischengespeichert.
