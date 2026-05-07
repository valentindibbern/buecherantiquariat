# Admin-, Table- und CRUD-Implementierung

## Ziel

Diese Erweiterung ergänzt den bestehenden Admin-Bereich um drei zusammenhängende Teile:

- eine kleine Admin-Auswahl unter `/admin`
- eine Tabellenansicht für Bücher unter `/admin/books`
- eine Tabellenansicht für Kunden unter `/admin/customers`

Zusätzlich wurden zwei CRUD-Seiten umgesetzt:

- `/crud/book`
- `/crud/customer`

Die Umsetzung bleibt bewusst nah an der bestehenden Projektstruktur:

- Controller koordinieren den Ablauf
- Models kapseln SQL-Zugriffe
- Views erzeugen das HTML direkt
- Components bleiben klein und fokussiert

Es wurde absichtlich keine generische CRUD- oder Admin-Abstraktion eingeführt, damit sich der neue Code möglichst ähnlich zum bestehenden Code liest.

## Überblick über den Ablauf

### Admin-Auswahl

Die Route `/admin` ist jetzt keine Buch-Tabelle mehr, sondern eine kleine Auswahlseite. Von dort aus gelangt man zu:

- Bücherverwaltung
- Kundenverwaltung
- PHP-Info

Die Auswahl wird weiter über `AdminController` und `AdminView` gerendert.

### Bücherverwaltung

Die Route `/admin/books` lädt:

- Suchbegriff aus `$_GET["search"]`
- Sortierspalte aus `$_GET["sort"]`
- Sortierrichtung aus `$_GET["dir"]`

Danach ruft `BookAdminController` die neue Model-Methode `BookModel::getAdminBooks()` auf und übergibt das Ergebnis an `BookAdminView`.

Die View rendert:

- Suchformular
- Tabellenkopf mit Sortierlinks
- alle Datensätze ohne Pagination
- Bearbeiten-Link pro Zeile

### Kundenverwaltung

Die Route `/admin/customers` funktioniert analog. `CustomerAdminController` liest die Query-Parameter, lädt die Daten über `CustomerModel::getAllCustomers()` und rendert sie über `CustomerAdminView`.

Auch hier gibt es:

- Suche
- Sortierung
- keine Pagination
- Bearbeiten-Link pro Zeile

### Buch-CRUD

Die Route `/crud/book` arbeitet abhängig von der Request-Methode:

- `GET`
  - mit `id`: Datensatz laden und bearbeiten
  - ohne `id` bzw. mit `create=1`: leeres Formular für neuen Datensatz
- `POST`
  - ohne `delete`: speichern
  - mit `delete`: löschen

Der Ablauf bleibt im bestehenden `CRUDController`.

### Kunden-CRUD

Die Route `/crud/customer` arbeitet gleich, aber mit eigener Klasse `CustomerCrudController` und eigenem Model `CustomerModel`.

## Geänderte bestehende Dateien

## `src/Datatypes/HeaderlocationEnum.php`

Erweitert um zusätzliche Header-Kontexte:

- `ADMIN_BOOKS`
- `ADMIN_CUSTOMERS`
- `ADMIN_INFO`
- `CRUD_BOOK`
- `CRUD_CUSTOMER`

Warum:

Die Linkliste muss je nach Admin-/CRUD-Seite andere Links anzeigen. Das bestehende Enum war dafür zu grob.

## `src/Components/LinklistComponent.php`

Erweitert um neue Links:

- Bücher
- Kunden
- Info
- Neues Buch
- Neuer Kunde

Zusätzlich wurden neue `switch`-Fälle eingebaut, damit jede Admin- und CRUD-Seite eine passende Navigation bekommt.

Warum:

Die Linkliste war bisher nur auf öffentliche Seiten, Login und das alte Admin-/CRUD-Minimum ausgelegt.

## `src/Components/HeaderComponent.php`

Erweitert um die neuen `HeaderlocationEnum`-Fälle.

Warum:

Der Header soll die neuen Linklisten-Kontexte rendern können, ohne die bestehende Component-Struktur zu verlassen.

## `src/Controllers/AdminController.php`

Die Klasse rendert jetzt nur noch die Admin-Auswahlseite.

Warum:

`/admin` soll laut Anforderung eine Auswahlseite sein und nicht mehr direkt die Buch-Tabelle.

## `src/Controllers/CRUDController.php`

Die Klasse wurde von einer reinen Render-Klasse auf einen echten Buch-CRUD-Controller erweitert.

