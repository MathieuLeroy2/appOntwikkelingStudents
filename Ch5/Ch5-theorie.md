# Week 5 — Beveilig, bewaar en herstel je site

## Voor je begint

De catalogus, zoek- of filterroute, interactie en rollen uit [week 4](../Ch4/Ch4-theorie.md) werken. Nu maak je de site onderhoudbaar en bewijs je herstel uit een **afzonderlijke kopie**. De [projectopdracht](../Opdracht/docker/projectopdracht.md) vraagt een volledige back-up van database én benodigde WordPress-bestanden en een geslaagde hersteltest. Dit hoofdstuk gebruikt de Compose-opstelling uit week 1 met services `db` en `wordpress`. Pas paden en servicenamen aan je eigen project aan; controleer vooral bind mounts van eigen code.

## Leerdoelen en lesverloop

Na dit hoofdstuk kun je passende beveiligingsmaatregelen kiezen, updates met een herstelroute uitvoeren, de inhoud van database, volume en repository onderscheiden, een consistente back-up maken, een tweede Compose-project herstellen en met een bezoekersroute aantonen dat de kopie zelfstandig werkt.

| Tijd | Onderwerp |
| --- | --- |
| 0–12 min | Risico's, accounts, updates en plug-ins |
| 12–25 min | Opslagkaart en onderdelen van een back-up |
| 25–45 min | Back-up en herstel in een tweede project |
| 45–53 min | URL's, controles en beperkingen |
| 53–60 min | Demonstratie en kennischeck |

## 1. Beveilig vanuit een concreet risico

De site heeft meerdere lagen: de LXC, Docker, WordPress, MariaDB, thema's, plug-ins en accounts. Een beveiligingsplug-in kan een verkeerd gedeeld beheerderswachtwoord, een open databasepoort of een ontbrekende back-up niet repareren. Kies per risico een passende maatregel:

| Risico | Maatregel | Controle |
| --- | --- | --- |
| Gedeeld of zwak wachtwoord | Uniek wachtwoord in wachtwoordmanager; waar passend 2FA | Test login en herstelroute |
| Te brede rechten | Rollen uit week 4 en minimaal benodigde toegang | Test verboden én toegestane actie |
| Verouderde code | Gecontroleerde WordPress-, thema- en plug-inupdates | Test bezoekersroute na update |
| Spam of misbruik | Moderatie uit week 4, eventueel passende antispammaatregel | Dien fictieve testreactie in |
| Host- of dataverlies | Kopie buiten de LXC en hersteltest | Start herstelde site apart op |

Beoordeel een beveiligingsplug-in alleen voor een ontbrekende functie, zoals aanmeldbeperking of 2FA. Een scanner of WAF ziet niet automatisch de LXC, MariaDB of alle netwerkpaden. Een meldingsscore is een onderzoeksvraag, geen bewijs van veiligheid. Installeer niet meerdere overlappende plug-ins. Maak vóór updates een recente kopie en noteer welke versies je verandert. Gebruik op deze HTTP-testsite geen echte accounts of persoonsgegevens.

> **Kennischeck:** Waarom is een beveiligingsplug-in geen vervanging voor een hersteltest?

## 2. Teken de opslagkaart

Een WordPress-pagina komt uit verschillende bronnen:

| Bron | Voorbeelden | Nodig bij herstel? |
| --- | --- | --- |
| MariaDB in `db_data` | Items, gebruikers, reacties, instellingen, Site Editor-aanpassingen | Ja: consistente SQL-kopie |
| WordPress-bestanden in `wp_data` | Uploads, geïnstalleerde plug-ins en thema's | Ja: benodigde bestanden |
| Projectrepository | Compose, eigen plug-in, eigen thema, documentatie | Ja: juiste codeversie |
| Geheime lokale configuratie | `.env` | Ja: veilig opnieuw beschikbaar, nooit in Git |

Een WordPress XML-export kan inhoud overdragen, maar bevat niet automatisch alle instellingen, plug-ins en bestanden. Een named volume overleeft containerheraanmaak, maar staat nog op dezelfde host. Controleer `compose.yaml`: eigen code in bind mounts zit mogelijk **niet** in het `wp_data`-archief. Het voorbeeldarchief hieronder bevat alleen `wp-content`; neem eventuele eigen of gewijzigde bestanden daarbuiten afzonderlijk op. Leg de exacte codecommit en gebruikte image-tags vast. Maak geen directe kopie van een draaiende MariaDB-datamap; gebruik een database-export.

## 3. Maak een volledige kopie

