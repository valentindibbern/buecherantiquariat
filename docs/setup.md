# Lokales Setup

## Zielumgebung

Die Anwendung ist auf eine lokale XAMPP-Umgebung mit Apache und MySQL bzw. MariaDB ausgelegt.

Erwarteter Projektpfad:

- `C:\xampp\htdocs\buecherantiquariat`

Erwartete URL:

- `http://localhost/buecherantiquariat/`

## Voraussetzungen

- XAMPP mit Apache
- MySQL oder MariaDB
- PHP mit `mysqli`

## Apache

1. Lege das Projekt unter `C:\xampp\htdocs\buecherantiquariat` ab.
2. Starte Apache ueber das XAMPP Control Panel.
3. Stelle sicher, dass `mod_rewrite` aktiv ist.
4. Die Datei `.htaccess` rewritet Anfragen auf `index.php`, solange keine echte Datei oder kein echtes Verzeichnis existiert.

## Datenbank

Der Anwendungscode verwendet aktuell diese Verbindungsdaten aus `src/unique/DBConnection.php`:

- Host: `127.0.0.1`
- Port: `3307`
- Datenbankname: `books`
- Benutzer: `root`
- Passwort: leer

## SQL-Import

Die vorhandene SQL-Datei liegt in `assets/books.sql`.

Wichtig:

- Der SQL-Dump nennt als Datenbank an mindestens einer Stelle `bookstest`.
- Der Anwendungscode verbindet sich aber mit `books`.

Fuer einen funktionierenden lokalen Start sollten Datenbankname im Import und im Anwendungscode zusammenpassen. Der einfachste Weg ist meist:

1. Eine Datenbank `books` anlegen.
2. Den Dump `assets/books.sql` importieren.
3. Falls der Dump auf `bookstest` festgelegt ist, den Datenbanknamen vor dem Import anpassen oder den Import gezielt in `books` ausfuehren.

## Startpruefung

Wenn Apache und Datenbank laufen, sollten diese Seiten erreichbar sein:

- `http://localhost/buecherantiquariat/`
- `http://localhost/buecherantiquariat/home`
- `http://localhost/buecherantiquariat/search?search=test`
- `http://localhost/buecherantiquariat/detail?id=1`

## Typische Stolpersteine

- Apache laeuft, aber Rewrite greift nicht: `mod_rewrite` oder `.htaccess` wird nicht angewendet.
- Datenbankverbindung scheitert: Port `3307` stimmt lokal nicht.
- Leere oder fehlerhafte Ausgabe: Datenbank `books` wurde nicht importiert oder enthaelt nicht die erwarteten Tabellen.
- CSS wirkt unvollstaendig: Der Code referenziert teils Stylesheets, die im aktuellen Repository nicht vorhanden sind.

## Empfehlung fuer spaeter

Fuer kuenftige Weiterentwicklung sollten mindestens diese Werte konfigurierbar gemacht werden:

- Basispfad
- Datenbankname
- Datenbankport
- Datenbankbenutzer
- Datenbankpasswort
