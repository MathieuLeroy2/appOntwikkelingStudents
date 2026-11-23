# Labo 5 — Bewijs dat je site herstelbaar is

**Werktijd** 80–90 minuten, inclusief verslag.

Vertrek van je werkende site met catalogus, minstens één upload en de interactie uit [labo 4](../Ch4/Ch4-labo.md). Gebruik de [theorie van week 5](Ch5-theorie.md) als naslagwerk. Voorzie voldoende schijfruimte en een beschikbare webpoort voor het aparte herstelproject.

## Opdracht

Stel dat je oorspronkelijke WordPress-installatie verloren gaat. Een collega vraagt je om één actuele catalogusfiche met afbeelding terug te halen en te bewijzen dat ook de rest van de belangrijkste bezoekersroute werkt. Kies vooraf welke fiche en upload zichtbaar maken dat je de juiste versie hebt hersteld. Voer de proef uit in een apart Compose-project, terwijl de oorspronkelijke site bereikbaar blijft.

Breng in kaart waar jouw installatie de inhoud, bestanden, instellingen en eigen code bewaart. Een tweede persoon moet uit je verslag kunnen afleiden welke onderdelen bij dezelfde herstelset horen en welke gegevens zijn afgeschermd. Controleer ook één beveiligingsmaatregel die bij jouw installatie of doelgroep past.

## Wat moet werken?

- Je herstelset bevat een consistente databasekopie en de nodige WordPress-bestanden, waaronder uploads, thema’s en plug-ins. Leg vast welke bestanden of mappen uit bind mounts komen en welke versie van eigen code nodig is. Er is ook een afgeschermde kopie buiten de LXC met gecontroleerde integriteit.
- De herstelde site heeft een eigen Compose-projectnaam, webpoort, database en opslag. De bron blijft bereikbaar op poort 8080. Een wijziging in de herstelkopie verschijnt alleen daar.
- Op de URL van de herstelkopie werken de aanmelding, een herkenbaar catalogusitem met upload en een zoek- of filterroute. De links van die route blijven binnen de herstelkopie.
- Je toont met één controle hoe een maatregel op je site een concreet risico beperkt. Je kunt bijvoorbeeld aantonen dat MariaDB geen gepubliceerde poort heeft of dat een beperkte rol geen beheerhandeling kan uitvoeren.

### Aantonen tijdens het labo

| Controle | Wat je aantoont |
| --- | --- |
| Kopie buiten de LXC | Toon dat de bestanden daar aanwezig zijn en dat de integriteitscontrole slaagt. Leg uit welke afzonderlijke controle bewijst dat de kopie ook bruikbaar is. |
| Inhoud en bestanden | Vergelijk op bron en herstelkopie de gekozen fiche, minstens één ingevuld veld en het bijbehorende beeldbestand. |
| Werkende herstel-URL | Doorloop op de aparte poort de aanmelding en de route van catalogus naar het gekozen item. Controleer de URL’s na navigatie en eventuele redirects. |
| Gescheiden omgevingen | Gebruik een herkenbare testwijziging op de herstelkopie. Toon wat je daar ziet en bevestig dat de bron op poort 8080 haar eerdere staat behoudt. |

## Wat lever je in?

Schrijf in je projectrepository een eigen `labo-5.md`. Beschrijf stap voor stap hoe je de back-up maakte, controleerde, bewaarde en terugzette. Noteer de gebruikte commando’s of instellingen, de testdatum en hoe je eventuele afwijkingen oploste. Beschrijf waar de noodzakelijke gegevens en code vandaan komen, zodat iemand met de juiste toegang de procedure kan herhalen. Hou de back-upbestanden, je ingevulde `.env` en wachtwoorden buiten Git.

Voeg een opslagkaart toe met per onderdeel de oorspronkelijke locatie en de bijbehorende kopie of codeversie. Neem de URL’s van bron en herstelkopie op. Leg per controle vast wat je verwachtte en wat er werkelijk gebeurde. Beschrijf welk risico je koos, welke maatregel het beperkt en welk bewijs je daarvoor verzamelde.

**Extra uitdaging.** Gebruik een bestaande goedgekeurde testbijdrage van labo 4 als bijkomend herstelbewijs. Controleer de publieke weergave en de moderatiestatus in het beheer van de herstelkopie.
