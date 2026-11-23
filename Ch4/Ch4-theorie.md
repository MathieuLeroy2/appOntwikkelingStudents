# Week 4 — Bezoekers vinden inhoud en kunnen reageren

## Voor je begint

Je hebt uit [week 3](../Ch3/Ch3-theorie.md) een contenttype met tien uitgewerkte items, archief en detailpagina's. Nu bewijs je dat bezoekers de juiste items kunnen **vinden** en zinvol kunnen **reageren**. Je test tegelijk wie die inhoud mag beheren. De [projectopdracht](../Opdracht/docker/projectopdracht.md) vereist een werkende zoekfunctie **en/of** relevante filters, een vorm van interactie met bewuste moderatie of misbruikbeperking, en minstens twee rollen met aantoonbaar verschillende rechten. Een specifieke filterplug-in, reviewplug-in of eigen rol is niet verplicht.

## Leerdoelen en lesverloop

Na dit hoofdstuk kun je een concrete zoek- of filtertaak ontwerpen en testen, interactie op een catalogusitem zichtbaar maken, moderatie instellen, een plug-in doelgericht beoordelen en twee gebruikersrollen met toegestane én geweigerde handelingen vergelijken.

| Tijd | Onderwerp |
| --- | --- |
| 0–12 min | Bezoekersvraag en zoek- of filterroute |
| 12–25 min | Archief, resultaten en lege toestand testen |
| 25–40 min | Reacties, reviews en moderatie |
| 40–52 min | Gebruikersrollen en plug-inkeuze |
| 52–60 min | Demonstratie en zelfcontrole |

## 1. Maak van een bezoekersvraag een test

Begin met een taak die bij de inhoud past: “Vind een puzzelgame voor twee spelers.” De bezoeker moet een ingang zien, een keuze kunnen maken, resultaten begrijpen en een detailpagina kunnen openen. Noteer vóór het bouwen welke items **wel** en **niet** in het resultaat horen. Een afbeelding van een zoekvak of een geïnstalleerde plug-in is geen bewijs dat de taak werkt.

De eenvoudigste filterroute gebruikt een taxonomie uit week 3. Open onder **Games → Genres** de publieke weergave van de termen Puzzel en Strategie en kopieer hun echte URL's. Voeg op het catalogusarchief of in de navigatie herkenbare links toe naar **Alle games**, **Puzzel** en **Strategie**. Bij een blokthema kan dat met Navigatie- of Knopblokken; bij een klassiek thema met het menu of de themacode. De termarchieven tonen de bijbehorende gepubliceerde items. Test dat een item met uitsluitend de term Strategie niet onder Puzzel staat. Een item met beide termen mag in beide termarchieven verschijnen. Een gewone pagina met een Query Loop die vooraf op Puzzel vaststaat is geen bedienbaar filter: de bezoeker kan de selectie niet wijzigen. Gebruik voor het archief en termarchief de hoofd- of templatequery, anders kan de termkeuze worden genegeerd.

Een zoekformulier kan een nuttige tweede route zijn. Test met een **exacte titel**, een algemene term en een woord zonder resultaat. Een standaard WordPress-zoekfunctie kan CPT-items meenemen wanneer het type publiek doorzoekbaar is, maar een thema, plug-in of aangepaste query kan de resultaten beperken. Controleer dus de publieke resultaten voor jouw eigen CPT; ga niet af op het zoekvak alleen. Als je een plug-in kiest voor combinaties van genre, platform en spelersaantal, documenteer welke data zij leest, hoe de URL werkt en wat er bij uitschakelen gebeurt.

Toon een duidelijke **lege toestand** met een weg terug naar alle items. Test op een smal scherm of filters, resultaten en terugweg bereikbaar blijven. Een zoek- of filtertaak is pas geslaagd wanneer een medestudent haar zonder jouw mondelinge aanwijzingen kan voltooien.

