# Labo 1 — WordPress op je eigen server

**Werktijd** 75–90 minuten, inclusief verslag.

Werk individueel op je toegewezen Debian-LXC. Gebruik de [theorie van week 1](Ch1-theorie.md) als naslagwerk. Werk met fictieve inhoud en testaccounts op het interne netwerk.

## Opdracht

Je bent verantwoordelijk voor de eerste versie van je platform. Een medestudent krijgt alleen het adres van je site. Vanaf een tweede toestel moet die kunnen zien waar je platform over gaat en je eerste publicatie kunnen openen. Jij moet aan de docent kunnen uitleggen wat er tussen die browser en de databank gebeurt, en aantonen welke gegevens bewaard blijven wanneer de containers worden vervangen.

Kies een herkenbare sitenaam en schrijf een kort testbericht over je projectthema. Gebruik een afbeelding waarvan je meteen kunt herkennen of ook het bestand na heraanmaak nog beschikbaar is.

## Wat moet werken?

- Je beheert de uitrol via SSH. Docker Compose draait WordPress en MariaDB als aparte services met persistente opslag. Alleen WordPress heeft een gepubliceerde poort.
- De publieke site toont een herkenbare sitetitel en een eigen testbericht met een kleine testafbeelding. Het WordPress-dashboard is bereikbaar voor je testbeheerder.
- Hetzelfde bericht en de afbeelding blijven bereikbaar na heraanmaak van de WordPress- en MariaDB-containers met behoud van de volumes.
- Je projectmap bevat een Compose-configuratie en een `.env.example` met voorbeeldwaarden. Je ingevulde `.env` blijft buiten Git.

### Aantonen tijdens het labo

| Controle | Wat je aantoont |
| --- | --- |
| Publieke toegang | Een bezoeker opent de homepage én het bericht vanaf een tweede toestel zonder aan te melden. Beide URL’s verwijzen naar de LXC op poort 8080. |
| Beheer | Het testaccount kan aanmelden en bij het gepubliceerde bericht en de bijbehorende media. Leg uit wat een bezoeker van diezelfde inhoud ziet. |
| Verbindingspad | Wijs voor jouw opstelling aan welke verbinding via de gepubliceerde webpoort loopt en via welke interne verbinding WordPress MariaDB bereikt. Onderbouw het verschil met de poortkoppelingen van beide services. |
| Persistente opslag | Vergelijk de identiteit van de containers vóór en na de heraanmaak. Controleer daarna de titel en inhoud van het bericht én het afbeeldingsbestand via de publieke site. Leg uit welke opslag elk van beide resultaten verklaart. |

**Diagnosevraag.** Stel dat je browser een antwoord van WordPress krijgt met de melding dat de databaseverbinding mislukt. Welke laag werkt dan al? Welke twee onderdelen zou je op je eigen opstelling controleren, en welk resultaat verwacht je bij elk? Je mag dit scenario analyseren op basis van je werkende opstelling.

## Wat lever je in?

Schrijf in je projectrepository een eigen `labo-1.md`. Beschrijf stap voor stap wat je werkelijk deed, waar je het deed, welke commando’s of instellingen je gebruikte en hoe je wist dat elke belangrijke stap lukte. Noteer ook hoe je een eventuele fout onderzocht en oploste. Laat wachtwoorden en andere geheimen weg uit het verslag en je bewijs.

Voeg een eenvoudig schema toe van browser, LXC, services en volumes. Noteer per controle je verwachte en werkelijke resultaat met gericht bewijs, zoals een URL, korte uitvoer of schermafbeelding. Vermeld het gebruikte testtoestel en beantwoord de diagnosevraag met de namen uit jouw opstelling.

**Extra uitdaging.** Publiceer een korte projectbeschrijving als pagina en vergelijk haar publieke bestemming met die van het testbericht. Leg uit wanneer je binnen jouw platform voor elk van beide kiest.
