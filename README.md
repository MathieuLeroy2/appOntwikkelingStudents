# OPO Appontwikkeling — WordPress & webhosting

**Build Your Own Platform** is een individueel project van 4 studiepunten over zes weken. Je bouwt vanaf week 1 op de toegewezen Debian-LXC. Elke week heeft maximaal één uur theorie; de overige lestijd is begeleid projectwerk. De [projectopdracht](Opdracht/docker/projectopdracht.md) bepaalt alle minimumeisen, mijlpalen en de beoordeling.

| Week | Volledige theorie | Marp-slides | Labo | Wat je aan het einde van de week toont |
| --- | --- | --- | --- | --- |
| 1 — WordPress op de eigen server | [Hoofdstuk](Ch1/Ch1-theorie.md) | [Slides](Ch1/Ch1-slides.md) | [Labo 1](Ch1/Ch1-labo.md) | Site op de LXC, bereikbaar vanaf een tweede toestel |
| 2 — Een bruikbare website ontwerpen | [Hoofdstuk](Ch2/Ch2-theorie.md) | [Slides](Ch2/Ch2-slides.md) | [Labo 2](Ch2/Ch2-labo.md) | Homepage, navigatie, visuele richting en eigen CSS |
| 3 — Van inhoudsmodel naar dynamische catalogus | [Hoofdstuk](Ch3/Ch3-theorie.md) | [Slides](Ch3/Ch3-slides.md) | [Labo 3](Ch3/Ch3-labo.md) | CPT, velden, termen, detailpagina's en tien uitgewerkte items |
| 4 — Bezoekers vinden inhoud en kunnen reageren | [Hoofdstuk](Ch4/Ch4-theorie.md) | [Slides](Ch4/Ch4-slides.md) | [Labo 4](Ch4/Ch4-labo.md) | Zoek- of filtertaak, interactie en verschillend werkende rollen |
| 5 — Beveilig, bewaar en herstel je site | [Hoofdstuk](Ch5/Ch5-theorie.md) | [Slides](Ch5/Ch5-slides.md) | [Labo 5](Ch5/Ch5-labo.md) | Volledige back-up en geslaagde hersteltest |
| 6 — Testen, documenteren en verdedigen | [Hoofdstuk](Ch6/Ch6-theorie.md) | [Slides](Ch6/Ch6-slides.md) | [Labo 6](Ch6/Ch6-labo.md) | Definitieve site, repository en individuele demonstratie |

Reken op één tot anderhalf uur voor de kernopdracht van elk labo, inclusief verslag. Je kiest zelf hoe je het gevraagde resultaat bereikt. Per labo lever je in je eigen projectrepository een Markdown-verslag in waarin je stap voor stap beschrijft wat je deed en hoe je controleerde dat het werkte. De extra uitdaging is optioneel.

De hoofdstukken bevatten de volledige uitleg, controle en het projectwerk. De slides ondersteunen het gesprek en de demonstratie tijdens het theorie-uur. Een oefenmodel in een hoofdstuk is pas een **verplichte projecteis** wanneer de projectopdracht die eis ook stelt. De gamecatalogus PixelAtlas is een [uitgewerkte voorbeeldoplossing](Opdracht/docker/README.md); andere onderwerpen zijn even geschikt. Het kleine [catalogusplug-invoorbeeld](Ch3/voorbeeldcatalogus.php) laat in week 3 zien hoe een veld van invoer tot publieke weergave werkt.

Voor deze onderwijsopstelling is geen publieke domeinnaam nodig. De site draait via Docker Compose met WordPress en MariaDB op de interne LXC; alleen de webpoort wordt gepubliceerd. Gebruik bij HTTP uitsluitend testaccounts en testgegevens. Bewaar een ingevulde `.env` en back-ups buiten Git.

De presentaties gebruiken een gedeeld Marp-thema met figuren, screenshots en gamebeelden. Elk beeld heeft een zichtbare bronvermelding. De [beeldbronnen en exportinstructies](assets/slides/BRONNEN.md) bevatten de oorspronkelijke links en makers. Open voor de Marp-voorvertoning de hoofdmap van deze repository in VS Code. Exporteer vanuit die hoofdmap, bijvoorbeeld met `marp Ch1/Ch1-slides.md --pdf --allow-local-files`.

De [redactionele prompt](_meta/prompt.md) beschrijft hoe dit lesmateriaal in dezelfde lijn bijgewerkt wordt. De projectopdracht blijft leidend wanneer voorbeelden, slides en eisen uiteenlopen.