> **Kennischeck:** Waarom test je ook een item dat *niet* in een gekozen termarchief thuishoort?

## 2. Maak interactie zichtbaar én beheersbaar

WordPress-reacties zijn een eenvoudige manier om bezoekers te laten reageren op een game of recept. Andere oplossingen, zoals reviews of scores, zijn mogelijk als ze werkelijk werken en verantwoord worden beheerd. Bij het lesvoorbeeld is ondersteuning voor reacties in de CPT-registratie opgenomen. Dat is slechts één laag:

1. **Toestemming:** onder **Instellingen → Discussie** en op het concrete item moeten reacties zijn toegestaan.
2. **Moderatie:** je kiest of een reactie eerst goedkeuring vereist en hoe je ongewenste inhoud behandelt.
3. **Weergave:** het thema of de Single-template moet het formulier en goedgekeurde reacties tonen.

Bij een blokthema voeg je zo nodig een **Comments**-blok toe aan de passende Single-template. Controleer dat de template het juiste CPT-item toont. Bij een klassiek thema moet de code reacties aanroepen; PixelAtlas doet dat in de [gamedetailtemplate](../Opdracht/docker/wp-content/themes/pixelatlas/single-pa_game.php). Een opgeslagen reactie verdwijnt niet uit de database doordat een formulier uit de template wordt verwijderd, maar de interactie werkt dan niet meer voor de bezoeker.

Stel onder **Instellingen → Discussie** een voor jouw site passende moderatieregel in. Dien met fictieve gegevens een testreactie in. Controleer in een privévenster dat ze vóór goedkeuring niet publiek is, keur haar goed als bevoegde gebruiker en open de detailpagina opnieuw. Test ook een ongewenste reactie en documenteer of ingebouwde moderatie volstaat. Op de interne testsite is een antispamplug-in geen automatische verplichting. Verzamel geen echte persoonsgegevens op de HTTP-site.

## 3. Kies plug-ins vanuit een ontbrekende functie

Een plug-in kan een veld, zoekfilter, reviewformulier of beveiligingsfunctie toevoegen. Formuleer eerst wat de site moet kunnen. Controleer vervolgens in de officiële directory het onderhoud, compatibiliteit, gevraagde rechten, werking bij deactiveren en overlap met bestaande functies. Test na activeren de hoofdroute en houd de plug-in alleen als ze een aantoonbare taak oplost. Installeer niet meerdere registratie- of zoekplug-ins die hetzelfde CPT beheren.

Een score van een plug-in is geen projectbewijs. Beschrijf liever: **bezoekersvraag → gekozen functie → testresultaat → afhankelijkheden bij herstel**. Neem plug-incode en instellingen later mee in de back-up- en herstelprocedure.

## 4. Test rollen als echte handelingen

