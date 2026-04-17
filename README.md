# Buecherantiquariat

Kleine PHP-Anwendung fuer ein Antiquariat auf Basis einer einfachen MVC-aehnlichen Struktur.

## Einstieg

Fuer den lokalen Start mit XAMPP siehe `docs/setup.md`.

## Projektstruktur

- `index.php`: Einstiegspunkt und Autoloading
- `src/controllers`: Routing und Request-Verarbeitung
- `src/models`: Datenzugriff
- `src/views`: HTML-Ausgabe
- `src/components`: wiederverwendbare UI-Bausteine
- `src/datatypes`: Enums fuer Zustands-, Verkaufs- und Kategorienwerte
- `assets`: SQL und statische Ressourcen
- `docs`: Projektdokumentation
- `styles.css`: globales Stylesheet

## Dokumentation

Die Dokumentation beschreibt den aktuellen Ist-Zustand der bestehenden Codebasis, inklusive technischer Schulden und Inkonsistenzen.

- `docs/project-overview.md`: Produkt- und Ablaufueberblick
- `docs/architecture.md`: technische Struktur der Anwendung
- `docs/database.md`: Datenbank und aktuelle Query-Nutzung
- `docs/known-issues.md`: aktuell erkennbare Schwachstellen
- `docs/setup.md`: lokales Setup unter XAMPP
- `docs/git-history.md`: sichtbare Git-Historie des Projekts
- `docs/branches.md`: Uebersicht ueber Branches und Abzweigungen

## Technischer Stand

- Plain PHP ohne Framework und ohne Composer
- Routing ueber Apache-Rewrite und einen einfachen `RouteController`
- Datenbankzugriff ueber `mysqli`
- HTML-Rendering direkt in Views und Components
- Erwarteter Basispfad aktuell: `/buecherantiquariat`

## Hinweis zum Stil der Codebasis

Die bestehende Anwendung ist bewusst leichtgewichtig und direkt aufgebaut. Neue Aenderungen sollten sich an diesem Stil orientieren:

- kleine Klassen mit klarer Verantwortung
- direkte PHP-Ausgabe statt komplexer Abstraktionen
- minimale Infrastruktur statt neuer Framework-Schichten
- pragmatische Erweiterung der vorhandenen Controller-, Model- und View-Struktur

Die genaueren Stilregeln fuer Agents stehen in `AGENTS.md`.
