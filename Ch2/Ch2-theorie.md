# Week 2 — Een bruikbare website ontwerpen

## Voor je begint

Je WordPress-site uit [week 1](../Ch1/Ch1-theorie.md) draait op de eigen LXC. Nu ontwerp je de eerste bezoekersroute. PixelAtlas krijgt Home, een route naar de toekomstige gamecatalogus en een Over-pagina. Voor een receptenplatform vervang je games door recepten; de keuze tussen pagina, inhoud en template blijft dezelfde. De [projectopdracht](../Opdracht/docker/projectopdracht.md) vraagt een homepage, duidelijke navigatie, responsive ontwerp en minstens één zichtbare eigen CSS-aanpassing. De catalogus zelf volgt in week 3.

## Leerdoelen en lesverloop

Na dit hoofdstuk kun je pagina's en berichten doelgericht gebruiken, een homepage en navigatie opbouwen, inhoud van templates onderscheiden, een thema en media beoordelen, een kleine eigen CSS-regel toepassen en de hoofdroute op drie schermgroottes testen.

| Tijd | Onderwerp |
| --- | --- |
| 0–10 min | Bezoekersroute, pagina versus bericht |
| 10–24 min | Blokeditor, media, homepage en navigatie |
| 24–40 min | Blokthema, templates, gedeelde onderdelen en stijlen |
| 40–52 min | Eigen CSS en responsive controle |
| 52–60 min | Demonstratie en kennischeck |

## 1. Ontwerp de route vóór de blokken

Schrijf één taak op die een bezoeker later moet kunnen voltooien: “Vind een puzzelgame en lees waarom ze geschikt is.” De route wordt **Home → Games → detailpagina**. Een bezoeker moet op ieder punt begrijpen waar hij is en wat hij daarna kan doen. Week 2 bouwt de eerste schakel; week 3 voegt de dynamische catalogus toe. Een mooie homepage zonder route naar inhoud is nog geen bruikbaar platform.

Een **pagina** bevat relatief vaste inhoud, bijvoorbeeld Home of Over. Een **bericht** past bij nieuws of een doorlopende publicatiestroom. Maak geen gewone pagina met dezelfde URL-slug als het toekomstige contenttype-archief, bijvoorbeeld `/games/`; dat archief krijgt in week 3 zijn eigen route. Een gewone landingspagina kan wel een andere slug krijgen, zoals `/over-de-catalogus/`.

Schrijf inhoud voor de bezoeker: een herkenbare H1, korte intro, betekenisvolle tussenkoppen en links met een duidelijk doel. Gebruik geen kopblok alleen om tekst groot te maken. Eén H1 voor de paginatitel is een goede basis; controleer de uiteindelijke HTML, want het thema kan de titel al als H1 tonen.

> **Kennischeck:** Waarom is “Klik hier” minder bruikbaar als linktekst dan “Bekijk alle games”?

## 2. Maak inhoud in de blokeditor

Onder **Pagina's → Nieuwe pagina** schrijf je de unieke inhoud van Home. De **blokeditor** beheert deze pagina-inhoud. Een Alinea, Kop, Afbeelding, Groep of Kolommen-blok heeft eigen instellingen. In de **Lijstweergave** zie je welk blok ouder of kind is. Een Groep kan bijvoorbeeld een achtergrond en padding voor een hele introductiesectie dragen; het bijbehorende kind Kop houdt zijn eigen tekst.

Gebruik patronen wanneer dezelfde **structuur** nuttig is. Een niet-gesynchroniseerd patroon geeft een startlayout die je per plaats wijzigt. Een gesynchroniseerd patroon deelt inhoud en opbouw; een wijziging kan overal verschijnen. Kies bewust: een herbruikbare oproep “Bekijk de catalogus” kan gesynchroniseerd zijn, terwijl drie verschillende itemintro's dat meestal niet zijn.

Upload afbeeldingen met een heldere bestandsnaam, passend formaat en gebruiksrecht. Geef betekenisvolle afbeeldingen een alt-tekst die hun functie in deze context weergeeft; decoratieve beelden hoeven geen herhaling van de omliggende tekst. “Niet gekoppeld” in de mediabibliotheek betekent niet automatisch ongebruikt: een beeld kan in een template, patroon of veld staan.

## 3. Stel homepage en navigatie in

Maak een Home-pagina en eventueel een Blog-pagina als je nieuws gebruikt. Kies onder **Instellingen → Lezen** een statische homepage en wijs Home aan. Een aangewezen berichtenpagina toont de berichtenlijst; haar eigen editorinhoud is doorgaans niet de zichtbare bloginhoud. Controleer dus de publieke pagina. De homepage-instelling kiest *welke inhoud* vooraan staat; het thema of de template bepaalt *hoe* die wordt getoond.

Maak een klein menu met echte bestemmingen: Home, Over en later Catalogus. Bij een blokthema beheer je de navigatie via **Weergave → Editor → Navigatie** of het Navigatie-blok. Bij een klassiek thema kan **Weergave → Menu's** beschikbaar zijn. Zet geen `#` of `##` als schijnlink in het menu. Test met Tab en Enter en op telefoonbreedte of alle items bereikbaar zijn. Voeg de cataloguslink in week 3 pas toe wanneer het archief bestaat.

Een header en footer zijn vaak gedeelde **templateonderdelen**. Wijzig je hun inhoud, dan veranderen meerdere pagina's. Maak ze kort en bruikbaar: logo of sitetitel, navigatie, en in de footer relevante contact- of broninformatie. Voeg geen lege sociale pictogrammen toe.