Werk in de map met je `compose.yaml`. Kies een kort moment zonder nieuwe uploads of inhoudswijzigingen, zodat SQL en bestanden bij elkaar passen. Zet `backups/` in `.gitignore` en deel geen dump of ingevuld `.env`.

```bash
mkdir -p backups
chmod 700 backups
docker compose ps
docker compose exec -T db sh -c 'mariadb-dump --single-transaction -u"$MARIADB_USER" -p"$MARIADB_PASSWORD" "$MARIADB_DATABASE"' > backups/database.sql
docker compose exec -T wordpress tar -C /var/www/html -czf - wp-content > backups/wp-content.tar.gz
test -s backups/database.sql
test -s backups/wp-content.tar.gz
sha256sum backups/database.sql backups/wp-content.tar.gz > backups/SHA256SUMS
sha256sum -c backups/SHA256SUMS
chmod 600 backups/database.sql backups/wp-content.tar.gz backups/SHA256SUMS
```

Het databasewachtwoord wordt in de databasecontainer uit de omgeving gelezen; de SQL-dump zelf bevat wel gevoelige gegevens. `--single-transaction` geeft voor transactionele tabellen een consistente databaseweergave. Het bestandsarchief wordt op een ander moment gemaakt; voorkom daarom inhoudswijzigingen tijdens beide stappen. Controleer de shell-exitcodes en bestandsgrootte. Een checksum toont integriteit na kopiëren, **geen** werkende herstelprocedure.

Bewaar de dump, het archief, checksums en juiste codeversie ook op een door de opleiding toegestane afgeschermde plek **buiten de LXC**. Controleer de checksums na de overdracht. Leg vast waar de kopie staat zonder geheimen of persoonsgegevens in je repository te zetten. Een plug-inback-up op dezelfde LXC beschermt niet tegen verlies van de LXC.

## 4. Herstel in een tweede Compose-project

Laat de hoofdsite op poort 8080 werken. Maak een **afzonderlijke testmap** met de juiste repositoryversie en een eigen `.env` waarvan de toegang beperkt is. Kopieer de gecontroleerde back-up vanuit de afgeschermde opslag naar `backups/` in die testmap. Gebruik een **andere projectnaam**, **andere webpoort** en nieuwe named volumes. Controleer vóór starten dat je Compose-bestand geen `external: true`-volumes, vaste gedeelde volumenamen of schrijfbare bind mounts naar de bron heeft.

In de testkopie verander je alleen de hostpoort naar `8081:80`. De CLI-dienst hieronder is optioneel gereedschap voor veilige URL-vervanging; ze gebruikt dezelfde testdatabase en hetzelfde testvolume. Neem eventuele bind mounts van eigen plug-in- of themacode ook bij `cli` op zodat WordPress die code kan laden.

```yaml
  cli:
    image: wordpress:cli-php8.3
    profiles: [tools]
    user: "33:33"
    entrypoint: ["wp"]
    working_dir: /var/www/html
    environment:
      WORDPRESS_DB_HOST: db:3306
      WORDPRESS_DB_NAME: ${DB_NAME}
      WORDPRESS_DB_USER: ${DB_USER}
      WORDPRESS_DB_PASSWORD: ${DB_PASSWORD}
    volumes:
      - wp_data:/var/www/html
```

Controleer de gekozen image-tag vóór de les. Staat de eigen catalogusplug-in als bind mount in `wordpress`, voeg dezelfde mount onder `cli.volumes` toe. Voer vanuit de testmap uit:

```bash
docker compose -p cursus-herstel config --quiet
docker compose -p cursus-herstel up -d
docker compose -p cursus-herstel ps
docker compose -p cursus-herstel stop wordpress
docker compose -p cursus-herstel exec -T db sh -c 'mariadb -u"$MARIADB_USER" -p"$MARIADB_PASSWORD" "$MARIADB_DATABASE"' < backups/database.sql
docker compose -p cursus-herstel run --rm -T --no-deps --entrypoint tar wordpress -C /var/www/html -xzf - < backups/wp-content.tar.gz
```

Vervang de placeholders in de volgende opdrachten door de **exacte** bron- en doel-URL, inclusief poort. Doe eerst een dry run en controleer het aantal treffers. De wijziging raakt uitsluitend het herstelproject:

```bash
docker compose -p cursus-herstel --profile tools run --rm -T cli search-replace 'http://<LXC-IP>:8080' 'http://<LXC-IP>:8081' --all-tables-with-prefix --skip-columns=guid --dry-run
docker compose -p cursus-herstel --profile tools run --rm -T cli search-replace 'http://<LXC-IP>:8080' 'http://<LXC-IP>:8081' --all-tables-with-prefix --skip-columns=guid
docker compose -p cursus-herstel start wordpress
```

