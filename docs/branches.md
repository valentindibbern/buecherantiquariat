# Branches

## Vorhandene Branches

Lokal und remote sichtbar sind aktuell:

- `master`

Remote:

- `origin/master`
- `origin/tailwindanddaisy`

## Nutzung

- `master` ist der relevante Hauptzweig fuer den aktuellen PHP-Stand.
- `tailwindanddaisy` existiert als separater Branch, wird fuer den aktuellen Stand aber nicht verwendet.
- Neue Arbeitszweige sollten sich an genau einem umsetzbaren Vorschlag orientieren.

## Vorschlagsbezug

Empfohlener Ablauf:

1. Idee als Suggestion festhalten.
2. Bei Bedarf in einen konkreten Vorschlag ueberfuehren.
3. Vorschlag in eigenem Branch umsetzen.
4. Nach erfolgreicher Pruefung in `master` mergen.

Die Details dazu stehen in `docs/change-workflow.md`.

## Empfehlung fuer kuenftige Branches

Sinnvolle Branch-Namen waeren z. B.:

- `feature/search-improvements`
- `feature/detail-page`
- `refactor/configuration`
- `docs/project-documentation`
- `experiment/tailwind-ui`

Zusaetzlich passend fuer den aktuellen Workflow:

- `fix/header-render-contract`
- `refactor/route-base-path`
- `docs/change-workflow`