## 4. Begrijp het thema en de Site Editor

Een **thema** levert presentatie. Een **blokthema** biedt doorgaans **Weergave → Editor** voor templates, templateonderdelen, navigatie en globale stijlen. Een **klassiek thema** gebruikt PHP-templates en vaak de Customizer of een eigen instellingenscherm. De PixelAtlas-demo is klassiek; de onderstaande Site Editor-stappen zijn voor een blokthema. Wissel niet midden in een bestaande site van thema alleen om een editor te zien.

Een **template** bepaalt de gedeelde structuur van een paginatype. Het blok **Content/Berichtinhoud** toont daarin de eigen tekst van de huidige pagina of het huidige bericht. Plak de tekst van Over niet rechtstreeks in de gedeelde Page-template, want dan kan die op alle pagina's verschijnen. De **Site Editor** wijzigt templates en globale stijlen; de gewone blokeditor wijzigt een individueel inhoudsitem. Controleer vóór opslaan welke onderdelen WordPress wil bewaren en welke pagina's de wijziging raakt.

Kies een leesbaar kleurenpalet, consistente typografie en zichtbare links. Het **Stijlboek** laat voorbeelden van blokken zien, maar bewijst niet dat je eigen pagina's op mobiel werken. Bekijk de gepubliceerde site met echte tekst en beelden. Bij een klassiek thema leg je dezelfde keuzes vast in de themastijlen en templates.

## 5. Voeg één eigen CSS-aanpassing toe

De projectopdracht vereist een **zichtbaar werkende eigen CSS-aanpassing**. Kies een concrete ontwerpreden, bijvoorbeeld een duidelijk herkenbare intro voor de catalogus. Geef het omvattende Groep-blok via **Geavanceerd → Extra CSS-klasse(n)** de klasse `project-intro` (zonder punt). Voeg bij een blokthema onder **Stijlen → Aanvullende CSS**, of bij een klassiek thema in je eigen stylesheet, deze regel toe:

```css
.project-intro {
  border-inline-start: 0.3rem solid #176b64;
  padding-inline-start: 1rem;
}
```

De klasse beperkt het effect tot die sectie. Kies een kleur die bij jouw thema voldoende contrast heeft. Controleer vóór en na op een breed en smal scherm. Noteer in je README **welk probleem** de regel oplost en waar de code staat. Een thema-instelling aanklikken is geen eigen CSS.

## Projectwerk en bewijs

1. Schrijf je primaire bezoekersroute en teken een menu met echte URL's. Maak Home en een betekenisvolle Over-pagina; extra pagina's zijn alleen nodig als je concept ze vraagt.
2. Stel Home als statische homepage in. Bouw een introductie met kop, uitleg en een werkende vervolgstap. Gebruik één doelgericht patroon of groep, en controleer het wijzigingsbereik.
3. Kies een geschikt thema en documenteer waarom het jouw inhoud en mobiele route ondersteunt. Gebruik rechtmatig verkregen, geoptimaliseerde media met passende alt-tekst.
4. Voeg de CSS-aanpassing toe. Test publieke Home, Over, header en footer op smartphone, tablet en desktop. Gebruik daarnaast toetsenbordnavigatie.
5. Bewaar screenshots of korte testnotities van de drie schermgroottes en één concrete verbetering.

**Weekmijlpaal:** een eerste bruikbare versie met homepage, navigatie en gekozen visuele richting. De CSS-aanpassing is zichtbaar en de belangrijkste route blijft op een klein scherm bedienbaar. Een werkende dynamische catalogus volgt in week 3.

## Veelvoorkomende fouten

| Symptoom | Oorzaak en controle |
| --- | --- |
| De tekst van Over staat op elke pagina | Tekst werd in een gedeelde Page-template geplaatst in plaats van in de Over-pagina. |
| Home toont nog recente berichten | Controleer **Instellingen → Lezen** en de gepubliceerde Home-pagina. |
| Een nieuwe pagina ontbreekt in het menu | Voeg haar bewust toe aan de navigatie en test de publieke site. |
| De header wijzigde overal | Een gedeeld templateonderdeel werd aangepast; controleer de gebruikte templates. |
| Kolommen lopen buiten beeld | Controleer inhoudsbreedte, omloop en leesvolgorde op mobiel. |

## Zelfcontrole

1. Waar bewerk je de unieke tekst van Over, en waar de gedeelde header?
2. Wat is het verschil tussen een gesynchroniseerd patroon en een gewone gekopieerde layout?
3. Waarom moet je de CSS op de publieke site en op mobiel controleren?
4. Welke stap blijft in week 3 nodig voordat de menulink naar Games werkt?

<details><summary>Antwoorden</summary>

1. Over in de pagina-editor; de gedeelde header in het templateonderdeel of de themacode.
2. Een gesynchroniseerd patroon deelt wijzigingen; een gewone kopie blijft lokaal aanpasbaar.
3. De editor toont niet alle werkelijke schermbreedtes en het effect kan elders of bij lange tekst misgaan.
4. Het contenttype en zijn werkende archiefroute maken en testen.

</details>

## Bronnen

- [Projectopdracht](../Opdracht/docker/projectopdracht.md)
- [WordPress: Site Editor](https://wordpress.org/documentation/article/site-editor/)
- [WordPress: blokeditor](https://wordpress.org/documentation/article/wordpress-block-editor/)
- [WordPress: leesinstellingen](https://wordpress.org/documentation/article/settings-reading-screen/)
- [WordPress: navigatieblok](https://wordpress.org/documentation/article/navigation-block/)
