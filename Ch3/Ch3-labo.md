# Labo 3 — Bouw een dynamische catalogus

**Werktijd** 80–90 minuten, inclusief verslag.

Vertrek van je site uit [labo 2](../Ch2/Ch2-labo.md). Gebruik de [theorie van week 3](Ch3-theorie.md) als naslagwerk. Beperk dit labo tot drie items. Voor de weekmijlpaal werk je de catalogus verder uit tot minstens tien items. De [projectopdracht](../Opdracht/docker/projectopdracht.md) beschrijft die mijlpaal.

## Opdracht

Bouw voor je projectthema een catalogus waarin een bezoeker drie items kan vergelijken. Formuleer een bezoekersvraag waarin zowel een groep als een kenmerk van een item voorkomt. Bij een receptencatalogus kan dat bijvoorbeeld zijn welke lunchgerechten in minder dan dertig minuten klaar zijn. Voor die vraag moet de bezoeker kunnen zien bij welke maaltijd elk gerecht past en hoe lang het duurt.

Kies zelf welke informatie je groepeert, welke je als gestructureerde waarde bewaart en welke je in vrije tekst beschrijft. Zorg dat de drie items genoeg van elkaar verschillen om je model te testen. Denk aan twee items binnen dezelfde groep met een verschillende waarde en een derde item in een andere groep. Kies zelf hoe je de kenmerken publiek toont.

## Wat moet werken?

- Je catalogus gebruikt een passend custom post type waarvan de registratie losstaat van het thema. De drie gepubliceerde items hebben eigen inhoud en verschillen in relevante veldwaarden en indeling.
- Je gebruikt minstens twee betekenisvolle taxonomietermen en minstens twee velden die bij jouw onderwerp passen. Kies voor een veld waarop bezoekers waarden vergelijken een consequent formaat of een vaste eenheid. Op de publieke detailpagina zijn de ingevulde kenmerken herkenbaar. Gebruik ook één bewust leeg optioneel veld en controleer hoe de weergave daarmee omgaat.
- Via de hoofdnavigatie bereikt een bezoeker de dynamische catalogus en van daaruit elk item. Een gepubliceerd item verschijnt automatisch in de catalogus. Een termarchief toont de items met die term.

### Aantonen tijdens het labo

| Controle | Wat je aantoont |
| --- | --- |
| Veld van invoer tot weergave | Vergelijk voor twee items een opgeslagen veldwaarde met de waarde op de publieke detailpagina. Leg vast hoe een lege optionele waarde wordt weergegeven. |
| Dynamisch overzicht | Laat met één van je drie items zien dat een wijziging in publicatiestatus doorwerkt in het archief. Aan het einde zijn de drie items gepubliceerd. |
| Indeling | Noteer vóór de test welke titels in een gekozen termarchief horen. Vergelijk die lijst met de feitelijke resultaten en wijs minstens één item aan dat terecht ontbreekt. |
| Publieke route | Open op een smal scherm vanuit Home de catalogus en één detailpagina. Controleer of je op die pagina de benodigde informatie vindt om je bezoekersvraag te beantwoorden. |

## Wat lever je in?

Schrijf in je projectrepository een eigen `labo-3.md`. Beschrijf stap voor stap hoe je van bezoekersvraag naar inhoudsmodel en publieke catalogus ging. Noteer welke instellingen of code je gebruikte, wat je bij elke belangrijke stap controleerde en hoe je eventuele fouten oploste.

Voeg een kleine datadictionary toe met per veld of indeling het doel, het type, een voorbeeldwaarde en de plek op de publieke site. Geef de URL van het archief, van een termarchief en van twee verschillende detailpagina’s. Noteer per controle wat je verwachtte en wat je waarnam. Beantwoord je bezoekersvraag aan de hand van je eigen testitems en onderbouw waarom je één kenmerk als veld en één ander kenmerk als term modelleerde.

**Extra uitdaging.** Voeg op de homepage een dynamisch overzicht van recente catalogusitems toe. Toon aan dat het de juiste inhoud selecteert door de resultaten te vergelijken met de gewone berichten van je site.
