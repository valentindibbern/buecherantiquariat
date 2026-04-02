# Bekannte Auffaelligkeiten

Diese Punkte sind keine neuen Anforderungen, sondern Beobachtungen aus der aktuellen Codebasis.

## Rendering-Struktur

- Views erzeugen bereits `<!DOCTYPE html>`, `<html>`, `<head>` und `<body>`.
- `src/components/HeaderComponent.php` erzeugt ebenfalls erneut ein komplettes HTML-Dokumentgeruest.
- `src/components/FooterComponent.php` schliesst ebenfalls `</body>` und `</html>`.

Das fuehrt strukturell zu doppelten HTML-Tags.

## Stylesheet-Pfade

- Die Views referenzieren `styles.css`.
- Der Header referenziert stattdessen `src/css/styles.css`, `src/css/input.css` und `src/css/output.css`.

Aus dem aktuellen Repository ist nur `styles.css` sichtbar. Die im Header referenzierten CSS-Dateien sind in der aktuellen Struktur nicht vorhanden.

## Cookie fuer Paginierung

- `MainController` setzt `totalPages` per Cookie.
- `KachelView` liest den Wert direkt aus `$_COOKIE`.

Das koppelt Rendering an Client-Zustand, obwohl die Information serverseitig bereits bekannt ist.

## Harte Konfiguration

- Basispfad `/buecherantiquariat` ist fest im `RouteController` hinterlegt.
- Datenbankzugang ist fest in `DBConnection` hinterlegt.

Das erschwert Deployment auf andere Umgebungen.

## Codequalitaet

- Schreibweise `querry` in `SearchController` ist inkonsistent.
- In `MainController` existiert die ungenutzte Variable `$altconn`.
- `src/datatypes/KategorieEnum.php` wird im aktuellen Rendering kaum oder gar nicht aktiv genutzt.
- Unbekannte Routen liefern nur einfachen Text statt einer HTTP-Fehlerseite.

## Suchumfang

- Die Suche ist auf `Title`, `autor` und `zustand` begrenzt.
- `Beschreibung` wird trotz zentraler fachlicher Relevanz nicht durchsucht.

## Datenquelle

Der SQL-Dump nennt als Datenbank `bookstest`, waehrend der Anwendungscode `books` verwendet. Das sollte bei Setup oder Migrationen beachtet werden.
