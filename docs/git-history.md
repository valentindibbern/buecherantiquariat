# Git-Historie

## Ueberblick

Die sichtbare Git-Historie ist fuer dieses Projekt eher als grober Entwicklungsverlauf zu verstehen als als dauerhaft stabile Dokumentationsquelle.

Commit-Hashes und letzte Spitzenstaende aendern sich laufend und werden deshalb hier bewusst nicht einzeln gepflegt.

## Commit-Verlauf

Die vorhandene Historie zeigt vor allem einen direkten, schrittweisen Arbeitsverlauf mit vielen Zwischenstaenden und Speicher-Commits.

## Interpretation

Die Commit-Nachrichten zeigen eher einen Arbeits- und Speicherverlauf als eine stark kuratierte Projektgeschichte. Das bedeutet:

- Die Historie ist fuer grobe Entwicklungsschritte brauchbar.
- Die Historie ist weniger gut geeignet, um einzelne fachliche Entscheidungen allein aus Commit-Namen abzuleiten.
- Fuer kuenftige Arbeit waeren sprechendere Commit-Nachrichten hilfreich, besonders bei Architektur-, UI- oder Datenbankaenderungen.

## Auffaellige Punkte

- Die Commit-Nachrichten sind ueberwiegend arbeitsorientiert und oft nur bedingt selbsterklaerend.
- Fuer technische Rueckschluesse sollte die Historie immer zusammen mit dem aktuellen Code gelesen werden.

## Empfehlung fuer kuenftige Historie

Sinnvoll waeren Commit-Nachrichten nach einem Muster wie:

- `feat: add book detail page`
- `fix: correct route handling for home page`
- `docs: document xampp setup`
- `refactor: move db access into model`
