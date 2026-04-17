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

Der Anwendungscode liest die Verbindungsdaten aktuell aus der Datei `.env.local` im Projektwurzelverzeichnis. Eingelesen werden sie in `src/controllers/ConfigurationController.php`.

Erwartete Schluessel:

- `DB_HOST`
- `DB_USER`
- `DB_PASSWORD`
- `DB_NAME`
- `DB_PORT` ist in der lokalen Konfiguration moeglich, wird vom aktuellen Code aber nicht verwendet

## SQL-Import

Die vorhandene SQL-Datei liegt in `assets/books.sql`.

Wichtig:

- Der SQL-Dump nennt als Datenbank an mindestens einer Stelle `bookstest`.
- Der Anwendungscode verbindet sich mit dem in `.env.local` gesetzten `DB_NAME`.

Fuer einen funktionierenden lokalen Start sollten Datenbankname im Import und im Anwendungscode zusammenpassen. Der einfachste Weg ist meist:

1. Eine Datenbank anlegen, deren Name zu `DB_NAME` in `.env.local` passt.
2. Den Dump `assets/books.sql` importieren.
3. Falls der Dump auf `bookstest` festgelegt ist, den Datenbanknamen vor dem Import anpassen oder den Import gezielt in die konfigurierte Datenbank ausfuehren.

## Startpruefung

Wenn Apache und Datenbank laufen, sollten diese Seiten erreichbar sein:

- `http://localhost/buecherantiquariat/`
- `http://localhost/buecherantiquariat/home`
- `http://localhost/buecherantiquariat/search?search=test`
- `http://localhost/buecherantiquariat/detail?id=1`

## Typische Stolpersteine

- Apache laeuft, aber Rewrite greift nicht: `mod_rewrite` oder `.htaccess` wird nicht angewendet.
- Datenbankverbindung scheitert: `.env.local` fehlt, ist unvollstaendig oder enthaelt abweichende Werte.
- Abweichender MySQL-Port: `DB_PORT` ist zwar in der Konfiguration moeglich, wird im aktuellen Code aber nicht an `mysqli` weitergegeben.
- Leere oder fehlerhafte Ausgabe: Die in `DB_NAME` konfigurierte Datenbank wurde nicht importiert oder enthaelt nicht die erwarteten Tabellen.
- Aufruf von `/detail` oder `/search` kann aktuell an der `HeaderComponent`-Signatur scheitern.

## Empfehlung fuer spaeter

Fuer kuenftige Weiterentwicklung sollten mindestens diese Werte konfigurierbar gemacht werden:

- Basispfad
- konsistente Nutzung der vorhandenen Datenbankvariablen inklusive `DB_PORT`
