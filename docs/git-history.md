# Git-Historie

## Ueberblick

Die sichtbare Git-Historie ist aktuell klein und konzentriert sich auf die Entstehung des Prototyps Ende Maerz 2026.

Erster sichtbarer Commit:

- `a45a94b` am `2026-03-25`: `Initial commit`

Aktueller `master`-Stand:

- `a7c419c` am `2026-03-27`: `final commit`

Alle sichtbaren Commits stammen von `Valentin Dibbern`.

## Commit-Verlauf

In zeitlicher Reihenfolge der sichtbaren Historie:

- `a45a94b` `2026-03-25`: `Initial commit`
- `afb8be3` `2026-03-26`: `started`
- `45ce50d` `2026-03-26`: `way to late`
- `705be06` `2026-03-26`: `fixed some bugs`
- `47b6bb2` `2026-03-26`: `final commit for tonight`
- `85a3161` `2026-03-26`: `first in school`
- `dd843ef` `2026-03-26`: `random save`
- `a982b86` `2026-03-26`: `random save`
- `f4b7cfe` `2026-03-26`: `some minor changes`
- `5e243ce` `2026-03-26`: `some order`
- `519c97b` `2026-03-27`: `first commit today`
- `22f5cbe` `2026-03-27`: `no bugs, no content`
- `6fe60a1` `2026-03-27`: `it works!`
- `ba2b68d` `2026-03-27`: `Add initial content to README.md`
- `6b48cca` `2026-03-27`: `Create ReadmeUpdater.prompt.yml`
- `bd7a440` `2026-03-27`: `ram`
- `d32f79a` `2026-03-27`: `ram2`
- `a7c419c` `2026-03-27`: `final commit`

## Interpretation

Die Commit-Nachrichten zeigen eher einen Arbeits- und Speicherverlauf als eine stark kuratierte Projektgeschichte. Das bedeutet:

- Die Historie ist fuer grobe Entwicklungsschritte brauchbar.
- Die Historie ist weniger gut geeignet, um einzelne fachliche Entscheidungen allein aus Commit-Namen abzuleiten.
- Fuer kuenftige Arbeit waeren sprechendere Commit-Nachrichten hilfreich, besonders bei Architektur-, UI- oder Datenbankaenderungen.

## Auffaellige Punkte

- Zwischen `2026-03-25` und `2026-03-27` wurde der komplette bisher sichtbare Prototyp aufgebaut.
- Kurz vor dem aktuellen `master`-Stand gab es drei abschliessende Commits: `ram`, `ram2`, `final commit`.
- Der Commit `6b48cca` fuegte eine Datei `ReadmeUpdater.prompt.yml` hinzu, die spaeter auf `master` wieder entfernt wurde.
- Der aktuelle `master`-Commit `a7c419c` aenderte nur wenige Dateien und loeschte `ReadmeUpdater.prompt.yml`.

## Empfehlung fuer kuenftige Historie

Sinnvoll waeren Commit-Nachrichten nach einem Muster wie:

- `feat: add book detail page`
- `fix: correct route handling for home page`
- `docs: document xampp setup`
- `refactor: move db access into model`
