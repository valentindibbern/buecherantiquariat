# AGENTS.md

## Repo Snapshot

- Small plain-PHP catalog app intended for local XAMPP at `http://localhost/buecherantiquariat/`.
- `master` has no Composer, Node, CI, test runner, lint, or formatter config. Verification is manual plus `php -l`.
- Real entry flow: `index.php` autoloads `src/*`, instantiates `MainController`, which builds `ConfigurationController`, feature controllers, then `RouteController::configureRoutes()` and `receive()`.

## Runtime And Setup

- Database config comes from root `.env.local`; `ConfigurationController.php` parses `DB_HOST`, `DB_USER`, `DB_PASSWORD`, and `DB_NAME` manually.
- `.env.local` also contains `DB_PORT`, but the current code does not pass it to `mysqli`.
- SQL source of truth is `assets/books.sql`. The dump names database `bookstest`, while the app expects `books`.

## Structure That Matters

- Keep changes inside the existing `controllers` / `models` / `views` / `components` split. Do not introduce frameworks, Composer packages, template engines, or frontend build tooling on `master`.
- Routing is path-only in `src/controllers/RouteController.php`; the base path `/buecherantiquariat` is hardcoded.
- Main routes are `/`, `/home`, `/detail?id=...`, and `/search?search=...`.
- `src/models/BookModel.php` owns the current queries; pagination is 18 rows per page.

## Verification

- Single-file syntax check: `php -l path\to\File.php`
- Repo-wide syntax check: `Get-ChildItem -Recurse -Filter *.php | ForEach-Object { php -l $_.FullName }`
- For request-flow or rendering changes, also smoke-test:
  - `http://localhost/buecherantiquariat/`
  - `http://localhost/buecherantiquariat/home`
  - `http://localhost/buecherantiquariat/search?search=test`
  - `http://localhost/buecherantiquariat/detail?id=1`

## Current Gotchas

- Do not trust docs over code without checking. Current docs still mention `DBConnection.php`, but live code uses `ConfigurationController.php`.
- Do not assume current `master` is clean: `HeaderComponent.php` currently fails `php -l`, and several render signatures/call sites are inconsistent. Inspect callers before reusing or changing view/component method signatures.
- Sorting currently flows from raw `sort` / `dir` query params into `BookModel::getBooksByPage()`. Any sorting change must be checked against actual SQL column names in `assets/books.sql` such as `Title`, `autor`, and `zustand`.
- On Windows, avoid casual case-only renames in `src/controllers/*`; this repo already shows casing-related Git friction.
- `origin/tailwindanddaisy` is an experimental remote branch, not the current baseline. Do not assume Tailwind, DaisyUI, or `src/css/*` exist on `master`.

## Docs

- If you change setup assumptions, routing behavior, database expectations, or architecture, update the matching file in `docs/` instead of adding parallel notes.
