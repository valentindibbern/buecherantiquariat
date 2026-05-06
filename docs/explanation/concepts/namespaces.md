# Namespaces in PHP

## Type

Concept

## Created

2026-05-04

## Simple Explanation

Ein Namespace ist ein Namensraum. Die Grundidee ist einfach: Ein Name soll nicht mehr nur für sich allein stehen, sondern in einen klar abgegrenzten Bereich einsortiert werden. So wie es in einer Stadt mehrere Straßen mit demselben Namen geben könnte, wenn man immer die Stadt dazusagt, können auch in Software mehrere Klassen denselben kurzen Namen tragen, solange klar ist, zu welchem Bereich sie gehören.

Allgemein lösen Namespaces also ein Organisationsproblem. Sobald ein Programm wächst, reichen kurze Namen wie `Controller`, `Model`, `Config` oder `User` oft nicht mehr aus, weil dieselben Begriffe an verschiedenen Stellen sinnvoll wären. Ein Namespace macht aus einem allgemeinen Namen einen vollständigen Namen. Statt nur `MainController` zu haben, könnte man zum Beispiel `App\Controllers\MainController` oder `Shop\Admin\Controllers\MainController` verwenden. Der eigentliche Klassenname bleibt lesbar, aber sein Kontext ist nun fest eingebaut.

Damit sind Namespaces nicht nur ein Mittel gegen Namenskollisionen, sondern auch ein Mittel zur Strukturierung. Gute Namespaces sagen etwas über die Architektur aus. Sie machen sichtbar, zu welchem Projekt, Modul oder technischen Bereich eine Klasse gehört. Dadurch werden große Codebasen lesbarer, weil Namen nicht mehr isoliert betrachtet werden müssen, sondern immer im Kontext erscheinen.

In PHP sind Namespaces besonders wichtig, weil PHP historisch lange ohne strenge Projektstruktur gewachsen ist. Viele ältere PHP-Projekte arbeiten mit globalen Klassennamen und manuellen `require`-Ketten. In modernen PHP-Projekten sind Namespaces dagegen fast immer die Grundlage dafür, dass ein Autoloader nach PSR-4 überhaupt sauber funktionieren kann. PHP selbst zwingt dich nicht dazu, Namespaces zu verwenden, aber praktisch sind sie heute der Standard, sobald ein Projekt mehr als nur ein paar Dateien hat.

Technisch gesehen definierst du in PHP einen Namespace mit dem Schlüsselwort `namespace` am Anfang einer Datei. Wenn du also in einer Datei schreibst `namespace App\Controllers;`, dann bedeutet das: Alle Klassennamen, Interfaces, Traits oder Enums in dieser Datei gehören zu diesem Namensraum, sofern du nichts anderes angibst. Die Klasse `MainController` heißt dann intern nicht mehr nur `MainController`, sondern vollständig `App\Controllers\MainController`.

Das hat wichtige Folgen für die Namensauflösung. Wenn du dich innerhalb desselben Namespaces befindest und `new MainController()` schreibst, nimmt PHP standardmäßig an, dass `MainController` ebenfalls zu diesem Namespace gehört. Wenn du eine Klasse aus einem anderen Namespace nutzen willst, hast du drei Möglichkeiten. Du kannst den vollständigen Namen direkt schreiben, also zum Beispiel `new \App\Controllers\MainController()`. Du kannst am Dateianfang `use App\Controllers\MainController;` notieren und danach nur noch `new MainController()` schreiben. Oder du kannst einen Alias vergeben, etwa `use App\Controllers\MainController as Controller;`, wenn du einen kürzeren oder eindeutigeren Namen möchtest.

An dieser Stelle zeigt sich eine typische Eigenheit von PHP: Namespaces sind in PHP in erster Linie ein System für symbolische Namen. Sie verschieben nicht automatisch Dateien, und sie laden auch keine Dateien. PHP weiß also durch den Namespace allein noch nicht, wo eine Klasse auf der Festplatte liegt. Diese Verbindung entsteht erst durch die Konvention des Autoloadings, besonders durch PSR-4. Deshalb gehören Namespaces und Autoloader in PHP gedanklich immer zusammen, auch wenn sie technisch zwei getrennte Dinge sind.

Ein weiteres wichtiges Detail ist, dass PHP nicht alles gleich behandelt. Klassen, Interfaces, Traits und Enums können namespaced sein. Funktionen und Konstanten können ebenfalls in Namespaces liegen, werden aber in der Praxis etwas anders behandelt und führen häufiger zu Verwirrung. Wenn du eine namespaced Funktion aufrufst, greifen andere Regeln als bei Klassen. Bei Klassen ist die Verbindung mit Autoloading sehr stark und etabliert. Bei Funktionen ist das weniger elegant, weil sie oft über Dateien geladen werden, die bewusst global eingebunden werden. Für ein modernes, klar strukturiertes Projekt sind Namespaces deshalb vor allem bei Klassen und verwandten Symbolen am wichtigsten.

## Why It Matters

Namespaces sind wichtig, weil sie zwei Probleme gleichzeitig lösen: Kollision und Struktur. Das erste Problem ist direkt sichtbar. Ohne Namespaces darf es im gesamten geladenen PHP-Prozess nur eine Klasse mit dem Namen `Router` geben. Sobald du eigenen Code, Bibliotheken oder verschiedene Module kombinierst, wird das schnell unpraktisch. Namespaces machen aus einem globalen Namen einen eindeutigen, qualifizierten Namen, sodass `App\Routing\Router` und `Vendor\Package\Router` problemlos nebeneinander existieren können.

