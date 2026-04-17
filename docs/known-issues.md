# Bekannte Auffaelligkeiten

Diese Punkte sind keine neuen Anforderungen, sondern Beobachtungen aus der aktuellen Codebasis.

## Rendering-Struktur

- Views erzeugen bereits `<!DOCTYPE html>`, `<html>`, `<head>` und `<body>`.
- `HeaderComponent::render()` erwartet drei Parameter: `title`, `sort`, `dir`.
- `DetailView` und `SearchView` rufen `HeaderComponent::render()` aktuell nur mit dem Titel auf.

Das fuehrt auf Seiten ausserhalb der Katalogansicht zu einem Laufzeitfehler durch zu wenige Argumente.

## Sort-UI im Header

- In `src/components/HeaderComponent.php` stehen die `selected`-Markierungen als Ausdruck in der Heredoc-Ausgabe.
- Diese Ausdruecke werden dort nicht als PHP ausgewertet.

Die aktuelle Sortierauswahl wird deshalb im Markup nicht korrekt als ausgewaehlt markiert.

## Stylesheet-Pfade

- Die Views referenzieren `styles.css`.

Im aktuellen `master` ist nur dieses Stylesheet vorhanden. Ein separates `src/css/*`-Setup existiert hier nicht.

## Cookie fuer Paginierung

- `ConfigurationController` setzt die Seitenzahl ueber `CookieModel` per Cookie.
- `RouteController` liest die Gesamtseitenzahl fuer `/` und `/home` ueber `CookieModel::getMaxPages()` erneut aus.

Das koppelt Routing und Rendering an Client-Zustand, obwohl die Information serverseitig bereits bekannt ist.

## Harte Konfiguration

- Basispfad `/buecherantiquariat` ist fest im `RouteController` hinterlegt.
- `DB_PORT` aus `.env.local` wird aktuell ignoriert.

Das erschwert Deployment auf andere Umgebungen.

## Codequalitaet

- Schreibweise `querry` in `SearchController` ist inkonsistent.
- `RouteController::configureRoutes()` deklariert `use ($outerConnection)`, nutzt die Variable in den Closures aber nicht.
- `MainController` uebergibt die Verbindung mehrfach weiter, obwohl sie in den Feature-Controllern bereits gespeichert ist.
- `src/datatypes/KategorieEnum.php` wird im aktuellen Rendering kaum oder gar nicht aktiv genutzt.
- Unbekannte Routen liefern nur einfachen Text statt einer HTTP-Fehlerseite.

## Suchumfang

- Die Suche ist auf `Title`, `autor` und `zustand` begrenzt.
- `Beschreibung` wird trotz zentraler fachlicher Relevanz nicht durchsucht.

## Datenquelle

Der SQL-Dump nennt als Datenbank `bookstest`, waehrend der Anwendungscode den Namen aus `.env.local` liest. Das sollte bei Setup oder Migrationen beachtet werden.
