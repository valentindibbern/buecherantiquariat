# Architektur

## Ordnerstruktur

- `assets`: SQL-Dump und statische Ressourcen
- `src/controllers`: Ablaufsteuerung pro Route
- `src/models`: Datenzugriff
- `src/views`: Seitenrendering
- `src/components`: wiederverwendete HTML-Bausteine
- `src/datatypes`: Enums fuer Zustands- und Kategoriewerte
- `styles.css`: globales Stylesheet im Projektwurzelverzeichnis

## Architekturstil

Die Anwendung folgt einer einfachen MVC-aehnlichen Struktur:

- Controller koordinieren den Ablauf
- Models kapseln den direkten Datenbankzugriff
- Views und Components erzeugen HTML

Die Trennung ist pragmatisch, aber nicht strikt. HTML-Erzeugung ist ueber Views und Components verteilt, und Teile des Seitenrahmens werden mehrfach aufgebaut.

## Controller

### MainController

`src/controllers/MainController.php` ist der zentrale Bootstrapping-Punkt innerhalb der Anwendung.

Aufgaben:

- Aufbau der Datenbankverbindung ueber `ConfigurationController`
- Instanziierung der Feature-Controller
- Registrierung der Routen
- Starten des Dispatches ueber den `RouteController`

### RouteController

`src/controllers/RouteController.php` verwaltet ein einfaches Array aus Pfad und Handler.

Besonderheiten:

- kein HTTP-Method-Routing
- keine Middleware
- keine Fehlerseiten
- Basispfad `/buecherantiquariat` ist fest im Code hinterlegt
- unbekannte Routen werden direkt als Text ausgegeben

### Feature-Controller

- `src/controllers/KachelController.php`: laedt eine Seite des Buchkatalogs
- `src/controllers/SearchController.php`: fuehrt Volltextsuche ueber einige Felder aus
- `src/controllers/DetailController.php`: laedt ein einzelnes Buch per ID

## Model

`src/models/BookModel.php` enthaelt den Kern des Datenzugriffs.

Vorhandene Methoden:

- `getTotalPages($conn)`: berechnet Seitenanzahl bei 18 Eintraegen pro Seite
- `getBooksByPage($conn, $page, $sort, $dir)`: laedt eine Seite von Datensaetzen mit einfacher Sortierung
- `getBookById($conn, $id)`: laedt einen einzelnen Datensatz
- `searchBooks($conn, $query)`: sucht in `Title`, `autor` und `zustand`

## Views und Components

Die Seiten bestehen aus Views, die wiederum Components verwenden.

Views:

- `src/views/KachelView.php`
- `src/views/SearchView.php`
- `src/views/DetailView.php`

Components:

- `src/components/HeaderComponent.php`
- `src/components/FooterComponent.php`
- `src/components/KachelComponent.php`
- `src/components/PaginatorComponent.php`

## Datenbankverbindung

`src/controllers/ConfigurationController.php` liest `.env.local` zeilenweise ein und baut daraus die `mysqli`-Verbindung.

Aktiv ausgewertet werden aktuell:

- `DB_HOST`
- `DB_USER`
- `DB_PASSWORD`
- `DB_NAME`

Hinweise zum Ist-Zustand:

- `.env.local` liegt im Projektwurzelverzeichnis
- `DB_PORT` ist laut Setup vorhanden, wird aber aktuell nicht an `mysqli` weitergegeben
- `ConfigurationController` ruft beim Start `CookieModel::configureMaxPages()` auf

## Enums und Domaintypen

Unter `src/datatypes` gibt es drei Enums:

- `src/datatypes/ZustandEnum.php`
- `src/datatypes/VerkauftEnum.php`
- `src/datatypes/KategorieEnum.php`

Sie wandeln interne Werte in lesbare Labels um. Aktiv genutzt werden aktuell vor allem `ZustandEnum` und `VerkauftEnum`.

`KategorieEnum` ist vorhanden, wird im aktuellen Rendering der Seiten aber nicht aktiv zur Label-Ausgabe verwendet.
