# Structural Suggestions For The PHP Project

## Scope

This document contains structural suggestions only.

- No code changes are proposed here as applied edits.
- No runtime behavior is changed by this document.
- The goal is to identify improvement areas in the current vanilla PHP architecture without introducing frameworks or changing the existing technology stack.

## Current Structural Overview

The project already follows a recognizable MVC-like organization:

- `src/controllers` handles request flow and coordination.
- `src/models` handles database and helper data access.
- `src/views` renders pages.
- `src/components` renders reusable HTML fragments.
- `src/datatypes` contains enums and domain labels.

That baseline is reasonable for a small plain-PHP application. The main structural issue is not that the folders are wrong. The issue is that responsibilities are only partially separated, so request handling, configuration, rendering, and data shaping are still tightly coupled.

## Main Structural Issues

## 1. Bootstrap And Application Composition Are Too Centralized

The entry flow is very concentrated:

- `index.php` registers a custom autoloader.
- `MainController` creates the configuration controller.
- `MainController` creates every feature controller manually.
- `MainController` passes all controllers into `RouteController`.
- `RouteController` both defines routes and dispatches the request.

This works for a small app, but it creates a scaling problem:

- every new feature increases the size of `MainController`
- every new route increases the size of `RouteController`
- composition logic and request logic are mixed together
- the dependency graph becomes harder to reason about

### Suggestion

Keep the project framework-free, but reduce centralization by separating:

- bootstrap responsibilities
- dependency creation
- route registration
- request dispatch

A good medium-term structure would be:

- `index.php`: minimal entrypoint only
- one bootstrap class or file for app setup
- one route definition file or route registrar
- controllers focused only on handling a request and returning/rendering a response

### Why This Helps

- feature additions become more local
- the app startup path becomes easier to read
- route configuration becomes easier to scan
- future maintenance risk decreases

## 2. Routing Contains Too Many Request-Level Details

The router currently does more than route matching:

- it strips the base path manually
- it reads the current request path directly from `$_SERVER`
- route handlers read `$_GET` directly
- some route handlers inspect `$_SESSION`
- access control checks are embedded inline in route closures
- GET and POST behavior is partially handled inside route callbacks

This means the routing layer currently acts as:

- route registry
- request parser
- access gate
- controller dispatcher

### Suggestion

Keep the lightweight router, but narrow its responsibility.

The router should ideally do only these things:

- determine the current path
- determine the request method
- find the matching handler
- dispatch to the handler

The controller should receive normalized inputs instead of reading every superglobal directly inside closures.

### Practical Improvement Direction

Without introducing a framework, a better split would be:

- route table defines path and allowed method
- router resolves the handler
- controller method receives already-extracted values
- auth checks are moved into small guard methods or a simple middleware-like helper

### Why This Helps

- request validation becomes easier
- route behavior becomes more consistent
- auth logic stops being duplicated inline
- debugging unexpected request behavior becomes simpler

## 3. The Base URL And Path Handling Should Be Centralized

The project currently depends on a hardcoded base path:

- `/buecherantiquariat`

This is fragile because it means deployment assumptions leak into routing logic.

### Problems Caused By This

- moving the app into a different folder requires code edits
- local XAMPP assumptions are embedded in routing
- links and redirects become harder to standardize
- it increases the chance of inconsistent path generation

### Suggestion

Centralize application path and URL generation in one place.

This can remain very simple:

- one config value for base path
- one helper for route URLs
- one helper for redirects

### Why This Helps

- routing becomes environment-aware instead of hardcoded
- links become consistent across views and components
- setup and deployment changes become safer

## 4. `MainController` Currently Acts More Like An Application Container

The current `MainController` is not mainly handling a single feature. It is effectively:

- application assembler
- dependency container
- route bootstrapping coordinator
- request start trigger

That makes the class name slightly misleading and makes the file a long-term maintenance hotspot.

### Suggestion

Consider renaming or conceptually splitting this responsibility into something closer to:

- `Application`
- `AppBootstrap`
- `AppKernel`

Even if the implementation remains simple, the structural role should be explicit.

### Why This Helps

- class naming reflects actual responsibility
- controller naming becomes more consistent
- onboarding becomes easier because the main startup class is clearly identifiable

## 5. Controllers Mix Flow Control With Data Shaping