Neu:

- sauberes Laden eines leeren Formulars oder eines vorhandenen Datensatzes
- `handlePost()` für:
  - Create
  - Update
  - Delete

Warum:

Vorher konnte die Seite nur Buchdaten anzeigen, aber nichts speichern oder löschen.

## `src/Controllers/MainController.php`

Erweitert um neue Controller-Instanzen:

- `BookAdminController`
- `CustomerAdminController`
- `CustomerCrudController`

Warum:

Die neuen Routen brauchen eigene, klar benannte Einstiegspunkte.

## `src/Controllers/RouteController.php`

Hier liegt der zentrale Routing-Ausbau.

Neu hinzugefügt:

- `/admin/books`
- `/admin/customers`
- `/admin/info`
- `/crud/book`
- `/crud/customer`

Entfernt:

- öffentliches `/info`

Wichtig:

Alle Admin- und CRUD-Routen prüfen weiterhin direkt in der Route, ob `$_SESSION["authenticated"]` gesetzt ist.

Warum:

Das entspricht dem bisherigen Berechtigungsstil und verändert die Architektur nicht unnötig.

## `src/Models/BookModel.php`

Erweitert um:

- `getAdminBooks()`
- `createBook()`
- `updateBook()`
- `deleteBook()`

### `getAdminBooks()`

Diese Methode ist nur für die Admin-Tabelle gedacht.

Sie macht:

- Suche über:
  - `id`
  - `nummer`
  - `Title`
  - `autor`
  - `Beschreibung`
- Sortierung über Whitelist
- keine Pagination

Warum nicht `getAllBooks()` wiederverwenden:

`getAllBooks()` bietet keine Suche und keine Sortierung. Für die Admin-Tabelle war daher eine zusätzliche Methode nötig.

### `createBook()`

Legt einen neuen Buch-Datensatz an.

Wichtig:

`id` wird nicht eingefügt, weil `buecher.id` im Dump `AUTO_INCREMENT` ist.

### `updateBook()`

Aktualisiert einen vorhandenen Datensatz über `WHERE id = ?`.

### `deleteBook()`

Löscht einen Datensatz anhand seiner `id`.

## `src/Views/AdminView.php`

Von einer Buch-Tabelle zu einer Auswahlseite umgebaut.

Sie zeigt jetzt nur noch drei Einstiegspunkte:

- Bücher verwalten
- Kunden verwalten
- PHP Info

Warum:

Das entspricht direkt der neuen Anforderung für `/admin`.

## `src/Views/CRUDView.php`

Die bestehende Buch-CRUD-View wurde funktional gemacht.

Neu:

- `<!DOCTYPE html>`
- Header mit passender CRUD-Navigation
- echtes `POST`-Formular
- Hidden-Feld für `id`
- Save-Button
- Delete-Button nur im Bearbeiten-Modus
- leere Defaults für Create-Modus

Warum:

Vorher war die View nur ein statischer Formularentwurf ohne echten Request-Flow.

## Neue Dateien

## `src/Controllers/BookAdminController.php`

Aufgabe:

- Query-Parameter der Buch-Tabelle entgegennehmen
- Daten über `BookModel::getAdminBooks()` laden
- `BookAdminView` rendern

Warum eigene Klasse:

`AdminController` wurde für die Auswahlseite gebraucht. Die Bücherliste sollte einen eigenen Controller bekommen, statt die Auswahlseite und die Tabelle zu vermischen.

## `src/Controllers/CustomerAdminController.php`

Analog zu `BookAdminController`, aber für `kunden`.

## `src/Controllers/CustomerCrudController.php`

Eigenständiger CRUD-Controller für Kunden.

Aufgaben:

- Kundendatensatz laden
- Kundendatensatz speichern
- Kundendatensatz löschen
- Redirect zurück auf `/admin/customers`

Warum eigene Klasse:

Kunden haben andere Felder und andere SQL-Struktur. Eine Vermischung mit dem Buch-CRUD hätte die Logik unnötig kompliziert gemacht.

## `src/Models/CustomerModel.php`

Neue Model-Klasse für die Tabelle `kunden`.

Umgesetzte Methoden:

- `getAllCustomers()`
- `getCustomerById()`
- `createCustomer()`
- `updateCustomer()`
- `deleteCustomer()`

### `getAllCustomers()`

Sucht in:

- `kid`
- `vorname`
- `name`
- `email`

Sortiert per Whitelist über:

