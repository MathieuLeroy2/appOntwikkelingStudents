# Week 6 — Testen, documenteren en verdedigen

## Voor je begint

Je site voldoet in opzet aan de mijlpalen uit [week 1](../Ch1/Ch1-theorie.md) tot en met [week 5](../Ch5/Ch5-theorie.md). In deze laatste week controleer je het **werkelijke gedrag** en maak je de oplossing reproduceerbaar en uitlegbaar. De [projectopdracht](../Opdracht/docker/projectopdracht.md) bepaalt wat je tijdens de individuele verdediging laat zien. De site blijft op het interne netwerk; publieke zoekranking, een domeinnaam en Google Search Console zijn geen beoordelingsdoel.

## Leerdoelen en lesverloop

Na dit hoofdstuk kun je de kernroute op meerdere schermen en met toetsenbord testen, één gemeten prestatieprobleem aanpakken, inhoud en technische basis van SEO onderscheiden, een reproduceerbare README schrijven, tekortkomingen gericht herstellen en de site én infrastructuur zelfstandig demonstreren.

| Tijd | Onderwerp |
| --- | --- |
| 0–12 min | Bezoekersroute, toegankelijkheid en inhoud |
| 12–27 min | Functionele en technische tests |
| 27–40 min | Prestaties en gerichte verbetering |
| 40–52 min | README, oplevering en herstelbewijs |
| 52–60 min | Proefverdediging en kennischeck |

## 1. Test een echte bezoekersroute

Start als bezoeker in een privévenster. Bij PixelAtlas is de taak: **Home → Games → filter op Puzzel → open een game → lees kenmerken → dien een review in**. Kies voor jouw thema een even concrete taak. Test haar op telefoon, tablet en desktop, vanaf een toestel dat de LXC via het netwerk bereikt. Noteer per stap de URL, verwachte uitkomst en feitelijke uitkomst. Een mooi screenshot bewijst geen werkende filter of reactie.

Test minstens één **positief** en één **negatief** geval. Positief: de verwachte game verschijnt. Negatief: een item met uitsluitend de term Strategie hoort niet onder Puzzel, of een zoekterm zonder treffers krijgt een begrijpelijke melding. Controleer een detailpagina met lege optionele velden. Controleer dat de navigatie terug naar de catalogus voert en dat links niet naar `localhost` of de herstelomgeving wijzen.

Voor toegankelijkheid begin je bij de taak. Doorloop haar met **Tab, Shift+Tab en Enter**: is focus zichtbaar, is de volgorde logisch en zijn filters en knoppen bedienbaar? Controleer koppenstructuur, duidelijke linkteksten, labels bij formulieren, betekenisvolle alt-tekst en tekstcontrast. Een automatische tool kan problemen aanwijzen, maar beslist niet of een alt-tekst de juiste betekenis heeft of een route begrijpelijk is. Gebruik een lokaal bereikbare browser of extensie; een externe URL-checker kan de interne LXC doorgaans niet ophalen.

> **Kennischeck:** Waarom volstaat een toegankelijkheidsscore niet als bewijs dat je catalogustaak werkt?

## 2. Maak inhoud vindbaar zonder rankingclaims

Een paginatitel, zichtbare H1, heldere URL, passende tussenkoppen en interne links helpen bezoekers én zoekmachines de inhoud begrijpen. Schrijf voor een echte vraag, bijvoorbeeld “Welke coöperatieve games zijn geschikt voor twee spelers?”, en geef op de doelpagina een bruikbaar antwoord. Controleer de **gerenderde** titel en koppen; het excerpt in WordPress is niet automatisch een HTML-metabeschrijving.

Je site heeft mogelijk `/wp-sitemap.xml`, een `robots.txt`-antwoord of metadata van een SEO-plug-in. Bekijk wat daadwerkelijk aanwezig is. Een sitemap garandeert geen indexering, een canonical is geen redirect en `robots.txt` is geen toegangsbeveiliging. De interne LXC is niet publiek bereikbaar; claim dus geen Google-ranking of rich result. Een SEO-plug-in is alleen zinvol voor een concrete ontbrekende functie en mag geen overlap of foute canonical-URL introduceren.