Das zweite Problem ist architektonischer. Ein Namespace drückt aus, wo eine Klasse fachlich hingehört. Wenn ein Entwickler `App\Models\BookModel` liest, versteht er sofort mehr, als wenn nur `BookModel` dasteht. Er sieht, dass die Klasse zum Projekt `App` gehört und im Bereich `Models` liegt. Dieser zusätzliche Kontext hilft beim Lesen, beim Suchen, beim Refactoring und beim Arbeiten im Team. Namespaces sind damit nicht nur ein technisches Hilfsmittel, sondern auch eine Form von Dokumentation.

Für PHP ist das besonders bedeutsam, weil moderne Werkzeuge und Standards davon ausgehen. Composer, PSR-4 und viele Bibliotheken arbeiten nicht mit willkürlichen Dateisuchregeln, sondern mit nachvollziehbaren Abbildungen von Namespace-Präfixen auf Verzeichnisse. Wer in PHP sauber mit Namespaces arbeitet, profitiert deshalb nicht nur von besserem Code, sondern auch von besserer Tool-Unterstützung.

Ein weiterer Grund ist die Wartbarkeit. Ohne Namespaces landen viele Projekte früher oder später in einer Situation, in der man Klassennamen künstlich verlängert, etwa `MainControllerClass`, `BookModelBase` oder `ProjectConfigLoader`. Solche Namen versuchen ein Strukturproblem auf der Ebene des reinen Bezeichners zu lösen. Namespaces lösen dasselbe Problem sauberer. Der Klassenname kann knapp bleiben, weil sein Kontext nicht mehr in den Namen hineingepresst werden muss.

## In This Project

In `buecherantiquariat` sieht man derzeit noch die typische Vor-Namespaces-Struktur eines kleinen PHP-Projekts. Der bestehende Autoloader sucht nach einfachen Klassennamen in mehreren festen Ordnern unter `src/`. Das funktioniert, solange die Projektstruktur klein bleibt und jeder Klassenname global eindeutig ist.

Gerade an diesem Projekt kann man gut erkennen, warum Namespaces später relevant werden. Sobald das Projekt stärker strukturiert werden soll, reicht die Regel "Suche `MainController.php` irgendwo in `src/controllers` oder `src/models`" nicht mehr besonders weit. Ein namespacebasiertes Projekt würde statt globaler Namen vollständige Namen verwenden und dadurch die Zuordnung zwischen Klasse und Datei präziser machen.

Wichtig ist hier aber die begriffliche Trennung: Der Namespace selbst ist nicht der Autoloader. Der Namespace ist die Benennung und fachliche Einordnung eines Symbols. Der Autoloader ist die technische Regel, die aus diesem vollständigen Namen den Dateipfad ableitet. Genau deshalb tauchen Namespaces fast immer dann als Thema auf, wenn ein Projekt von einem einfachen Eigenbau-Loader zu Composer und PSR-4 wechseln soll.

## Small Example

Ein kleines allgemeines Beispiel macht die Idee klarer:

```php
<?php

namespace App\Controllers;

class MainController
{
}
```

In einer anderen Datei könntest du diese Klasse dann so verwenden:

```php
<?php

use App\Controllers\MainController;

$controller = new MainController();
```

Ohne das `use` müsstest du den vollständigen Namen schreiben:

```php
$controller = new \App\Controllers\MainController();
```

Der kurze Name und der vollständige Name sind also nicht dasselbe. `MainController` ist der lokale oder importierte Kurzname. `App\Controllers\MainController` ist der vollständig qualifizierte Name, auf den PHP intern Bezug nimmt.

## Common Confusions

Eine sehr häufige Verwirrung ist die Annahme, dass Namespaces gleichbedeutend mit Ordnern seien. Das stimmt nur indirekt. PHP selbst verlangt nicht, dass `App\Controllers` in einem Ordner `App/Controllers/` liegt. Diese Beziehung entsteht erst durch Konventionen wie PSR-4 oder durch einen eigenen Autoloader.

Ein zweiter häufiger Irrtum ist, dass `use` eine Datei lädt. Das tut es nicht. `use` ist nur eine Import- oder Alias-Anweisung für Namen. Das Laden der Datei übernimmt weiterhin der Autoloader.

Oft wird auch übersehen, dass ein führender Backslash eine besondere Bedeutung hat. `\App\Controllers\MainController` ist ein vollständig qualifizierter Name, also absolut vom globalen Namensraum aus gedacht. Ohne den führenden Backslash hängt die Auflösung davon ab, in welchem Namespace du dich gerade befindest.

Ein weiterer Stolperstein ist uneinheitliche Benennung. Wenn Namespace, Verzeichnisstruktur und Dateinamen nicht diszipliniert zusammenpassen, verliert man einen großen Teil des Nutzens. Das Problem liegt dann nicht in Namespaces selbst, sondern in einer inkonsequenten Projektstruktur.

Schließlich verwechseln viele Anfänger Namespaces mit Sichtbarkeit. Ein Namespace entscheidet nicht darüber, ob etwas `public`, `private` oder `protected` ist. Er löst keine Zugriffsrechte, sondern organisiert Namen.

## Follow-Up Questions

- Wie funktioniert `use` genau in PHP?
- Was ist der Unterschied zwischen einem Namespace und einem Verzeichnis?
- Wie bildet PSR-4 Namespaces auf Ordner ab?
- Wie migriert man ein bestehendes PHP-Projekt schrittweise auf Namespaces?
- Wann sollte man in PHP Funktionen im globalen Raum lassen und wann nicht?
