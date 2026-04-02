# Branches

## Vorhandene Branches

Lokal und remote sichtbar sind aktuell:

- `master`
- `tailwindanddaisy`

Remote:

- `origin/master`
- `origin/tailwindanddaisy`

## Hauptzweige

### master

`master` ist der aktuelle Hauptzweig und zeigt den zuletzt weitergefuehrten Stand des PHP-Projekts.

Aktuelle Spitze:

- `a7c419c` `final commit`

Exklusive Commits gegenueber `tailwindanddaisy`:

- `bd7a440` `ram`
- `d32f79a` `ram2`
- `a7c419c` `final commit`

Beobachtung:

`master` wurde nach dem gemeinsamen Branch-Punkt weiter auf der bestehenden PHP-Struktur entwickelt.

### tailwindanddaisy

`tailwindanddaisy` ist ein abgezweigter Experiment- oder UI-Branch.

Aktuelle Spitze:

- `f105cc7` `lol`

Exklusive Commits gegenueber `master`:

- `081aa45` `added tailwind and daisyUI`
- `f105cc7` `lol`

Beobachtung:

Der Branch fuehrt Tailwind- und DaisyUI-Abhaengigkeiten ein und veraendert die Struktur der Frontend-Dateien deutlich.

## Gemeinsame Basis

Gemeinsamer Merge-Base von `master` und `tailwindanddaisy`:

- `6b48cca` `Create ReadmeUpdater.prompt.yml`

Ab diesem Commit haben sich die beiden Zweige getrennt weiterentwickelt.

## Inhaltlicher Unterschied zwischen den Branches

Verglichen mit `master` fuehrt `tailwindanddaisy` vor allem diese Aenderungen ein:

- Node-basierte Frontend-Tooling-Dateien wie `package.json`, `package-lock.json` und `tailwind.config.js`
- sehr viele Dateien unter `node_modules/`
- neue CSS-Dateien unter `src/css/`
- Verschiebung von `styles.css` nach `src/css/styles.css`
- Anpassungen an mehreren UI-Komponenten und Views
- Loeschung einzelner PHP-Dateien wie `SearchController.php`, `SearchView.php` und `KategorieEnum.php`

## Risikobild des UI-Branches

Aus dem Diff ergeben sich einige Punkte, die bei einer spaeteren Zusammenfuehrung geprueft werden sollten:

- `node_modules/` wurde in den Branch eingecheckt, was das Repository stark aufblaeht.
- Wichtige PHP-Dateien wurden geloescht oder umbenannt.
- Es gibt Dateinamen mit abweichender Gross-/Kleinschreibung, etwa `mainController.php`, `bookModel.php` oder `detailView.php` im Diff, was auf Windows unauffaellig sein kann, aber auf anderen Systemen problematisch wird.
- Der Branch wirkt eher wie ein Experiment als wie ein sauber integrierter Frontend-Modernisierungsschritt.

## Empfehlung fuer Branch-Nutzung

- `master` sollte als Referenz fuer den derzeit lauffaehigen PHP-Stand betrachtet werden.
- `tailwindanddaisy` sollte vor einer Uebernahme zuerst technisch bereinigt werden.
- Eine eventuelle Rueckfuehrung sollte nicht per Blind-Merge erfolgen, sondern ueber selektive Uebernahme der beabsichtigten Frontend-Aenderungen.

## Empfehlung fuer kuenftige Branches

Sinnvolle Branch-Namen waeren z. B.:

- `feature/search-improvements`
- `feature/detail-page`
- `refactor/configuration`
- `docs/project-documentation`
- `experiment/tailwind-ui`
