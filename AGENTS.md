# AGENTS.md

## Purpose

This repository contains a small plain-PHP catalog application for an antiquarian book shop.
Agents should preserve the existing lightweight structure and write changes that look native to the current codebase.

## Project Snapshot

- Runtime: plain PHP
- Entry point: `index.php`
- Routing: `src/controllers/RouteController.php`
- Main bootstrapping: `src/controllers/MainController.php`
- Database access: `src/models/BookModel.php` and `src/unique/DBConnection.php`
- Rendering: `src/views` and `src/components`
- Documentation: `docs/`

## Working Rules

1. Keep changes small and local to the existing structure.
2. Do not introduce Composer, frameworks, DI containers, ORMs, templating engines, or front-end build systems unless explicitly requested.
3. Preserve routing assumptions around `/buecherantiquariat` unless the task explicitly requires changing them.
4. Prefer extending existing controllers, models, views, and components over creating a parallel architecture.
5. Document meaningful architectural observations in `docs/` when the change affects project understanding.
6. When a task is finished, or when a very large task reaches a clean and meaningful checkpoint, stage the relevant changes and create a commit with a specific, descriptive commit message.
7. Before implementing, explaining, or committing work, critically review your reasoning and the planned change in detail; look for wrong assumptions, missed edge cases, and mismatches with the existing codebase.

## Repository Documentation

Use the existing docs files instead of creating parallel meta-structure unless explicitly requested.

Relevant files:

- `docs/project-overview.md`
- `docs/architecture.md`
- `docs/database.md`
- `docs/known-issues.md`
- `docs/setup.md`
- `docs/git-history.md`
- `docs/branches.md`

## Code Style To Match

Agents should match the current project style as closely as possible.

### General PHP Style

- Use plain classes without namespaces.
- Keep one class, enum, or closely related unit per file.
- Use PascalCase class names like `MainController`, `BookModel`, `KachelView`.
- Keep method names in lower camelCase like `getBookById`, `searchBooks`, `render`.
- Prefer simple typed signatures where the file already uses them.
- `declare(strict_types=1);` is common but not universal in the codebase. Preserve the existing style of the touched file instead of normalizing unrelated files.
- End files in the existing project style. Many files currently include closing `?>`; do not mass-normalize this.

### Structure And Architecture

- Controllers coordinate request flow and pass data to views.
- Models handle direct database access.
- Views and components render HTML directly.
- Reuse existing abstractions before adding new ones.
- Avoid creating service layers, factories, or interfaces unless the task clearly needs them.

### Rendering Style

- HTML is commonly emitted with `echo <<<EOT` heredocs.
- Small repeated UI fragments belong in components.
- Views often call components directly.
- Preserve the current pragmatic rendering style instead of converting files to a new template approach.

### Data Access Style

- Use `mysqli` like the existing code.
- Prefer prepared statements where the model already does so.
- Keep SQL close to the model methods that use it.
- Do not introduce query builders or repositories.

### Naming And Language

- The codebase mixes German domain naming with English technical naming.
- Preserve established names such as `Kachel`, `Zustand`, `Verkauft`, `Detail`, `Search`.
- Do not rename existing identifiers just to make them more consistent unless the task explicitly asks for cleanup.
- Expect some historic spelling inconsistencies like `querry`; avoid broad cleanup unless requested.

### Formatting Traits Visible In The Project

- Braces are placed on the next line for classes and methods.
- Indentation uses 4 spaces.
- Arrays commonly use trailing commas in multi-line contexts.
- Multi-line assignments and `match` expressions are formatted simply, not heavily abstracted.
- Inline logic is acceptable when already common in the surrounding file.

## Change Strategy

When editing, prefer this order:

1. Extend an existing file if the responsibility already lives there.
2. Add a small new file only if the concept clearly deserves its own place.
3. Update docs if the change alters behavior, setup, or architecture.
4. Once a coherent unit of work is complete, commit it before moving on.

## Safe Change Boundaries

Agents may safely:

- improve or extend existing docs
- add focused features within the current MVC-like structure
- fix bugs in controllers, models, views, and components
- add small helper classes that fit the current project style

Agents should ask before:

- changing database schema or import assumptions
- altering route semantics broadly
- adding outbound API calls or background agents
- introducing dependencies or build tooling
- restructuring the application around a new architecture

## Review Focus

Before finishing, check for:

- whether your reasoning still holds after inspecting the actual code paths you changed
- whether the implementation matches the intent you are about to explain
- compatibility with the hardcoded local routing assumptions
- compatibility with the current database structure
- whether the change matches the surrounding file style
- whether docs should be updated because the project behavior changed
- whether the work is verified enough to justify a confident explanation and commit