Some controllers are thin, which is good, but there is still inconsistency:

- some controllers only fetch and render
- some contain light data preparation
- some depend heavily on raw superglobals via route closures
- some use typed properties while others do not

This makes the controller layer feel uneven.

### Suggestion

Define a stricter internal rule for controllers:

- controllers accept input
- controllers call model/service logic
- controllers select the correct view
- controllers should not own unrelated formatting or session policy logic

For data shaping, prefer one of these approaches:

- shape data inside model/repository output
- add a small mapper or presenter layer
- add dedicated helpers for enum label conversion and display formatting

### Why This Helps

- controllers become predictable
- presentation formatting is easier to reuse
- future bugs caused by inconsistent data preparation decrease

## 6. The Model Layer Is Too Close To Raw Database Shape

`BookModel` returns raw associative arrays with database column names such as:

- `Title`
- `Beschreibung`
- `autor`
- `zustand`

Those names then become part of the view contract.

This creates tight coupling between:

- database schema
- controller logic
- view rendering

### Suggestion

Introduce an internal normalization step between SQL results and the rest of the app.

This does not require a full ORM or complex abstraction. A lightweight approach is enough:

- map DB rows into consistent PHP arrays
- or introduce a simple `Book` data object
- or introduce a mapper that converts raw rows into predictable keys

### Benefits

- internal naming becomes consistent
- schema changes become easier to isolate
- views stop depending directly on DB column casing and naming quirks

## 7. Some Responsibilities Are In The Wrong Layer

`CookieModel` is structurally unusual because pagination metadata is being managed through a cookie-oriented model.

Pagination page count is not domain data owned by the browser. It is derived from the current database state. That makes it a poor fit for a cookie abstraction.

### Why This Is Structurally Weak

- page count is server-derived, not user-owned
- client-side persistence is unnecessary for this value
- it creates hidden coupling between DB state and browser state
- debugging pagination becomes less transparent

### Suggestion

Keep pagination logic server-side.

Better ownership options:

- `BookModel` calculates total pages
- a pagination helper calculates offsets and bounds
- controller passes both current page and max pages into the view

### Why This Helps

- data ownership becomes clearer
- request behavior becomes deterministic
- pagination logic is easier to reason about

## 8. Views Duplicate The Same Document Shell

Multiple views render the same structural page wrapper:

- HTML doctype
- `<html>`
- `<head>`
- stylesheet include
- `<body>`
- header component
- footer component

This is the strongest duplication pattern in the project.

### Problems Caused By This

- layout changes require edits in many files
- metadata changes are repetitive
- page-shell consistency is harder to maintain
- view files contain both layout boilerplate and feature-specific output

### Suggestion

Introduce a shared page layout abstraction while staying inside the current architecture.

Possible forms:

- a `PageView` wrapper
- a `LayoutComponent`
- a base renderer helper

Its responsibility should be:

- output the document shell
- include shared metadata
- render the header/footer
- inject page-specific content

### Why This Helps

- removes repeated boilerplate
- makes views shorter and more focused
- makes global layout changes much safer

## 9. View And Component Boundaries Should Be Defined More Explicitly

The project already distinguishes between:

- views for whole pages
- components for reusable fragments

That is a good idea, but the practical contract is still loose.

### Suggested Rule

- views own page composition
- components own reusable UI fragments
- components should not need to know too much about route-level behavior
- components should receive already-prepared values whenever possible

### Why This Helps

- rendering becomes easier to reason about
- component reuse improves
- fewer hidden dependencies appear between UI fragments and global state

## 10. Naming And Typing Conventions Need To Be Standardized

The codebase currently shows inconsistent conventions:

- some classes use `declare(strict_types=1);`, some do not
- some controllers use typed properties, some do not
- class naming and casing are not fully consistent
- parameter naming includes typos such as `querry`
- some files follow more disciplined style than others

This is not just a cosmetic issue. In a small codebase without automated tooling, consistency is one of the main ways to control complexity.

### Suggestion

Adopt a small internal standard and follow it everywhere:

- every PHP file uses `declare(strict_types=1);`
- class names match filenames exactly
- constructor properties are typed
- method return types are explicit where possible
- variable names are spelled consistently
- page/render contracts use stable naming

### Why This Helps

- code becomes easier to scan
- accidental bugs become easier to spot
- contributors can predict local conventions instead of rediscovering them

