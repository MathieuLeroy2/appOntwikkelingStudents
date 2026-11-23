# Week 3 — Van inhoudsmodel naar dynamische catalogus

## Voor je begint

In [week 2](../Ch2/Ch2-theorie.md) maakte je een bruikbare homepage en navigatie. Nu bouw je de verplichte dynamische kern. De [projectopdracht](../Opdracht/docker/projectopdracht.md) vraagt minstens één custom post type, relevante gestructureerde velden, minstens twee betekenisvolle categorieën of taxonomietermen, minstens tien uitgewerkte items en verschillende werkende weergaven. Het voorbeeld hieronder gebruikt games, maar dezelfde keuzes gelden voor recepten, films of auto's. De theorie en demonstratie passen in één uur; tien inhoudelijke items uitwerken is projectwerk daarna.

## Leerdoelen en lesverloop

Na deze week kun je een bezoekvraag vertalen naar post type, taxonomie, term, veld en vrije tekst; een CPT los van het thema registreren; een veld invullen en op de detailpagina tonen; het archief en een detailpagina controleren; en tien gevarieerde items plannen en publiceren.

| Tijd | Onderwerp |
| --- | --- |
| 0–10 min | Bezoekvraag en datamodel |
| 10–25 min | CPT, taxonomie en velden registreren |
| 25–43 min | Eén item invullen, archief en detail tonen |
| 43–52 min | Query Loop, termen en navigatie |
| 52–60 min | Controle van tien items en foutdiagnose |

## 1. Kies de juiste opslagvorm

De vraag “Welke puzzelgames zijn voor twee spelers?” vraagt een betrouwbare manier om **genre** en **spelersaantal** vast te leggen. Een CPT `Game` geeft elk item een eigen beheerroute, titel, status en URL. De taxonomie `Genre` groepeert games; `Puzzel` is één term. `Spelersaantal` is een getalveld omdat je exacte aantallen wilt vergelijken. Een beoordeling of uitleg blijft vrije tekst in de editor.

| Vraag | PixelAtlas | Receptenplatform |
| --- | --- | --- |
| Wat is één item? | Game (CPT) | Recept (CPT) |
| Welke groep? | Genre: Puzzel, Strategie | Maaltijd: Ontbijt, Avondeten |
| Welke exacte waarde? | Spelersaantal: 2 | Bereidingstijd: 35 minuten |
| Welke vrije inhoud? | Waarom geschikt? | Werkwijze en tips |

De opdracht vraagt **minstens twee betekenisvolle categorieën of taxonomietermen**, geen verplicht aantal aparte taxonomieën en geen vast aantal velden. Eén passende taxonomie met minstens twee bruikbare termen kan dus volstaan. Voeg een tweede taxonomie of extra veld toe wanneer een concrete bezoekersvraag dat nodig maakt. Voor een numerieke waarde kies je een vaste eenheid; schrijf niet afwisselend “2 uur” en “120 minuten” als je later wilt sorteren.

Maak een kleine datadictionary: naam, type, voorbeeldwaarde, doel en plek op de publieke site. Leg daarnaast vast welke items in welke groepen vallen. Tien items met identieke dummytekst bewijzen geen werkende catalogus.

> **Kennischeck:** Waarom is “Puzzel” een term en “2 spelers” meestal een veld?

## 2. Registreer het contenttype buiten het thema

WordPress raadt aan de registratie van een custom post type in een **plug-in** te plaatsen. Zo blijft het type beschikbaar na een themawissel. Het bijgeleverde [kleine lesvoorbeeld](voorbeeldcatalogus.php) registreert `cursus_game`, de taxonomie `cursus_genre` en twee velden. Het is een oefenroute, geen voorgeschreven eindmodel. De [PixelAtlas-plug-in](../Opdracht/docker/wp-content/plugins/pixelatlas-core/pixelatlas-core.php) toont een uitgebreidere uitwerking.

