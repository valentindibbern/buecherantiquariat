# Projektueberblick

## Zweck

`buecherantiquariat` ist eine kleine PHP-Webanwendung zur Anzeige eines Antiquariatskatalogs. Die Anwendung stellt aktuell drei Hauptfunktionen bereit:

- Startseite mit paginierter Kachelansicht von Buechern
- Suche ueber den Buchbestand
- Detailansicht einzelner Eintraege

## Technologiestand

- PHP ohne Framework
- Apache-Rewrite ueber `.htaccess`
- MySQL/MariaDB-Zugriff ueber `mysqli`
- Rendering direkt per PHP und HTML-Ausgabe
- Kein Composer, kein Template-Engine-Layer, kein API-Layer

## Einstiegspunkt

Die Anwendung startet in `index.php`.

Dort passiert Folgendes:

1. Ein einfacher Autoloader durchsucht die Unterordner von `src/`.
2. Danach wird `MainController` instanziiert.
3. Der `MainController` baut Datenbankverbindung, Controller und Routing auf.
4. Abschliessend wird der passende Request-Handler ausgefuehrt.

## Routing

Apache leitet Anfragen ueber `.htaccess` auf `index.php` um, solange keine echte Datei oder kein echtes Verzeichnis getroffen wird.

Der eigentliche Route-Dispatch liegt in `src/controllers/RouteController.php`. Die Anwendung erwartet aktuell den Basispfad `/buecherantiquariat`.

## Verfuegbare Routen

- `/` und `/home`: paginierte Uebersicht
- `/detail?id=...`: Detailansicht eines Buchs
- `/search?search=...`: Suchergebnisse

## Request-Flow

Ein typischer Request laeuft so:

1. Apache rewritet auf `index.php`.
2. `MainController` erstellt Datenbankverbindung und Controller.
3. `RouteController` reduziert den Pfad auf den internen Routenpfad.
4. Ein Feature-Controller ruft `BookModel` auf.
5. Das Ergebnis wird an eine View uebergeben.
6. Die View rendert HTML und nutzt dabei Komponenten wie Header, Footer, Kachel oder Paginator.

## Fachlicher Fokus

Im Zentrum steht die Tabelle `buecher`. Diese liefert Titel, Autor, Beschreibung, Kategorie, Verkaufsstatus, Zustand und Bildpfad fuer die Ausgabe.