- `kid`
- `geburtstag`
- `vorname`
- `name`
- `geschlecht`
- `kunde_seit`
- `email`
- `kontaktpermail`

Warum:

Die Kundenverwaltung braucht dieselben Bedienmuster wie die Bücherverwaltung, aber auf einer eigenen Tabelle.

### `createCustomer()`

Fügt einen neuen Kunden ein.

Wichtig:

`kid` wird explizit mitgegeben, weil für `kunden.kid` im Dump kein `AUTO_INCREMENT` definiert ist.

### `updateCustomer()`

Aktualisiert den Datensatz anhand der `kid`.

### `deleteCustomer()`

Löscht den Datensatz anhand der `kid`.

## `src/Views/BookAdminView.php`

Neue View für die Buch-Tabelle.

Funktionen:

- Suchformular
- Sortierlinks im Tabellenkopf
- Table-Look
- Bearbeiten-Link je Datensatz
- keine Pagination

Zusätzlich werden zwei bestehende Enums genutzt, um Rohwerte lesbarer darzustellen:

- `VerkauftEnum`
- `ZustandEnum`

Warum:

Die bisherige `AdminView` wurde für die Admin-Auswahl frei gemacht. Die Buch-Tabelle braucht jetzt eine eigene View.

## `src/Views/CustomerAdminView.php`

Neue View für die Kunden-Tabelle.

Funktionen:

- Suchformular
- Sortierlinks
- Bearbeiten-Link
- keine Pagination

Spalten:

- `kid`
- `geburtstag`
- `vorname`
- `name`
- `geschlecht`
- `kunde_seit`
- `email`
- `kontaktpermail`

## `src/Views/CustomerCRUDView.php`

Neue CRUD-View für Kunden.

Felder:

- `kid`
- `geburtstag`
- `vorname`
- `name`
- `geschlecht`
- `kunde_seit`
- `email`
- `kontaktpermail`

Hier wurden zwei kleine Ausnahmen zur besseren Bedienbarkeit eingebaut:

- `geschlecht` als Select (`M` / `F`)
- `kontaktpermail` als Select (`Ja` / `Nein`)

Warum:

Diese beiden Felder haben eine sehr kleine feste Wertemenge und lassen sich so robuster erfassen.

## CSS-Anpassungen

Für die neuen Seiten kann es sinnvoll sein, zusätzliches Styling zu pflegen:

- Toolbar oberhalb der Tabellen
- Breiten/Umbruch für lange Beschreibungen
- Formular-Layout für CRUD-Seiten
- Listenlayout der Admin-Auswahl

Wenn weitere visuelle Anpassungen nötig sind, sollten sie in `public/css/styles.css` ergänzt werden.

## Authentifizierung und Berechtigung

Ein zentraler Teil der Anforderungen war, dass Änderungen am `RouteController` die Berechtigungsprüfung nicht aufweichen dürfen.

Deshalb wurde kein neuer Auth-Helper eingeführt.

Stattdessen bleibt der Stil konsistent:

- jede Admin-Route prüft `$_SESSION["authenticated"]`
- bei fehlender Session wird auf `/login` weitergeleitet

Betroffene Routen:

- `/admin`
- `/admin/books`
- `/admin/customers`
- `/admin/info`
- `/crud/book`
- `/crud/customer`

## Warum keine Pagination

Die Admin-Tabellen wurden bewusst ohne Pagination umgesetzt, weil dies explizit gefordert war.

Das bedeutet:

- alle Treffer werden direkt geladen
- Suche und Sortierung laufen vollständig serverseitig
- `PaginatorComponent` bleibt für die öffentliche Kachelansicht unverändert bestehen

## Warum `/info` jetzt nur noch unter `/admin/info` liegt

Die Info-Seite ist ein technisches Admin-Werkzeug. Deshalb wurde das öffentliche `/info` entfernt und in den geschützten Admin-Bereich verschoben.

Der Zugriff erfolgt jetzt über:

- die Admin-Auswahlseite
- die Admin-Linkliste

## Weiterer sinnvoller nächster Schritt

Wenn du später refactoren willst, sind diese drei nächsten Schritte sinnvoll, aber für diese Implementierung bewusst noch nicht umgesetzt:

- gemeinsame kleine Helper für Sortierlinks
- gemeinsame kleine Helper für `htmlspecialchars`
- gemeinsame Basislogik für Admin-Suchformulare

Für den jetzigen Stand wäre das aber schon Refactoring und nicht mehr die minimal-invasive Umsetzung.