WordPress heeft standaard rollen zoals **Administrator**, **Editor**, **Author**, **Contributor** en **Subscriber**. Een Administrator kan normaal plug-ins en gebruikers beheren; een Editor kan gewone berichten en pagina's van anderen bewerken maar geen plug-ins installeren. Een Author kan eigen gewone berichten publiceren; een Contributor kan een concept indienen maar niet zelf publiceren. Plug-ins en CPT-registraties kunnen de rechten op jouw eigen contenttype veranderen. [WordPress' capabilitylijst](https://wordpress.org/documentation/article/roles-and-capabilities/) is het vertrekpunt, de test op jouw site het bewijs.

Maak als beheerder twee **aparte testaccounts** met unieke wachtwoorden en testadressen. Gebruik bijvoorbeeld Administrator en Editor voor een onderscheid in plug-inbeheer, en test daarnaast of de Editor werkelijk een catalogusitem kan wijzigen. Voor een redactionele stroom zijn Editor en Contributor leerzaam: Contributor dient een gewoon bericht in, Editor publiceert het. Beschrijf altijd welke inhoudsoort je test; het gedrag van gewone berichten bewijst niet automatisch de CPT-rechten.

| Rol | Verwachte toegestane actie | Verwachte geweigerde actie | Feitelijk resultaat |
| --- | --- | --- | --- |
| Editor | Een toegestaan item of bericht bewerken | Plug-in installeren | Zelf invullen |
| Contributor | Eigen gewoon bericht als concept indienen | Hetzelfde bericht publiceren | Zelf invullen |

Meld aan met het testaccount in een privévenster of apart browserprofiel. Controleer de ingelogde naam, probeer de actie via de gewone interface en noteer wat de server toelaat of weigert. Een verborgen menu alleen is onvoldoende bewijs; een rechtstreeks bekende beheer-URL mag evenmin een verboden wijziging toelaten. Geef nooit automatisch Administrator om één ontbrekend recht op te lossen. Een aangepaste rol is verdieping, geen minimumeis.

> **Kennischeck:** Waarom moet je bij een roltest zowel een toegestane als een geweigerde handeling uitvoeren?

## Projectwerk en bewijs

1. Schrijf één concrete catalogusvraag met verwachte treffers en uitsluitingen. Bouw een zoek- of filterroute die de bezoeker zelf kan gebruiken. Test een lege uitkomst en een terugweg.
2. Laat een medestudent de route uitvoeren op een telefoon en noteer waar uitleg nodig bleek. Herstel minstens één gevonden probleem.
3. Maak een reactie, review of beoordeling mogelijk op een passend detailitem. Test indiening, moderatie en publieke weergave met fictieve gegevens.
4. Maak minstens twee rollen met aantoonbaar verschillende rechten. Vul een matrix met toegestane en geweigerde handelingen in en test de eigen CPT afzonderlijk.
5. Noteer per gebruikte plug-in doel, versie, configuratie, benodigde data en gedrag bij deactiveren.

**Weekmijlpaal:** een werkende zoek- of filtertaak, werkende interactie met moderatiekeuze en een bewezen rolverschil. Toon live de route van vraag naar item, een gemodereerde reactie en de twee roltests.

## Veelvoorkomende fouten

| Symptoom | Eerste controle |
| --- | --- |
| Filter toont alle items | Controleer de gekozen term, de gekoppelde taxonomie en of het archief de templatequery volgt. |
| Zoekvak vindt geen CPT-items | Controleer CPT-instellingen en feitelijke zoekquery van thema of plug-in. |
| Reactie staat in beheer maar niet op de site | Controleer goedkeuringsstatus en Comments-weergave in de Single-template. |
| Een Editor ziet geen Games | Controleer de CPT-capabilities; verhoog de rol niet blind. |
| Alleen menuverschil is aangetoond | Test de onderliggende toegestane en geweigerde serverhandeling. |

## Zelfcontrole

1. Wanneer is een termarchief een bruikbare filterroute?
2. Welke drie lagen bepalen of reacties werken?
3. Waarom volstaat de standaardroltabel niet voor ieder CPT?
4. Is een SEO-, antispam- of rollenplug-in verplicht voor deze mijlpaal?

<details><summary>Antwoorden</summary>

1. Als bezoekers de term kunnen kiezen en de juiste gepubliceerde items zien, met terugweg naar de catalogus.
2. Toestemming, moderatie en publieke weergave.
3. Een CPT kan eigen capabilities gebruiken; plug-ins en code kunnen rechten aanpassen.
4. Nee. Alleen de werkende taak en onderbouwde keuze zijn vereist.

</details>

## Bronnen

- [Projectopdracht](../Opdracht/docker/projectopdracht.md)
- [WordPress: Query Loop](https://wordpress.org/documentation/article/query-loop-block/)
- [WordPress: reacties beheren](https://wordpress.org/documentation/article/comments-in-wordpress/)
- [WordPress: rollen en rechten](https://wordpress.org/documentation/article/roles-and-capabilities/)
- [WordPress: plug-ins kiezen](https://wordpress.org/documentation/article/manage-plugins/)