## 11. Remove Structural Drift And Dead Seams

The repository shows a few signs of drift:

- autoload references folders that are not clearly part of the active structure
- some methods look unused
- some debug output remains in model code
- some documentation has already drifted from implementation in the past

This is common in small apps, but if not corrected it gradually lowers trust in the structure.

### Suggestion

Do periodic cleanup passes focused only on structural hygiene:

- remove unused autoload paths
- remove dead methods
- remove debug output
- align docs with code
- keep class responsibilities explicit

### Why This Helps

- reduces false complexity
- increases confidence in the codebase
- makes future refactors safer

## 12. Authentication And Admin Concerns Need Clearer Separation

The project contains public catalog pages and admin pages, which is a sensible domain split. Structurally, however, access checks are currently close to route closures and session state.

### Suggestion

Create a clearer boundary between:

- public routes
- authenticated routes
- authentication logic
- session state handling

This can still remain simple in plain PHP:

- one auth helper or guard
- one place for login/logout/session checks
- route registration that clearly labels protected endpoints

### Why This Helps

- admin access rules become easier to audit
- duplicate protection checks decrease
- security-sensitive flow becomes easier to maintain

## 13. Configuration Loading Should Be Treated As Infrastructure

`ConfigurationController` currently handles multiple startup concerns:

- reading `.env.local`
- defining constants
- creating the database connection
- starting sessions
- configuring pagination cookie state

That is too many unrelated responsibilities in one class.

### Suggestion

Split configuration and infrastructure bootstrapping conceptually into smaller roles:

- env/config loading
- database connection creation
- session startup
- application startup hooks

Even if you keep the same files for now, those responsibilities should be treated as separate concerns.

### Why This Helps

- startup logic becomes easier to change safely
- configuration concerns stop mixing with request concerns
- infrastructure code becomes easier to test manually

## 14. Add Lightweight Internal Layers Without Adding Frameworks

This project does not need a framework to improve structure. The biggest gains would come from adding one or two very small internal layers:

- `services` for business/application logic
- `helpers` or `support` for cross-cutting utilities
- optional `presenters` or `mappers` for display-ready data

### Example Structural Direction

- `controllers`: HTTP/request handling
- `models`: direct persistence logic
- `services`: orchestration and business rules
- `views`: page-level rendering
- `components`: reusable HTML fragments
- `datatypes`: enums and domain constants

### Why This Helps

- reduces controller bloat
- avoids turning models into “everything” classes
- makes the code easier to grow without changing stack

## Recommended Improvement Order

The best order is to start with structural changes that reduce duplication and coupling first.

### High Priority

1. Introduce a shared page layout abstraction.
2. Simplify and centralize route registration and dispatch behavior.
3. Reduce `MainController` responsibility by separating application bootstrap from feature control.

### Medium Priority

1. Move pagination ownership away from cookies.
2. Normalize model output so views do not depend directly on raw DB field names.
3. Centralize base path and URL generation.

### Ongoing Hygiene

1. Standardize typing and naming conventions.
2. Remove dead seams and debug remnants.
3. Keep docs aligned with actual code behavior.

## Suggested Target Architecture

A realistic target architecture for this repository, while staying plain PHP, would be:

- `index.php`
  - very small entrypoint
- bootstrap/infrastructure
  - config loading
  - DB connection
  - session startup
- routing
  - route definitions
  - dispatch
  - optional route guards
- controllers
  - input handling
  - call services/models
  - delegate to views
- services
  - app-level use cases
  - auth flow
  - pagination decisions
  - data shaping coordination
- models
  - SQL queries and persistence
- views/components
  - rendering only
- datatypes
  - enums and domain labels

This would preserve the project’s current technology choices while making the structure much more maintainable.

## Final Assessment

The project already has a usable structural base:

- there is a folder-level separation of concerns
- controllers, models, views, and components are already distinguished
- the application is small enough that structural cleanup is still very manageable

The main opportunity is to make the existing structure stricter and more consistent rather than replacing it.

The most valuable improvements are:

- reduce bootstrap centralization
- simplify routing responsibilities
- eliminate duplicated page layout markup
- normalize data before rendering
- standardize conventions across the codebase

These changes would significantly improve maintainability without changing the project into something heavier or framework-dependent.
