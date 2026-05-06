# Autoloader in PHP

## Type

Concept

## Created

2026-05-04

## Simple Explanation

Ein Autoloader ist ein Mechanismus, der PHP sagt, wie eine Klasse, ein Interface, ein Trait oder seit neueren PHP-Versionen auch ein Enum automatisch geladen werden soll, sobald du es zum ersten Mal verwendest.

Ohne Autoloader müsstest du jede benötigte Datei selbst mit `require` oder `include` einbinden. Bei kleinen Projekten geht das noch, aber sobald viele Klassen dazukommen, wird das schnell unübersichtlich. Der Autoloader nimmt dir diese Arbeit ab.

Das Grundprinzip ist:

1. Dein Code verwendet eine Klasse, zum Beispiel `new MainController()`.
2. PHP merkt, dass diese Klasse noch nicht bekannt ist.
3. PHP ruft die registrierten Autoloader auf.
4. Ein Autoloader versucht, aus dem Klassennamen den passenden Dateipfad abzuleiten.
5. Wenn die Datei geladen wird und die Klasse darin definiert ist, läuft der Code normal weiter.

Ein Autoloader erstellt also keine Klassen. Er lädt nur die Datei, in der die Klasse bereits definiert ist.

## Why It Matters

Autoloading ist wichtig, weil es Struktur in ein Projekt bringt.

- Du musst nicht am Anfang jeder Datei eine lange Liste von `require_once`-Zeilen pflegen.
- Klassen können sauber auf viele Dateien verteilt werden.
- Die Reihenfolge des manuellen Einbindens wird unwichtiger.
- Das Projekt wird leichter wartbar, wenn es wächst.
- Werkzeuge wie Composer können auf diesem Mechanismus aufbauen und ihn standardisieren.

Kurz gesagt: Ein Autoloader verschiebt die Frage von "Welche Datei muss ich jetzt manuell laden?" zu "Nach welcher Regel findet PHP die richtige Datei selbst?".

## In This Project

In diesem Projekt registrierst du den Autoloader direkt in `index.php` mit `spl_autoload_register(...)`.

Dein aktueller Loader arbeitet so:

- Basisordner ist `src/`.
- Danach werden mehrere feste Unterordner durchsucht:
  `controllers/`, `components/`, `datatypes/`, `models/`, `unique/`, `views/`
- Für jeden Ordner wird geprüft, ob dort eine Datei mit exakt dem Klassennamen plus `.php` existiert.
- Wenn zum Beispiel `MainController` gebraucht wird, prüft der Loader nacheinander:
  - `src/controllers/MainController.php`
  - `src/components/MainController.php`
  - `src/datatypes/MainController.php`
  - und so weiter

Das ist ein einfacher, verständlicher projektinterner Autoloader. Er kennt keine Namespaces und folgt keinem Standard wie PSR-4. Stattdessen sucht er denselben Klassennamen in mehreren bekannten Ordnern.

## Small Example

Dein aktueller Code funktioniert gedanklich ungefähr so:

```php
spl_autoload_register(function ($classname) {
    $folders = ["Controllers/", "Models/", "Views/"];

    foreach ($folders as $folder) {
        $file = __DIR__ . "/src/" . $folder . $classname . ".php";

        if (file_exists($file)) {
            include $file;
            return;
        }
    }
});

new MainController();
```

Wenn `MainController` noch nicht geladen ist, prüft PHP die registrierte Funktion. Findet sie die Datei `src/controllers/MainController.php`, wird sie eingebunden.

## Common Confusions

- Ein Autoloader lädt Dateien automatisch, aber nur dann, wenn ein Symbol wirklich gebraucht wird.
- Autoloading ersetzt nicht jeden `require`. Konfigurationsdateien, Funktionssammlungen oder Bootstrap-Dateien werden oft weiterhin manuell eingebunden.
- Ein Autoloader lädt nicht "alles im Voraus". Er lädt nur bei Bedarf.
- Wenn Dateiname und Klassenname nicht zur Suchregel passen, findet der Autoloader die Klasse nicht.
- Wenn zwei Dateien dieselbe Klasse definieren könnten, ist die Suchreihenfolge wichtig.

## Follow-Up Questions

- Was ist der Unterschied zwischen `include`, `require`, `include_once` und `require_once`?
- Was sind Namespaces in PHP?
- Was ist PSR-4?
- Wie funktioniert Composer-Autoloading intern?
- Wann sollte man in PHP noch manuell Dateien laden?