Een eigen contenttype hoort in de navigatie en vindroute van bezoekers te passen. Controleer op de publieke pagina dat de titel, beschrijving, gestructureerde velden en termlinks overeenkomen met de echte iteminhoud. Onjuiste of lege metadata is slechter dan een bewust beperkte set.

## 3. Meet één probleem en verbeter het

Prestaties beoordeel je op de taak, niet alleen op een score. Open de site op een toestel dat het interne IP kan bereiken en gebruik de browserontwikkelaarstools. Meet dezelfde pagina vóór en na onder vergelijkbare omstandigheden. Kijk eerst naar grote afbeeldingen, onnodige plug-ins, scripts die de interactie vertragen en layoutverschuivingen. Een externe PageSpeed- of WebPageTest-dienst kan het interne adres meestal niet ophalen; er is ook geen publieke velddata voor deze testsite.

Optimaliseer afbeeldingen vóór upload met passende afmetingen en compressie zonder de inhoud onleesbaar te maken. Gebruik het juiste formaat voor foto of illustratie en behoud alt-tekst. Verwijder een plug-in niet blind omdat ze tijd kost: controleer of ze een projectfunctie levert. Een cachingplug-in kan statische pagina's versnellen, maar zoekresultaten, aanmelding, filters en reacties moeten actueel blijven. Test die functies opnieuw na een prestatie-ingreep.

Leg één verbetering vast als **probleem → meting of observatie → ingreep → hertest**. Voorbeeld: een cover van meerdere megabytes vertraagt de catalogus; na verkleinen blijft de kaart leesbaar en laadt de pagina aantoonbaar sneller. Een getal zonder vergelijkbare meetomstandigheden is zwak bewijs.

## 4. Maak de repository reproduceerbaar

Je repository bevat minstens `compose.yaml`, `.env.example`, `.gitignore`, eigen code of configuratie en een project-README. De README moet iemand anders laten begrijpen hoe de site opstart en waarom de inhoud terugkomt. Beschrijf:

1. Doelgroep, onderwerp en bezoekersroute.
2. Vereisten, SSH/LXC-context, Compose-opstart en URL met poort 8080.
3. Services, volumes, bind mounts en reden waarom MariaDB geen gepubliceerde poort heeft.
4. CPT, velden, taxonomieën of categorieën, minimaal tien items en gekozen zoek- of filteroplossing.
5. Interactie, moderatie en de rollenmatrix met toegestane en geweigerde tests.
6. Eigen CSS, thema en benodigde plug-ins met reden van gebruik.
7. Back-updatum, onderdelen, veilige opslag, herstelstappen en feitelijk herstelresultaat.
8. Testresultaten op drie schermgroottes en bekende beperkingen.

Een WordPress-site wordt deels in de database ingericht. Alleen Compose en thema-code in Git reconstrueren die instellingen en inhoud niet. Een XML-export vervangt de SQL- en bestandskopie uit week 5 evenmin. Lever **geen** echte wachtwoorden, ingevulde `.env`, databasekopie met persoonsgegevens of herstelcodes in Git in.

## 5. Oefen de individuele verdediging

Gebruik een korte, vaste volgorde zodat je elk beoordelingspunt live kunt aantonen:

1. Open de site vanaf een **ander toestel** en voer de route Home → catalogus → gevonden item → detail uit op klein en groot scherm.
2. Toon een werkende reactie, review of beoordeling met je moderatiekeuze.
3. Meld aan met twee testrollen en voer een toegestane én een geweigerde handeling uit.
4. Toon `compose.yaml`, `docker compose ps`, de twee volumes en de interne databaseverbinding.
5. Leg het verschil uit tussen heraanmaak met dezelfde volumes en herstel uit de aparte back-up. Open de herstelde testsite of toon controleerbaar herstelbewijs.
6. Licht één ontwerp- of prestatieverbetering toe en wijs de eigen CSS-aanpassing aan.