Gebruik voor je eigen project óf een goed onderhouden registratie- en veldenoplossing óf eigen code. Registreer hetzelfde CPT niet op twee manieren tegelijk. De technische sleutel, bijvoorbeeld `cursus_game`, is stabiel, kort en uniek; het zichtbare label kan “Games” zijn. `show_in_rest` maakt de blokeditor beschikbaar; `has_archive` maakt de archiefroute mogelijk; `supports` bepaalt onder meer titel, editor, afbeelding en reacties. Een CPT schept niet vanzelf een filter of fraai ontwerp.

### Voer het lesvoorbeeld uit

Maak in **je eigen projectrepository** de map `plugins/cursus-catalogus/` en kopieer de inhoud van [voorbeeldcatalogus.php](voorbeeldcatalogus.php) naar `plugins/cursus-catalogus/cursus-catalogus.php`. Voeg onder de bestaande `wordpress.volumes` in `compose.yaml` deze bind mount toe:

```yaml
      - ./plugins/cursus-catalogus:/var/www/html/wp-content/plugins/cursus-catalogus:ro
```

Bewaar de code in Git. Controleer met `docker compose config --quiet` en voer `docker compose up -d` uit zodat de nieuwe mount beschikbaar is. Activeer **Cursuscatalogus (voorbeeld)** onder **Plug-ins**. Kies onder **Instellingen → Permalinks** een leesbare structuur zoals **Berichtnaam** als de site nog `Plain` gebruikt, en sla de instellingen één keer op om de nieuwe archiefroute te registreren. Test bestaande links na een wijziging van de structuur. Maak **geen gewone pagina** met slug `games`, want die zou met het archief `/games/` concurreren. Gebruik je al een eigen CPT of een andere plug-in, maak geen duplicaat: vergelijk je model met dit voorbeeld.

Het voorbeeld zet `public`, `show_in_rest` en `has_archive` bewust aan. Het koppelt Genre aan Game en voegt een invoervak voor **Studio** en een numeriek invoervak voor **Aantal spelers** toe. Bij bewaren controleert de code nonce en bewerkrechten en verwerkt ze invoer voordat ze wordt opgeslagen. De shortcode ontsnapt de waarden bij uitvoer en laat lege velden weg. Deze stappen horen bij veilige veldverwerking; rechtstreeks `$_POST` afdrukken hoort niet bij de opdracht.

## 3. Maak één item van invoer tot publieke pagina

1. Maak onder **Games → Genres** minstens de termen **Puzzel** en **Strategie** met duidelijke namen. Zijn je groepen anders, kies dan eigen passende termen.
2. Maak **Games → Nieuw**. Vul titel en inhoud in, selecteer één term en geef in **Gamegegevens** een studio en positief geheel aantal spelers op. Voeg waar zinvol een uitgelichte afbeelding met gebruiksrecht en passende alt-tekst toe.
3. Zet in de iteminhoud een **Shortcode**-blok met `[cursus_gamegegevens]`. Publiceer en open de **publieke** detail-URL. De shortcode leest de opgeslagen velden en toont ze als lijst. Laat je één optioneel veld leeg, dan hoort er geen leeg label op de pagina te staan.
4. Open `/games/`. Het archief hoort een link naar het nieuwe item te tonen. Open de termlink of `/genre/puzzel/` en controleer dat alleen passend ingedeelde items verschijnen.

Dit is het volledige pad **veld aanmaken → invoeren → bewaren → tonen → controleren**. In een eigen thema kun je dezelfde waarden rechtstreeks met `get_post_meta()` in een Single-template tonen, zoals PixelAtlas doet. Bij een blokthema moet de Single-template het **Content/Berichtinhoud**-blok tonen, anders ontbreekt de iteminhoud en dus ook de shortcode. De editorinstelling bewijst nog niet wat de bezoeker ziet.

Een archief is een lijst van items; een **detailpagina** toont één item; een **termarchief** toont items met een gekozen term. Daarmee ontstaan minstens homepage, catalogus en detailpagina als functioneel verschillende weergaven. Test het archief ook met meer dan één item en op mobiel.

## 4. Maak de lijst dynamisch en vindbaar

