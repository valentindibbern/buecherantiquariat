# Lokales Setup

## Zielumgebung

Die Anwendung ist auf eine lokale XAMPP-Umgebung mit Apache und MySQL bzw. MariaDB ausgelegt.

Erwarteter Projektpfad:

- `<XAMPP_DIR>\htdocs\buecherantiquariat`

Erwartete URL:

- `http://localhost/buecherantiquariat/`

## Voraussetzungen

- XAMPP mit Apache
- MySQL oder MariaDB
- PHP mit `mysqli`

## PHP-Version

Die Projektlaufzeit sollte sich an der PHP-Version der lokalen XAMPP-Installation orientieren, nicht an einer beliebigen `php.exe` auf dem `PATH`.

Die Anwendung verwendet in `src/datatypes/*.php` native PHP-Enums. Damit ist PHP `8.1` die fachliche Mindestversion.

Der Einstiegspunkt `index.php` bricht den Request deshalb mit HTTP `500` ab, wenn eine niedrigere PHP-Version als `8.1.0` verwendet wird.

Stand dieser Projektdokumentation: `2026-05-04`.

Unterstuetzter Bereich fuer dieses Projekt:

- mindestens PHP `8.1`
- lokales Zielsetup aktuell: PHP `8.2`

Die XAMPP-CLI liegt typischerweise unter:

- `<XAMPP_DIR>\php\php.exe`
- PHP `8.2.12`

Damit ist PHP `8.2` weiterhin die naheliegende Zielversion fuer lokale XAMPP-Windows-Setups, waehrend PHP `8.1` noch innerhalb des dokumentierten Mindestbereichs liegt.

Die PHP-Version wird im Repo nicht mehr ueber geteilte IDE-Dateien festgelegt. Die fachliche Untergrenze bleibt in `index.php` verankert, und die lokale Zielversion fuer Checks wird ueber `tools/check-php-version.php` pruefbar gemacht.

Fuer Syntaxpruefungen ist deshalb nach Moeglichkeit die XAMPP-PHP-Binaerdatei zu verwenden:

- `<XAMPP_DIR>\php\php.exe tools\check-php-version.php`
- `<XAMPP_DIR>\php\php.exe -l path\to\File.php`
- `Get-ChildItem -Recurse -Filter *.php | ForEach-Object { & <XAMPP_DIR>\php\php.exe -l $_.FullName }`

`<XAMPP_DIR>` ist das lokale Installationsverzeichnis von XAMPP. Wenn unklar ist, wo XAMPP installiert wurde, helfen meist diese Wege:

- im XAMPP Control Panel den Installationsordner oder die Pfade der Module pruefen
- im Datei-Explorer nach `xampp-control.exe` oder nach einem Ordner `xampp` suchen
- in einer Eingabeaufforderung `where php` ausfuehren und pruefen, ob die XAMPP-PHP dabei ist

## Apache

1. Lege das Projekt unter `<XAMPP_DIR>\htdocs\buecherantiquariat` ab.
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
