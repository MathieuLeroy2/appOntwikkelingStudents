# Week 1 — WordPress op de eigen server

## Voor je begint

In zes weken bouw je individueel een WordPress-platform rond een eigen onderwerp. Je werkt vanaf vandaag op de toegewezen Debian-LXC. De [projectopdracht](../Opdracht/docker/projectopdracht.md) bepaalt de minimumeisen en beoordeling. PixelAtlas, de [uitgewerkte gamecatalogus](../Opdracht/docker/README.md), is ons doorlopende voorbeeld; een recepten-, film- of sportplatform is even geldig. Het theorie-uur duurt maximaal 60 minuten. De installatie en controles daarna zijn begeleid projectwerk. Gebruik op de interne HTTP-site uitsluitend testaccounts en testgegevens.

## Leerdoelen en lesverloop

Na deze week kun je uitleggen waarom een CMS inhoud, presentatie en functies beheert; browser, LXC, WordPress, MariaDB, netwerkpoort en volumes aanwijzen; via SSH een Compose-project starten; de installatie vanaf een tweede toestel controleren; en het verschil tussen blijvende opslag en een back-up uitleggen.

| Tijd | Onderwerp |
| --- | --- |
| 0–10 min | CMS, WordPress en het projectresultaat |
| 10–22 min | Browser, server, containers, database en opslag |
| 22–42 min | Compose-bestand, geheimen en eerste start demonstreren |
| 42–52 min | WordPress-installatie en dashboard |
| 52–60 min | Tweede toestel, persistentie en kennischeck |

## 1. Wat bouw je?

Een **contentmanagementsysteem** (CMS) laat redacteurs inhoud beheren zonder voor ieder item een apart HTML-bestand te schrijven. Bij PixelAtlas heeft elke game een titel, beschrijving en later gestructureerde kenmerken. Het thema bepaalt hoe die gegevens verschijnen; plug-ins of eigen code voegen functies toe. Een themawissel mag het inhoudsmodel daarom niet laten verdwijnen. WordPress heeft standaard pagina's, berichten, media, reacties en gebruikers. In week 3 maak je een eigen contenttype voor de catalogus.

Een **pagina** is geschikt voor vaste informatie zoals Over. Een **bericht** hoort bij een publicatiestroom zoals nieuws. Een catalogusitem wordt later een **custom post type**. Deze keuze voorkomt dat een verzameling games als gewone blogberichten wordt vermomd. Een CMS bespaart herhaling, maar vraagt onderhoud, toegangsbeheer en herstelbare data.

Je hoeft voor de opdracht geen domein of commerciële hosting te kopen. De LXC heeft een adres op het interne opleidingsnetwerk. De browser bezoekt `http://<LXC-IP>:8080`; DNS en een publiek domein zijn pas relevant bij een andere hostingopstelling. HTTP versleutelt de verbinding niet, dus gebruik geen echte gebruikersgegevens.

> **Kennischeck:** Welke gegevens blijven van één game bestaan als je het thema verandert, en welke onderdelen van de vormgeving kunnen wijzigen?

## 2. Volg één verzoek door de architectuur

```text
browser op tweede toestel
        │ HTTP naar <LXC-IP>:8080
        ▼
Debian-LXC ─ Docker Compose
        ├─ wordpress: Apache, PHP, WordPress → wp_data
        └─ db: MariaDB                    → db_data
             alleen op het Compose-netwerk
```

De **browser** vraagt een pagina op. Apache en PHP in de WordPress-container voeren WordPress uit. WordPress haalt inhoud en instellingen uit MariaDB. De twee services vinden elkaar via de servicenaam `db`; `localhost` in de WordPress-container verwijst naar die container zelf. Alleen de webpoort is aan de LXC gekoppeld. MariaDB krijgt **geen** `ports`-mapping.

Een **named volume** bewaart data na het opnieuw aanmaken van een container. `wp_data` bevat onder meer uploads, thema's en plug-ins; `db_data` bevat de database. Eigen code kan daarnaast via een bind mount uit de projectmap komen. Een volume is geen onafhankelijke back-up: beschadigde of gewiste data blijft er ook in staan. In week 5 herstel je een afzonderlijke kopie.

## 3. Meld je aan en maak de projectbestanden

De opleiding levert de LXC met Docker en Compose vooraf getest op. Gebruik je eigen SSH-gegevens en verifieer een onverwacht gewijzigde host fingerprint met de lesgever.

```bash
ssh jouw_gebruikersnaam@<LXC-IP>
docker --version
docker compose version
mkdir -p ~/wordpress-project
cd ~/wordpress-project
```

Maak in deze map `compose.yaml` met de didactische image-tags uit de projectopdracht. De lesgever controleert vóór de onderwijsperiode of ze nog beschikbaar en passend zijn.

```yaml
services:
  db:
    image: mariadb:11.4
    restart: unless-stopped
    environment:
      MARIADB_DATABASE: ${DB_NAME}
      MARIADB_USER: ${DB_USER}
      MARIADB_PASSWORD: ${DB_PASSWORD}
      MARIADB_ROOT_PASSWORD: ${DB_ROOT_PASSWORD}
    volumes:
      - db_data:/var/lib/mysql

  wordpress:
    image: wordpress:php8.3-apache
    restart: unless-stopped
    depends_on:
      - db
    ports:
      - "8080:80"
    environment:
      WORDPRESS_DB_HOST: db:3306
      WORDPRESS_DB_NAME: ${DB_NAME}
      WORDPRESS_DB_USER: ${DB_USER}
      WORDPRESS_DB_PASSWORD: ${DB_PASSWORD}
    volumes:
      - wp_data:/var/www/html

volumes:
  db_data:
  wp_data:
```