WP-CLI begrijpt ook geserialiseerde WordPress-waarden; een blinde tekstvervanging in een SQL-bestand kan die beschadigen. De `guid` is geen actuele permalink en wordt daarom overgeslagen. Krijg je nul treffers terwijl links nog naar de bron wijzen, controleer de werkelijke bron-URL en eventuele `WP_HOME`- of `WP_SITEURL`-overrides. Raak de broninstallatie niet aan. Bij een eerste importfout kan MariaDB nog niet gereed zijn; lees de logs en probeer opnieuw zodra ze klaar is.

## 5. Bewijs dat de kopie werkt

Open `http://<LXC-IP>:8081` vanaf een ander toestel. Test homepage, catalogus, detailpagina, afbeeldingen, aanmelding met testaccount, zoek-/filtertaak en een reactie. Vergelijk een herkenbaar item of reactie van **vóór** de back-up. Open daarna de bron op `:8080` en controleer dat die nog werkt. Maak eventueel een onschuldige marker alleen op de testsite en verifieer dat die niet op de bron verschijnt. Dat bewijst dat volumes en database gescheiden zijn.

Noteer in de project-README datum, codecommit, images, onderdelen in de kopie, opslagplek, exacte herstelstappen, testdatum, testrecord en resultaat per bezoekershandeling. Beschrijf beperkingen zoals externe plug-inlicenties of absolute URL's die nog extra werk vragen. Een geslaagde herstart met dezelfde volumes is **persistentie**; deze aparte test is **herstel uit back-up**.

## Projectwerk en bewijs

1. Controleer de beveiligingsbasis: unieke testwachtwoorden, passende rollen, updates en moderatie. Noteer per gekozen maatregel welk risico ze beperkt en hoe je de werking testte.
2. Maak de SQL- en bestandskopie, controleer beide bestanden en bewaar een afgeschermde kopie buiten de LXC. Noteer de bijbehorende codecommit en eventuele bind mounts.
3. Herstel op poort 8081 onder een andere Compose-projectnaam. Test een herkenbaar item, een upload, aanmelding en de zoek- of filterroute.
4. Leg de exacte stappen, testdatum, uitkomsten en afwijkingen vast in je project-README. Toon geen geheimen of persoonsgegevens.

**Weekmijlpaal:** een afgewerkte site met een gedocumenteerde en geslaagde herstelprocedure. Toon de bron op 8080, de herstelde kopie op 8081 en de teruggekomen database-inhoud én bestanden.

## Veelvoorkomende fouten

| Symptoom | Eerste controle |
| --- | --- |
| Herstelde site springt naar 8080 | Controleer URL-vervanging, site-instellingen en overrides. |
| Afbeeldingen ontbreken | Controleer `wp-content/uploads`, archief, bind mounts en absolute URL's. |
| CPT-archief geeft 404 | Controleer eigen plug-in/code en sla permalinks één keer op. |
| Wijziging op herstel verschijnt op bron | Stop test; onderzoek gedeelde volumes, database of bind mounts. |
| SQL-dump bestaat maar herstel faalt | Controleer databasegereedheid, importuitvoer en juiste projectnaam. |

## Zelfcontrole

1. Waarom heb je zowel SQL als bestanden en code nodig?
2. Waarom gebruik je een andere Compose-projectnaam én poort?
3. Wat bewijst `sha256sum -c`, en wat niet?
4. Waarom is een XML-export geen volledige back-up?

<details><summary>Antwoorden</summary>

1. Inhoud en instellingen staan in MariaDB; uploads en uitbreidingen staan in bestanden; eigen code kan in Git staan.
2. De test mag geen volumes, database of webpoort met de bron delen.
3. Dat de kopie dezelfde bytes heeft; niet dat WordPress ermee kan starten.
4. Ze bevat niet automatisch alle instellingen, plug-ins, thema's en benodigde bestanden.

</details>

## Bronnen

- [Projectopdracht](../Opdracht/docker/projectopdracht.md)
- [Docker: volumes](https://docs.docker.com/engine/storage/volumes/)
- [Docker: startvolgorde](https://docs.docker.com/compose/how-tos/startup-order/)
- [WordPress: bestanden back-uppen](https://developer.wordpress.org/advanced-administration/security/backup/files/)
- [WP-CLI: search-replace](https://developer.wordpress.org/cli/commands/search-replace/)