Een **Query Loop** selecteert items en herhaalt voor elk item een Post Template. Op een archief- of zoektemplate laat je de loop doorgaans de **templatequery** volgen, zodat de gekozen term of zoekvraag behouden blijft. Op een losse homepage-sectie “Nieuwste games” kies je een **Custom** Query Loop met je CPT als post type. Zorg dat titel of afbeelding naar het item linkt. Voeg bij een groeiende lijst paginering en een bruikbare melding voor geen resultaten toe.

Een vaste Query Loop-filter op “Puzzel” is **geen bezoekersfilter**: bezoekers kunnen de selectie niet wijzigen. Een gelinkte termarchiefroute biedt wel een eenvoudige filtertaak: kies Puzzel, bekijk de bijbehorende games en keer terug naar Alle games. Een zoekformulier of uitgebreider filter bouw je in [week 4](../Ch4/Ch4-theorie.md). Voeg de werkende archiefroute nu aan de navigatie toe. Controleer een term met resultaten en, waar relevant, een lege uitkomst.

## Projectwerk en bewijs

1. Schrijf twee echte bezoekersvragen en maak een datadictionary. Kies minstens één CPT, betekenisvolle velden en minstens twee bruikbare categorieën of taxonomietermen. Motiveer elke keuze.
2. Registreer het CPT los van het thema. Gebruik het lesvoorbeeld alleen als het bij je onderwerp past; documenteer je eigen plug-ins, sleutels en benodigde code.
3. Maak **minstens tien inhoudelijk uitgewerkte CPT-items** met verschillende inhoud, termwaarden en veldwaarden. Gebruik geen tien bijna identieke kopieën.
4. Toon een archief en detailpagina. Controleer voor twee verschillende items titel, inhoud, afbeelding, velden en termlinks. Test een bewust leeg optioneel veld.
5. Test de route Home → catalogus → item op telefoon en desktop en noteer de uitkomst.

**Weekmijlpaal:** een dynamische catalogus met detailpagina's en minstens tien uitgewerkte items. Toon de registratie, datadictionary, twee contrasterende items en de publieke bezoekersroute. Een uitgebreid zoek- of filterformulier en interactie volgen in week 4.

## Veelvoorkomende fouten

| Symptoom | Eerste controle |
| --- | --- |
| Games ontbreken in de editor | Plug-in actief, CPT-registratie, rolrechten en `show_in_rest`. |
| `/games/` geeft 404 | `has_archive`, unieke slug en permalinks één keer opslaan. |
| Veld staat in beheer maar niet publiek | Shortcode in de iteminhoud, Content-blok in de template en ingevulde waarde. |
| Term verschijnt niet bij Game | Taxonomie aan het juiste CPT gekoppeld en `show_in_rest` actief. |
| Query Loop toont op elk termarchief alles | Gebruik de templatequery in het archieftemplate. |

## Zelfcontrole

1. Welke gegevens horen in een CPT, taxonomie, term, veld en vrije tekst?
2. Waarom registreer je het CPT buiten het thema?
3. Waarom bewijst een ingevuld metaboxveld nog geen werkende detailpagina?
4. Waarom is een vaste Query Loop-selectie geen bezoekersfilter?

<details><summary>Antwoorden</summary>

1. Een item is een CPT-object; een taxonomie groepeert; een term is een groepswaarde; een veld bewaart een specifieke waarde; vrije tekst geeft context.
2. Bij een themawissel blijft de inhoud bereikbaar en de registratie actief.
3. De template en uitvoercode moeten de opgeslagen waarde nog tonen; controleer de publieke pagina.
4. De bezoeker kan de vaste selectie niet zelf veranderen.

</details>

## Bronnen

- [Projectopdracht](../Opdracht/docker/projectopdracht.md)
- [WordPress: custom post types registreren](https://developer.wordpress.org/plugins/post-types/registering-custom-post-types/)
- [WordPress: taxonomieën](https://developer.wordpress.org/plugins/taxonomies/working-with-custom-taxonomies/)
- [WordPress: metadata en metaboxen](https://developer.wordpress.org/plugins/metadata/custom-meta-boxes/)
- [WordPress: Query Loop](https://wordpress.org/documentation/article/query-loop-block/)