`8080:80` betekent LXC-poort 8080 naar containerpoort 80. `depends_on` regelt hier **startvolgorde**, niet de gereedheid van MariaDB. Een healthcheck met `service_healthy` kan later op gereedheid wachten. Bij een eerste databasefout controleer je de logs en probeer je opnieuw zodra MariaDB klaar is.

Maak een deelbaar `.env.example`:

```dotenv
DB_NAME=wordpress
DB_USER=wpuser
DB_PASSWORD=VUL_EEN_EIGEN_WACHTWOORD_IN
DB_ROOT_PASSWORD=VUL_EEN_ANDER_WACHTWOORD_IN
```

Maak `.gitignore` met minstens `.env` en `backups/`. Kopieer het voorbeeld naar `.env`, vul twee verschillende, unieke wachtwoorden in en beperk de toegang:

```bash
cp .env.example .env
chmod 600 .env
docker compose config --quiet
docker compose up -d
docker compose ps
```

Het ingevulde `.env`-bestand en een databasekopie horen niet in Git. `docker compose config` **zonder** `--quiet` kan geheimen tonen; gebruik die uitvoer niet in je verslag. Bij problemen lees je `docker compose logs --tail=100 db` en `docker compose logs --tail=100 wordpress`, en verwijder je gevoelige gegevens vóór je uitvoer deelt.

## 4. Rond WordPress af en verken het beheer

Open `http://<LXC-IP>:8080` vanaf een toestel dat de LXC kan bereiken. Doorloop de installatiewizard met een fictieve sitetitel en een apart sterk testwachtwoord voor de beheerder. Noteer de **werkelijke URL**: een installatie op `localhost` zou bezoekers op een ander toestel naar hun eigen computer sturen.

Log in op `/wp-admin`. De **publieke site** toont wat bezoekers zien; het **dashboard** is voor beheer. Onder **Berichten** schrijf je een publicatiestroom, onder **Pagina's** vaste inhoud, onder **Media** beheer je uploads, onder **Reacties** de moderatie, onder **Weergave** het thema, onder **Plug-ins** uitbreidingen en onder **Gebruikers** accounts. De precieze menu's hangen van je rol en thema af. In week 2 gebruik je de blokeditor en, bij een blokthema, de Site Editor.

Stel een herkenbare sitetitel en de juiste tijdzone in onder **Instellingen → Algemeen**. Verander de WordPress-URL of Site-URL niet op goed geluk: een onjuist adres kan aanmelden en links verstoren. Controleer daarna in een privévenster wat een bezoeker ziet.

## Projectwerk en bewijs

1. Teken je eigen browser → LXC → `wordpress` → `db`-route en wijs de twee volumes aan.
2. Toon `docker compose ps` met beide services en controleer dat alleen WordPress poort 8080 publiceert.
3. Open de site vanaf een **ander** toestel op het interne netwerk. Noteer toestel, URL en resultaat.
4. Maak een onschuldig testbericht. Maak vervolgens alleen de WordPress-container opnieuw aan met `docker compose up -d --force-recreate wordpress` en controleer dat het bericht bestaat. Verwijder geen volumes.
5. Leg in je project-README vast hoe je start en waar Compose, code en gegevens staan. Bewaar wachtwoorden buiten die README.

**Weekmijlpaal:** een werkende WordPress-installatie op de eigen Debian-LXC, bereikbaar vanaf een tweede toestel. Toon de URL, beide containers en één bewaard testbericht. Dit bewijst persistentie; de hersteltest volgt in week 5.

## Veelvoorkomende fouten

| Symptoom | Eerste controle |
| --- | --- |
| `docker` ontbreekt of geeft geen toegang | Meld de toestand van de vooraf ingerichte LXC aan de lesgever. |
| WordPress toont kort een databasefout | Controleer `db`-logs; `depends_on` wacht niet op gereedheid. |
| Tweede toestel bereikt de site niet | Controleer LXC-IP, poort 8080, netwerkroute en firewall. |
| Links springen naar `localhost` | Controleer de URL van de oorspronkelijke installatie; plan een WordPress-geschikte URL-vervanging. |
| Gegevens verdwijnen na heraanmaak | Controleer de werkelijke volumemounts en Compose-projectnaam. |

## Zelfcontrole

1. Waarom staat bij `db` geen `ports`?
2. Wat doet `docker compose config --quiet` en waarom gebruik je `--quiet`?
3. Waarom is een volume geen back-up?
4. Waarom moet je de site vanaf een tweede toestel testen?

<details><summary>Antwoorden</summary>

1. Alleen WordPress moet vanaf het netwerk bereikbaar zijn; de database is intern voor de services.
2. Het valideert Compose zonder een uitgewerkte configuratie met mogelijke geheimen af te drukken.
3. Het is opslag op dezelfde host en bewaart ook beschadigingen; een onafhankelijke kopie en hersteltest zijn nodig.
4. Zo bewijs je netwerkbereikbaarheid en ontdek je foutieve `localhost`-links.

</details>

## Bronnen

- [Projectopdracht](../Opdracht/docker/projectopdracht.md)
- [Docker: WordPress met Compose](https://docs.docker.com/reference/samples/wordpress/)
- [Docker: startvolgorde en healthchecks](https://docs.docker.com/compose/how-tos/startup-order/)
- [Docker: volumes](https://docs.docker.com/engine/storage/volumes/)
- [WordPress: dashboard](https://wordpress.org/documentation/category/dashboard/)