Gebruik testaccounts en noteer de volgorde in je README, maar schrijf wachtwoorden daar niet op. Als een live stap faalt, laat de relevante log of testnotitie zien, verklaar de vermoedelijke oorzaak en herstel gericht. De beoordeling gaat over de **werkende oplossing en jouw begrip**, niet over zoveel mogelijk uitbreidingen.

## Projectwerk en bewijs

1. Vul een testmatrix in voor de bezoekersroute op smartphone, tablet en desktop, inclusief toetsenbordbediening, een positieve en een lege zoek- of filteruitkomst.
2. Kies één gemeten of geobserveerd prestatie- of toegankelijkheidsprobleem, verbeter het en documenteer de hertest.
3. Laat een medestudent de README volgen om de start-, inhouds- en herstelprocedure te begrijpen; herstel onduidelijke stappen.
4. Voer de proefverdediging uit in de volgorde hierboven. Noteer welke live handeling nog faalt en los die op vóór oplevering.

**Weekmijlpaal:** definitieve oplevering. De repository en site zijn reproduceerbaar, de bezoekersroute en technische werking zijn getest en de individuele demonstratie kan zonder verborgen stappen worden uitgevoerd.

## Veelvoorkomende fouten

| Bevinding | Gerichte actie |
| --- | --- |
| Site werkt alleen op de eigen computer | Test opnieuw via LXC-IP en poort 8080 vanaf tweede toestel. |
| Filter lijkt te werken maar toont verkeerde items | Vergelijk verwachte treffers en uitsluitingen met de feitelijke resultaten. |
| Een automatische tool geeft groen terwijl Tab niet werkt | Test handmatig de volledige bezoekersroute met toetsenbord. |
| README noemt alleen `docker compose up` | Voeg inhoudsmodel, afhankelijkheden, back-up en herstelbewijs toe. |
| Herstelbewijs is enkel een volumelijst | Toon een herstelde site met database-inhoud én bestanden. |

## Zelfcontrole

1. Welke drie verschillende schermgroottes test je en waarom?
2. Waarom garandeert `/wp-sitemap.xml` geen publieke vindbaarheid?
3. Welke gegevens zitten mogelijk alleen in MariaDB en niet in Git?
4. Welke twee live tests tonen het verschil tussen persistentie en herstel?

<details><summary>Antwoorden</summary>

1. Smartphone, tablet en desktop; navigatie, tekst en interactie moeten op alle drie bruikbaar blijven.
2. De site is intern en een sitemap is slechts een ontdekkingssignaal, geen indexeringsgarantie.
3. Items, gebruikers, reacties, instellingen en sommige Site Editor-aanpassingen.
4. Containerheraanmaak met dezelfde volumes en een aparte site die uit SQL, bestanden en code is teruggezet.

</details>

## Verdieping na de minimumeisen

Een publiek domein vraagt DNS-records, netwerkroutering en HTTPS; een DNS-record alleen maakt de LXC niet publiek bereikbaar. Bij verhuizing van URL's zijn een volledige kopie, veilige URL-vervanging, redirects waar nodig en controles van mail en media belangrijk. Een aangepaste rol, gestructureerde data, eigen API of PWA kan een zinvolle uitbreiding zijn, maar is geen verborgen projectvereiste. Onderzoek zulke onderwerpen pas nadat de zes weekmijlpalen aantoonbaar werken.

## Bronnen

- [Projectopdracht](../Opdracht/docker/projectopdracht.md)
- [W3C: eerste toegankelijkheidschecks](https://www.w3.org/WAI/test-evaluate/preliminary/)
- [Google: SEO-startgids](https://developers.google.com/search/docs/fundamentals/seo-starter-guide)
- [WordPress: prestatieoptimalisatie](https://developer.wordpress.org/advanced-administration/performance/optimization/)
- [WordPress: Site Health](https://wordpress.org/documentation/article/site-health-screen/)
