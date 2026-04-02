# Architektur

## Ordnerstruktur

- `assets`: SQL-Dump und statische Ressourcen
- `src/controllers`: Ablaufsteuerung pro Route
- `src/models`: Datenzugriff
- `src/views`: Seitenrendering
- `src/components`: wiederverwendete HTML-Bausteine
- `src/datatypes`: Enums fuer Zustands- und Kategoriewerte
- `src/unique`: technische Querschnittsklassen wie Datenbankverbindung

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

- Aufbau der Datenbankverbindung
- Instanziierung der Feature-Controller
- Registrierung der Routen
- Setzen des Cookies `totalPages`

### RouteController

`src/controllers/RouteController.php` verwaltet ein einfaches Array aus Pfad und Handler.

Besonderheiten:

- kein HTTP-Method-Routing
- keine Middleware
- keine Fehlerseiten
- unbekannte Routen werden direkt als Text ausgegeben

### Feature-Controller

- `src/controllers/KachelController.php`: laedt eine Seite des Buchkatalogs
- `src/controllers/SearchController.php`: fuehrt Volltextsuche ueber einige Felder aus
- `src/controllers/DetailController.php`: laedt ein einzelnes Buch per ID

## Model

`src/models/BookModel.php` enthaelt den Kern des Datenzugriffs.

Vorhandene Methoden:

- `getTotalPages($conn)`: berechnet Seitenanzahl bei 18 Eintraegen pro Seite
- `getBooksByPage($conn, $page)`: laedt eine Seite von Datensaetzen
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

`src/unique/DBConnection.php` kapselt den `mysqli`-Connect.

Fest im Code hinterlegt sind aktuell:

- Host: `127.0.0.1`
- Datenbank: `books`
- Benutzer: `root`
- Passwort: leer
- Port: `3307`

## Enums und Domaintypen

Unter `src/datatypes` gibt es drei Enums:

- `src/datatypes/ZustandEnum.php`
- `src/datatypes/VerkauftEnum.php`
- `src/datatypes/KategorieEnum.php`

Sie wandeln interne Werte in lesbare Labels um. Aktiv genutzt werden aktuell vor allem `ZustandEnum` und `VerkauftEnum`.
