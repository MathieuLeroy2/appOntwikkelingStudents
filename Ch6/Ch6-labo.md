# Labo 6 — Test en verdedig je oplevering

**Werktijd** 80–90 minuten, inclusief verslag.

Vertrek van je werkende project, je eerdere laboverslagen en het herstelbewijs uit [labo 5](../Ch5/Ch5-labo.md). Gebruik de [theorie van week 6](Ch6-theorie.md) en de [projectopdracht](../Opdracht/docker/projectopdracht.md) als naslagwerk.

## Opdracht

Je draagt je platform over aan een medestudent die je project alleen kent via je repository en het adres van je site. Die moet een gewone bezoekerstaak kunnen uitvoeren en in je documentatie kunnen terugvinden hoe het platform draait en hersteld kan worden.

Kies een bezoekerstaak die de waarde van jouw platform toont, van homepage tot een concreet item. Maak voor jezelf duidelijk welke inhoud je verwacht te vinden en wanneer de taak geslaagd is. Gebruik de resultaten van je tests om één probleem aan te pakken en kies bewijs waarmee je die verbetering tijdens je proefverdediging kunt uitleggen.

## Wat moet werken?

- De route van homepage naar catalogus, gevonden item en detailpagina werkt op smartphone-, tablet- en desktopbreedte. Je controleert de bereikbaarheid vanaf een tweede toestel, de toetsenbordbediening, een verwachte treffer en een niet-passend item of een zoekopdracht zonder resultaten.
- Voor één concreet toegankelijkheids- of prestatieprobleem toon je een verbetering met een vergelijking vóór en na. Je hertest dezelfde pagina of handeling onder vergelijkbare omstandigheden.
- Je project-README maakt duidelijk hoe iemand met de juiste toegang de site start, welke onderdelen daarvoor nodig zijn, waar de inhoud bewaard wordt en hoe herstel werkt. Een medestudent kan met die uitleg de site vinden en een punt uit de start- of herstelprocedure navertellen.
- In een korte proefverdediging toon je de bezoekersroute, interactie en een verschil tussen twee rollen. Je kunt ook de Compose-services en hun opslag uitleggen en aantonen wat je uit back-up hebt hersteld.

### Aantonen tijdens het labo

| Controle | Wat je aantoont |
| --- | --- |
| Bezoekerstaak | Leg per schermbreedte vast welke taak je uitvoerde en of de verwachte inhoud en vervolglinks bruikbaar zijn. Noteer ook de uitkomst van dezelfde taak met alleen het toetsenbord. |
| Verbetering | Kies één waarneming die je kunt vergelijken. Gebruik bij prestaties bijvoorbeeld de grootte van dezelfde afbeelding vóór en na de ingreep. Gebruik bij toegankelijkheid bijvoorbeeld de zichtbaarheid van de focus tijdens dezelfde handeling. |
| Overdracht | Laat een medestudent via je README de site-URL en de start- of herstelinformatie terugvinden. Noteer één onduidelijkheid die je hebt opgelost of laat de medestudent aanwijzen waar alle nodige informatie staat. |
| Individuele demonstratie | Bereid in maximaal vijf minuten een verhaal voor waarin je één bezoekerstaak, één rolverschil en één stuk herstelbewijs met elkaar verbindt. Leg ook uit wat het verschil is tussen heraanmaak met bestaande volumes en herstel uit een aparte kopie. |

## Wat lever je in?

Lever je bijgewerkte project-README en een eigen `labo-6.md` in je projectrepository op. Beschrijf stap voor stap welke controles je uitvoerde, welke verbetering je aanbracht en hoe je de werking daarna opnieuw testte. Noteer je testomstandigheden, verwachte en werkelijke resultaten, de aanpassingen aan de documentatie en de feedback uit de proefverdediging. Vermeld eventuele open punten.

Voeg een testmatrix toe met per controle de taak, de omgeving, het verwachte en het werkelijke resultaat en een verwijzing naar je bewijs. Neem ook de korte volgorde van je demonstratie op en geef aan welk stuk bewijs je bij elk onderdeel toont.

**Extra uitdaging.** Controleer of de gerenderde paginatitel, hoofdkop en interne linktekst bij één belangrijke detailpagina dezelfde bezoekersvraag ondersteunen. Verbeter één element en test opnieuw hoe de bezoeker die pagina terugvindt.
