<?php

namespace App\Console\Commands;

use App\Models\Article;
use App\Models\Category;
use App\Models\Printer;
use App\Models\Rtable;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Illuminate\Console\Command;

class SeedAllDataCommand extends Command
{
    protected $signature = 'seed:all-data';

    protected $description = 'Seed articles, categories, printers and tables';

    public function handle()
    {
        $this->info('Seeding all data...');

        Schema::disableForeignKeyConstraints();

        $this->seedCategories();
        $this->seedPrinters();
        $this->seedTables();
        $this->seedArticles();

        Schema::enableForeignKeyConstraints();

        $this->info('Seeding data completed successfully!');
    }

    private function seedCategories()
    {
        $categories = [
            ['name' => 'Toplo, ali osvježavajuće', 'description' => 'Toplo, ali osvježavajuće'],
            ['name' => 'Hladno i očaravajuće', 'description' => 'Hladno i očaravajuće'],
            ['name' => 'Pivo u bocama tamno', 'description' => 'Pivo u bocama tamno'],
            ['name' => 'Pivo u bocama svijetlo', 'description' => 'Pivo u bocama svijetlo'],
            ['name' => 'Točeno pivo', 'description' => 'Točeno pivo'],
            ['name' => 'Žestoka pića', 'description' => 'Žestoka pića'],
            ['name' => 'Kokteli', 'description' => 'Kokteli'],
            ['name' => 'Vino', 'description' => 'Vino'],
            ['name' => 'Roštilj i prilozi', 'description' => 'Roštilj i prilozi'],
            ['name' => 'Hrana', 'description' => 'Hrana'],
        ];

        Category::truncate();

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'description' => $category['description'],
                'slug' => Str::slug($category['name']),
                'image' => null,
            ]);
        }

        $this->info('Seeding categories completed successfully!');
    }

    private function seedArticles()
    {
        $articles = [
            // Toplo, ali osvježavajuće
            ['title' => 'ESPRESSO KAFA', 'description' => 'Espresso je način kuhanja kafe talijanskog porijekla, u kojem se mala količina gotovo kipuće vode protisne kroz fino mljevena zrna kafe pod pritiskom od 9-10 bara. Espresso kafa se može pripremiti sa širokim izborom zrna kafe i stepena prženja.', 'price' => 1.50, 'image_url' => 'images/espresso-coffee-cutout-free-png.webp', 'is_active' => true, 'category' => 'Toplo, ali osvježavajuće'],
            ['title' => 'MACCIATO MALI', 'description' => 'Savršena za dobro jutro', 'price' => 2.00, 'image_url' => 'images/macciato.jpg', 'is_active' => true, 'category' => 'Toplo, ali osvježavajuće'],
            ['title' => 'CAPPUCINO', 'description' => 'Alergen: mlijeko (laktoza) Napitak od kafe. Pravi se od espresso kafe i mlijeka.', 'price' => 3.00, 'image_url' => 'images/cappucino.jpg', 'is_active' => true, 'category' => 'Toplo, ali osvježavajuće'],
            ['title' => 'MACCIATO', 'description' => 'Savršena za dobro jutro i za popodnevno uživanje', 'price' => 3.00, 'image_url' => 'images/macciato.jpg', 'is_active' => true, 'category' => 'Toplo, ali osvježavajuće'],
            ['title' => 'LATTE MACCIATO', 'description' => 'Alergen: mlijeko (laktoza) Kafa sa više mlijeka', 'price' => 3.50, 'image_url' => 'images/latte_macciato.jpg', 'is_active' => true, 'category' => 'Toplo, ali osvježavajuće'],
            ['title' => 'LEDENA KAFA', 'description' => 'Alergen: mlijeko (laktoza) Ledena kafa je napitak od kafe koji se poslužuje hladan. Može se pripremiti ili kuhanjem kafe na uobičajni način, a zatim posluživanjem na ledu ili hladnom mlijeku ili kuhanjem kafe hladnom.', 'price' => 4.00, 'image_url' => 'images/ledena_kafa.jpg', 'is_active' => true, 'category' => 'Toplo, ali osvježavajuće'],
            ['title' => 'TOPLA ČOKOLADA', 'description' => 'Alergen: mlijeko (laktoza) Topla čokolada je zagrijano bezalkoholno piće čiji su uobičajni sastojci čokolada, koja se dodaje u istopljenom obliku ili kao kakao prah, toplo mlijeko ili voda, i šećer. Tečna čokolada je slična toploj čokoladi, ali se pravi samo od istopljene čokolade ili čokoladne paste a ne od praha rastvorljivog u vodi.', 'price' => 4.00, 'image_url' => 'images/topla_čokolada.jpg', 'is_active' => true, 'category' => 'Toplo, ali osvježavajuće'],
            ['title' => 'JM CAPPNESS', 'description' => '', 'price' => 3.00, 'image_url' => 'images/JM_CAPPNESS.jpg', 'is_active' => true, 'category' => 'Toplo, ali osvježavajuće'],
            ['title' => 'ČAJ', 'description' => 'Idealan za hladne dane. (Kamilica, menta, šipak, brusnica..)', 'price' => 1.50, 'image_url' => 'images/čaj.jpg', 'is_active' => true, 'category' => 'Toplo, ali osvježavajuće'],

            // Hladno i očaravajuće
            ['title' => 'CAPPY NARANČA 0.20L', 'description' => 'Cappy voćni sok naranča je prirodan izvor vitalnosti i energije tokom cijelog dana. Visokokvalitetni sastojci i pažljivo birane naranče daju savšen osvježavajući okus. Uživajte u intenzivnom voćnom okusu naranče uz Cappy voćni sok naranča.', 'price' => 3.50, 'image_url' => 'images/CAPPY_NARANČA_0.20L.jpg', 'is_active' => true, 'category' => 'Hladno i očaravajuće'],
            ['title' => 'CAPPY BRESKVA 0.20L', 'description' => 'Kaša od breskve (min. 42 %) od koncentrirane voćne kaše, voda, fruktozno-glukozni sirup, regulator kiselosti: limunska kiselina, antioksidans: askorbinska kiselina, arome', 'price' => 3.50, 'image_url' => 'images/CAPPY_BRESKVA_0.20L.jpg', 'is_active' => true, 'category' => 'Hladno i očaravajuće'],
            ['title' => 'CAPPY JAGODA 0.20L', 'description' => 'Kaša od jagode (19%) od koncentrirane kaše, voćni sokovi od koncentriranoga soka: jabuka (9%), jagoda (5%), aronija (1%), crni ribiz (1%), voda, fruktozno-glukozni sirup, regulator kiselosti: limunska kiselina, ekstrakti hibiskusa i mrkve, arome.', 'price' => 3.50, 'image_url' => 'images/CAPPY_JAGODA_0.20L.jpg', 'is_active' => true, 'category' => 'Hladno i očaravajuće'],
            ['title' => 'CAPPY CRNI RIBIZ 0.20L', 'description' => 'Sok crnog ribiza (min 25%) od koncentriranog soka, voda, fruktozno-glukozni sirup, kiselina: limunska kiselina.', 'price' => 3.50, 'image_url' => 'images/CAPPY_CRNI_RIBIZ_0.20L.jpg', 'is_active' => true, 'category' => 'Hladno i očaravajuće'],
            ['title' => 'CAPPY JABUKA 0.20L', 'description' => 'Sok od jabuke (min 50%) od koncentriranog soka, voda, fruktozno-glukozni sirup, kiselina: limunska kiselina.', 'price' => 3.50, 'image_url' => 'images/CAPPY_JABUKA_0.20L.jpg', 'is_active' => true, 'category' => 'Hladno i očaravajuće'],
            ['title' => 'SCHWEPPES TONIC 0.25L', 'description' => 'Osvježavajuće bezalkoholno gazirano piće sa okusom kinina. Sa sećerom i sladilom. Originalni, vrhunski okus koji zahtjeva karakter još od 1783.!', 'price' => 3.50, 'image_url' => 'images/SCHWEPPES_TONIC_0.25L.jpg', 'is_active' => true, 'category' => 'Hladno i očaravajuće'],
            ['title' => 'SCHWEPPES BITTER LEMON 0.25L', 'description' => 'Osvježavajuće bezalkoholno gazirano piće sa okusom limuna. Sa šećerom i sladilima.', 'price' => 3.50, 'image_url' => 'images/SCHWEPPES_BITTER_LEMON_0.25L.jpg', 'is_active' => true, 'category' => 'Hladno i očaravajuće'],
            ['title' => 'SCHWEPPES TANDŽARINA 0.25L', 'description' => 'Ukusno gazirano piće, sa karakterističnim okusom mandarine', 'price' => 3.50, 'image_url' => 'images/SCHWEPPES_TANDŽARINA_0.25L.jpg', 'is_active' => true, 'category' => 'Hladno i očaravajuće'],
            ['title' => 'COCA COLA 0.25L', 'description' => 'Coca-Cola je napopularnije i najprodavanije bezalkoholno piće u historiji, kao i jedan od najprepoznatljivijih brendova na svijetu. Ovaj gazirani napitak, patentiran je 1887. godine, a u 130 godina historije, okus Coca-Cole ostao je isti!', 'price' => 3.50, 'image_url' => 'images/coca_cola_0.25l.jpg', 'is_active' => true, 'category' => 'Hladno i očaravajuće'],
            ['title' => 'COCA COLA ZERO 0.25L', 'description' => 'Pravi okus Coca-Cole s nula kalorija. To je moguće! Revolucionarno piće koje je zadržalo okus originalne Coca-Cole bez šećera i kalorija.', 'price' => 3.50, 'image_url' => 'images/coca_cola_zero_0.25l.jpg', 'is_active' => true, 'category' => 'Hladno i očaravajuće'],
            ['title' => 'COCTA 0.275L', 'description' => 'Cockta je bezalkoholno gazirano piće iz Slovenije. Glavni joj je sastojak plod divlje ruže divlji šipak. Ostali sastojci su 11 različitih ljekovitih trava, limun i naranča. Ne sadrži ni kofein, ni ortofosfornu kiselinu.', 'price' => 3.50, 'image_url' => 'images/cocta_0.275l.jpg', 'is_active' => true, 'category' => 'Hladno i očaravajuće'],
            ['title' => 'FANTA NARANČA 0.25L', 'description' => 'Fanta je svjetska marka gaziranih pića s voćnim okusom, koje proizvodi The Coca-Cola Company i prodaje se širom svijeta, te je vodeća svjetska marka s više aromatizacija. Obožavaju ga potrošači širom svijeta zahvaljujući svojem osvježavajućem, punom i živahnom voćnom ukusu.', 'price' => 3.50, 'image_url' => 'images/fanta_naranča_0.25l.jpg', 'is_active' => true, 'category' => 'Hladno i očaravajuće'],
            ['title' => 'SPRITE 0.25L', 'description' => 'Sprite je jedan od najpopularnijih bezalkoholnih napitaka s okusom limuna i limete širom svijeta! Iskustvo ispijanja Spritea odlikuje žar osvježenja koji gasi žeđ na jedinstven način!', 'price' => 3.50, 'image_url' => 'images/sprite_0.25l.jpg', 'is_active' => true, 'category' => 'Hladno i očaravajuće'],
            ['title' => 'ORANGINA 0.25L', 'description' => 'Orangina je blago gazirani napitak napravljen od gazirane vode, 12% soka od citrusa, kao i 2% pulpe naranče. Orangina se zaslađuje šećerom ili visoko fruktoznim kukuruznim sirupom, a na nekim tržištima i umjetnim zaslađivačima. Dodate su i prirodne arome.', 'price' => 4.00, 'image_url' => 'images/orangina_0.25l.jpg', 'is_active' => true, 'category' => 'Hladno i očaravajuće'],
            ['title' => 'RED BULL 0.25L', 'description' => 'Posebna formula Red Bull Energy Drink sadrži sastojke visoke kvalitete. Kofein pomaže poboljšati koncentraciju i povećati budnost. Jedna limenka Red Bulla od 250ml sadrži 80mg kofeina.', 'price' => 5.50, 'image_url' => 'images/red_bull_0.25l.jpg', 'is_active' => true, 'category' => 'Hladno i očaravajuće'],
            ['title' => 'HELL ENERGY 0.25L', 'description' => 'Hell Energy Drink je popularan brend energetskih pića koji se distribuira prvenstveno u Evropi i Aziji. Brend je 2006. godine pokrenula privatna kompanija, osnovana u Mađarskoj 2004. godine, koja je uzela ime "Hell Energy Magyarország Kft". u 2009. U roku od tri godine postao je tržišni lider u Mađarskoj.', 'price' => 3.00, 'image_url' => 'images/hell_energy_0.25l.jpg', 'is_active' => true, 'category' => 'Hladno i očaravajuće'],
            ['title' => 'SENSATION DUNJA-KRUŠKA 0.25L', 'description' => 'Neka vas svježina i sklad nove SENSATION! kombinacije uvedu u najtoplije godišnje doba. Mirisni sklad kombinacije ove dvije vrste voća, tipične za naše podneblje, razbit će monotoniju smjene godišnjih doba i uvesti vas u ljeto. SENSATION! dunja-kruška, baš poput svojih prethodnika, ne sadrži umjetne boje i sladila, zbog čega je idealno osvježenje za svaku priliku.', 'price' => 2.50, 'image_url' => 'images/sensation_dunja-kruška_0.25l.jpg', 'is_active' => true, 'category' => 'Hladno i očaravajuće'],
            ['title' => 'FUZETEA BRESKVA 0.25L', 'description' => 'Osvježavajuće bezalkoholno negazirano piće s ekstraktom čaja i okusom breskve i hibiskusa. Odličan okus čaja s malo kalorija i prirodnim aromama.', 'price' => 3.50, 'image_url' => 'images/fuzetea_breskva_0.25l.jpg', 'is_active' => true, 'category' => 'Hladno i očaravajuće'],
            ['title' => 'FUZETEA ŠUMSKO VOĆE 0.25L', 'description' => 'Negazirano osvježavajuće bezalkoholno piće s ekstraktom čaja i okusom šumskog voća. Odličan okus čaja s malo kalorija i prirodnim aromama.', 'price' => 3.50, 'image_url' => 'images/fuzetea_šumsko_voće_0.25l.jpg', 'is_active' => true, 'category' => 'Hladno i očaravajuće'],
            ['title' => 'OLIMPIJA VODA 0.33L', 'description' => 'Kristalno bistra, punog okusa i osvježavajuća voda Olimpija izvire na 198 metara nadmorske visine iz netaknute, zaštićene prirodne ljepote. Flašira se direktno na izvoru, a optimalna temperatura kojoj je izložena čuva sva njena prirodna svojstva. Zbog niskog sastava minerala, naročito natrija, može se piti svakodnevno.', 'price' => 2.00, 'image_url' => 'images/olimpija_voda_0.33l.jpg', 'is_active' => true, 'category' => 'Hladno i očaravajuće'],
            ['title' => 'OLIMPIJA KISELA VODA 0.33L', 'description' => 'Kristalno bistra, punog okusa i osvježavajuća, mineralna voda Olimpija izvire na 198 metara nadmorske visine iz netaknute, zaštićene prirodne ljepote. Flašira se direktno na izvoru, a optimalna temperatura kojoj je izložena čuva sva njena prirodna svojstva. Zbog niskog sastava minerala, naročito natrija, može se piti svakodnevno.', 'price' => 2.50, 'image_url' => 'images/olimpija_kisela_voda_0.33l.jpg', 'is_active' => true, 'category' => 'Hladno i očaravajuće'],
            ['title' => 'LIMUNADA 0.33L', 'description' => 'Limunada je omiljeni ljetni napitak! Svježe iscijeđeni sok od limuna.', 'price' => 3.00, 'image_url' => 'images/limunada_0.33l.jpg', 'is_active' => true, 'category' => 'Hladno i očaravajuće'],
            ['title' => 'CEDEVITA 0.33L', 'description' => 'Cedevita je vitaminski instant napitak za svaku priliku, pogodna za sve uzraste, za svako doba dana.', 'price' => 3.00, 'image_url' => 'images/cedevita_0.33l.jpg', 'is_active' => true, 'category' => 'Hladno i očaravajuće'],

            // Pivo u bocama tamno
            ['title' => 'PAULANER SALVATOR TAMNO 0.33L', 'description' => 'Pivo je crvenkasto-smeđe boje, jakog i intenzivnog, punog okusa. Alkohol se malo previše osjeti. Pjena gotovo da ne postoji i nestaje za nekoliko sekundi, karbonizacija je izuzetno niska, prekrasnog je mirisa koji podsjeća na belgijska piva.', 'price' => 5.00, 'image_url' => 'images/paulaner_salvator_tamno_0.33l.jpg', 'is_active' => true, 'category' => 'Pivo u bocama tamno'],
            ['title' => 'GUINNESS 0.33L', 'description' => 'Guinness je zaštitni znak tamnog piva s karakteristično slatkim okusom, koje se izvorno proizvodi u irskom glavnom gradu Dublinu.', 'price' => 8.50, 'image_url' => 'images/guinness_0.33l.jpg', 'is_active' => true, 'category' => 'Pivo u bocama tamno'],
            ['title' => 'ERDINGER TAMNO 0.33L', 'description' => 'Erdinger Weissbier je zlatno narančasta pšenična piva sa veličanstvenom bijelom pjenom. Miris je svjež i privlačan sa voćnim notama banane, citrusa i žitarica. Ukus je dobro izbalansiran sa mekim kremastim užitkom i blagim naknadnim ukusom.', 'price' => 5.50, 'image_url' => 'images/erdinger_tamno_0.33l.jpg', 'is_active' => true, 'category' => 'Pivo u bocama tamno'],
            ['title' => 'SARAJEVSKO TAMNO 0.33L', 'description' => 'Sarajevsko tamno je tamno lager pivo s udjelom alkohola od 4,9% i ekstrakta 12,2%. Dostupno je u nepovratnoj staklenoj boci 0,33l i limenci 0,50l.', 'price' => 3.50, 'image_url' => 'images/sarajevsko_tamno_0.33l.jpg', 'is_active' => true, 'category' => 'Pivo u bocama tamno'],
            ['title' => 'BUDWEISER TAMNO 0.33L', 'description' => 'Budweiser Budvar je pasterizovano, svijetlo Češko pivo vrhunskog kvaliteta. Opravdano nosi titulu premium brenda, jer je proizveden isključivo od najfinijih sastojaka – hmelja visokog kvaliteta iz oblasti Saaz i pažljivo odabranog slada iz Moravia predjela.', 'price' => 4.50, 'image_url' => 'images/budweiser_tamno_0.33l.jpg', 'is_active' => true, 'category' => 'Pivo u bocama tamno'],
            ['title' => 'SEMIZBURG PIVO PRIKAZA', 'description' => 'Prikaza – India Pale Ale (IPA), za tip piva srednje jačine alkohola (6,7% ABV), umjerene gorčine (62 IBU) sa izračenim i prepoznatljivim notama raznolikog tropskog voća i citrusa.', 'price' => 6.50, 'image_url' => 'images/semizburg_pivo_prikaza.jpg', 'is_active' => true, 'category' => 'Pivo u bocama tamno'],

            // Pivo u bocama svijetlo
            ['title' => 'CORONA EXTRA 0.35L', 'description' => 'Corona Extra je blijedi lager koji proizvodi tvrtka Cervecería Modelo u Meksiku, a u vlasništvu je AB InBev u Belgiji. Jedna je od najprodavanijih piva u svijetu. Corona se obično poslužuje s kriškom limete ili limuna na grlu boce kako bi se dodala tvrdoća i okus. Od 1998. Corona Extra je najprodavanije uvozno piće u Sjedinjenim Državama.', 'price' => 7.00, 'image_url' => 'images/corona_extra_0.35l.jpg', 'is_active' => true, 'category' => 'Pivo u bocama svijetlo'],
            ['title' => 'BAVARIA 0.25L', 'description' => 'Bavaria je Premium pilsner prirodnog, blago voćnog ukusa. Već sedam generacija, u proteklih 300 godina, nezavisna pivara u porodičnom vlasništvu posvećeno stvara ovo jedinstveno pivo. Strast prema pivarstvu, bogato radno iskustvo i preduzetništvo, prenose se sa koljena na koljeno.', 'price' => 4.00, 'image_url' => 'images/bavaria_0.25l.jpg', 'is_active' => true, 'category' => 'Pivo u bocama svijetlo'],
            ['title' => 'BAVARIA BEZALKOHOLNO PIVO 0.25L', 'description' => 'Prvo bezalkoholno pivo na svijetu, u prodaji od 1978. godine. Ovo 100% bezalkoholno pivo stvoreno je jedinstvenim proizvodnim procesom te posjeduje autentični i nenadmašni karakter. Prirodna slatkoća zrna pšenice savršeno upotpunjava gorke note. Pivo ima pun i izražen ukus hmelja. Bavaria 0.0% moćnog je ukusa i bez kapi alkohola.', 'price' => 4.00, 'image_url' => 'images/bavaria_bezalkoholno_pivo_0.25l.jpg', 'is_active' => true, 'category' => 'Pivo u bocama svijetlo'],
            ['title' => 'HEINEKEN 0.33L', 'description' => 'Lagano pasterizovano pivo, alc. 5,0 vol. %. Heineken pivo je osvježavajuće vrhunsko lager pivo, kuhano s ponosom. Uzgaja se od 100% prirodnih sastojaka (ječam, voda i hmelj). Tijekom sazrijevanja, originalni A Heineken kvasci doprinose konačnom karakteru piva, kojeg karakterizira uravnotežen okus i nježne voćne arome. Gerard A.Heineken počeo je s proizvodnjom piva već 1873. Danas, četiri generacije kasnije, obiteljska kvaliteta još uvijek omogućava potrošačima iz 192 zemlje da i dalje uživaju u ispijanju Heineken piva.', 'price' => 4.50, 'image_url' => 'images/heineken_0.33l.jpg', 'is_active' => true, 'category' => 'Pivo u bocama svijetlo'],
            ['title' => 'HEINEKEN 0.0% 0.33L', 'description' => 'Naši glavni pivari krenuli su od nule i proveli su godine istražujući, praveći i kušajući prije nego što su konačno kreirali recept definiran osvježavajućim voćnim notama i mekanim sladnim korpusom - savršeno uravnotežen. Recept koji zaslužuje oznaku Heineken. Naravno, s beskompromisnim karakteristikama Heinekena od 1873. godine: napravljen od vrhunskih sastojaka i jedinstvenog Heinekenovog A-kvasca. Nije bilo lako, ali ni nemoguće.', 'price' => 4.50, 'image_url' => 'images/heineken_0.0%_0.33l.jpg', 'is_active' => true, 'category' => 'Pivo u bocama svijetlo'],
            ['title' => 'STELLA ARTOIS 0.33L', 'description' => 'Stella Artois je autentično belgijsko lager pivo vrhunskog kvaliteta. Prisutno je u više od 80 zemalja svijeta i ujedno je i najprodavanije belgijsko pivo na svijetu. Stella Artois potiče iz originalne Den Hoorn pivare, osnovane davne 1366. godine u Leuven-u. Godine 1708. pivaru je kupio Sebastian Artois, te otuda i današnji naziv. 1926. godine, kao božićni poklon stanovnicima Leuven-a, proizvedena je određena količina piva sa zvijezdom na flaši i nazivu je dodata reč Stella (zvijezda). Jedan od najpoznatijih simbola ovog piva je prepoznatljiva čaša koja omogućava da uvijek bude servirano na savršen način i u skladu s posebnim ritualom točenja u 9 koraka. Stella Artois je sofisticirano belgijsko pivo bez kompromisa.', 'price' => 4.50, 'image_url' => 'images/stella_artois_0.33l.jpg', 'is_active' => true, 'category' => 'Pivo u bocama svijetlo'],
            ['title' => 'SARAJEVSKO PREMIUM HS 0.50L', 'description' => 'Sarajevsko Premium je svijetlo lager pivo. Proizvodi se iz ječmenog slada, hmelja, prirodne izvorske vode i kvasca. Premium je poseban zbog aromatičnosti koju ima iz slada i hmelja. Sadržaj alkohola je 4,9%, a ekstrakta 12%. Dostupan je u staklenoj boci s preklopnim zatvaračem.', 'price' => 6.50, 'image_url' => 'images/sarajevsko_premium_hs_0.50l.jpg', 'is_active' => true, 'category' => 'Pivo u bocama svijetlo'],
            ['title' => 'SARAJEVSKO PIVO PREMIUM 0.33L', 'description' => 'Sarajevsko Premium je svijetlo lager pivo. Proizvodi se iz ječmenog slada, hmelja, prirodne izvorske vode i kvasca. Premium je poseban zbog aromatičnosti koju ima iz slada i hmelja. Sadržaj alkohola je 4,9%, a ekstrakta 12%. Dostupno je u staklenim povratnim bocama 0,5l i 0,33l, nepovratnoj staklenoj boci 0,33l te u limenci 0,5l.', 'price' => 3.50, 'image_url' => 'images/sarajevsko_pivo_premium_0.33l.jpg', 'is_active' => true, 'category' => 'Pivo u bocama svijetlo'],
            ['title' => 'SARAJEVSKO PIVO RADLER 0.33L', 'description' => 'Sarajevsko radler je mješavina svijetlog, lakog lager piva i osvježavajućeg bezalkoholnog pića limunovog soka. Sadržaj alkohola je 2%, a ekstrakta 11,2%. Dostupno je u nepovratnoj staklenoj ambalaži 0,33l i limenci 0,5l', 'price' => 3.50, 'image_url' => 'images/sarajevsko_pivo_radler_0.33l.jpg', 'is_active' => true, 'category' => 'Pivo u bocama svijetlo'],
            ['title' => 'BUDWEISER 0.33L', 'description' => 'Budweiser Budvar je pasterizovano, svijetlo Češko pivo vrhunskog kvaliteta. Opravdano nosi titulu premium brenda, jer je proizveden isključivo od najfinijih sastojaka – hmelja visokog kvaliteta iz oblasti Saaz i pažljivo odabranog slada iz Moravia predjela.', 'price' => 4.50, 'image_url' => 'images/budweiser__0.33l.jpg', 'is_active' => true, 'category' => 'Pivo u bocama svijetlo'],
            ['title' => 'BAYREUTHER 0.50L', 'description' => 'Svjež, začinjen ukus i ukusno uživanje u pivu karakteristični su za tradicionalni bavarski specijalitet piva. Baireuther Hell dobija svoj nepogrešiv karakter iz pažljivo izbalansiranog balansa najfinijeg svjetlog ječmenog slada i suptilne note hmelja. Kuha se sa puno ljubavi i strasti po tradicionalnim receptima i po pravilima najbolje bavarske umjetnosti pivarstva. Bayreuther Hell sija u staklu svojom svjetlo zlatnom bojom i impresivnom glavom pjene. Nos je okružen svježim, cvjetnim notama sa blagim nagovještajem meda i limuna. Lagano, divno začinsko i ukusno pivo najfinijeg sumećeg mirisa je evidentno u ustima: odlična kompozicija meda, karamele i cvjetnih hmelja sa notama zrna. Iskreno i ukusno svjetlo pivo, kakvo se vjekovima kuha i voli u Bavarskoj.', 'price' => 6.00, 'image_url' => 'images/bayreuther_0.50l.jpg', 'is_active' => true, 'category' => 'Pivo u bocama svijetlo'],
            ['title' => 'GRIMBERGEN 0.33L', 'description' => 'Grimbergen – legendarno belgijsko samostansko pivo s tradicijom duljom od 900 godina. Nastalo je u istoimenom samostanu davne 1128. godine, a recept ovog piva očuvan je kroz tri strašna požara koji su samostan spalili do temelja – najprije 1142., zatim 1566. i 1798. godine. Redovnici su svaki put iznova uzdigli zidine svog samostana i nastavljali stvarati i usavršavati svoje pivo. Grimbergen pivo, kao i samostan, stoga su ponosno usvojili krilaticu “Ardet nec consumitur – Spaljen, ali ne i uništen” te simbol feniksa kao svoje zaštitne znakove.', 'price' => 4.50, 'image_url' => 'images/grimbergen_0.33l.jpg', 'is_active' => true, 'category' => 'Pivo u bocama svijetlo'],
            ['title' => 'BECKS 0.33L', 'description' => 'Beck\'s je pivo kod kojeg odmah znate što ćete dobiti. Pivo je izuzetno svježeg hmeljanog mirisa, svijetlo zlatane boje, blago gorke arome sa suptilnim naglaskom na hmeljnoj bazi. Riječ je o njemačkom oštrom i suhom pilsneru koji se tradicionalno proizvodi po pravilima Reinheitsgebota iz 1516. godine.', 'price' => 4.00, 'image_url' => 'images/becks_0.33l.jpg', 'is_active' => true, 'category' => 'Pivo u bocama svijetlo'],
            ['title' => 'CALSBERG 0.33L', 'description' => 'Carlsberg je pasterizovano, svijetlo pivo, prvi put proizvedeno 1904. godine. Dio je danskog kulturnog nasleđa i predstavlja idealan napitak za gašenje žeđi. Iskusite harmoničnu ravnotežu između prijatne gorčine i slatkoće jabuka, dok konzumirate ovo pivo svetlo zlatne boje i bogate pjene. Miris i aromu piva čine mješavina bora, lješnika i kiseljaka.', 'price' => 4.00, 'image_url' => 'images/calsberg_0.33l.jpg', 'is_active' => true, 'category' => 'Pivo u bocama svijetlo'],
            ['title' => 'ESTRELLA DAMM 0.33L', 'description' => 'Estrella Damm je španjolsko pivo proizašlo iz stoljetne tradicije proizvodnje piva u Damm pivovari. Ovo pitko pivo jedinstvenog okusa proizvodi se po originalnom receptu iz 1876. godine koristeći najbolje mediteranske sastojke: ječmeni slad, rižu i hmelj.', 'price' => 5.00, 'image_url' => 'images/estrella_damm_0.33l.jpg', 'is_active' => true, 'category' => 'Pivo u bocama svijetlo'],
            ['title' => 'ESTRELLA DAURA DAMM GLUTEN FREE 0.50L', 'description' => '', 'price' => 8.00, 'image_url' => 'images/estrella_daura_damm_gluten_free_0.50l.jpg', 'is_active' => true, 'category' => 'Pivo u bocama svijetlo'],
            ['title' => 'CRABBIES GINGER BEER GLUTEN FREE 0.33L', 'description' => '', 'price' => 8.00, 'image_url' => 'images/crabbies_ginger_beer_gluten_free_0.33l.jpg', 'is_active' => true, 'category' => 'Pivo u bocama svijetlo'],
            ['title' => 'SOMERSBY JABUKA 0.33L', 'description' => 'Osvježavajući jabučni cider izbalansirane slatkoće i punog okusa. Tekućina ispunjena nježnim mjehurićima s delikatnim balansom voćnih i kiselkastih nota daje mu osvježavajući karakter.', 'price' => 5.00, 'image_url' => 'images/somersby_jabuka_0.33l.jpg', 'is_active' => true, 'category' => 'Pivo u bocama svijetlo'],
            ['title' => 'SOMERSBY MANGO I LIMETA 0.33L', 'description' => 'Somersby Mango Limeta prvi je okus baziran na tropskom voću što ga čini drugačijim. Slatkoću tropskog manga u ovom osvježavajućem cideru izvrsno balansira kiselost limete, koja daje punoću okusa.', 'price' => 5.00, 'image_url' => 'images/somersby_mango_i_limeta_0.33l.jpg', 'is_active' => true, 'category' => 'Pivo u bocama svijetlo'],
            ['title' => 'SOMERSBY BOROVNICA 0.33L', 'description' => 'Intenzivan i osvježavajuć cider s voćnim okusom borovnice. Ugodna slatkoća i blaga kiselost daju mu osvježavajući karakter.', 'price' => 5.00, 'image_url' => 'images/somersby_borovnica_0.33l.jpg', 'is_active' => true, 'category' => 'Pivo u bocama svijetlo'],
            ['title' => 'SOMERSBY JAGODA I LIMETA 0.0% 0.33L', 'description' => 'Somersby 0,0% Jagoda & Limeta okus je baziran na sofisticiranoj aromi jagode uz osvježavajuću notu limete. Nevjerojatna punoća ovog okusa osvaja na prvu i to bez alkohola. Zato su Somersby 0,0% okusi pravi odabir za sve one koji žele uživati u svim prilikama.', 'price' => 5.00, 'image_url' => 'images/somersby_jagoda_i_limeta_0.0%_0.33l.jpg', 'is_active' => true, 'category' => 'Pivo u bocama svijetlo'],
            ['title' => 'OŽUJSKO LIMUN 0.33L', 'description' => 'U trenucima jake žeđi česta je dvojba - pivo ili sok? Na sreću, neke odluke nije potrebno donositi. Ožujsko limun, Ožujsko grejp ili Ožujsko s ukusom bazge kombinacija su svijetlog piva lager i osvježavajućeg bezalkoholnog pića od limunovog soka, soka grejpa i soka s ukusom bazge koji zajedno pružaju izvrstan osvježavajući ukus uz smanjeni postotak alkohola od 2%.', 'price' => 3.50, 'image_url' => 'images/ožujsko_limun_0.33l.jpg', 'is_active' => true, 'category' => 'Pivo u bocama svijetlo'],
            ['title' => 'PAULANER HEFE WEISSBIER 0.33L', 'description' => '', 'price' => 4.50, 'image_url' => 'images/paulaner_hefe_weissbier_0.33l.jpg', 'is_active' => true, 'category' => 'Pivo u bocama svijetlo'],
            ['title' => 'ERDINGER WEISSBIER 0.33L', 'description' => 'Erdinger Weissbier je zlatno narandzasta pšenična piva sa veličanstvenom bijelom pjenom. Miris je svjež i privlačan sa voćnim notama banane, citrusa i žitarica. Ukus je dobro izbalansiran sa mekim kremastim užitkom i blagim naknadnim ukusom.', 'price' => 5.50, 'image_url' => 'images/erdinger_weissbier_0.33l.jpg', 'is_active' => true, 'category' => 'Pivo u bocama svijetlo'],
            ['title' => 'LAŠKO MALT 0.33L', 'description' => 'Laško Malt je gazirano osvježavajuće bezalkoholno piće. 100% prirodno. Ukoliko tražite za idealno osvježenje u ovim ljetnjim danima, Laško Malt limun je idealno za vas.', 'price' => 4.50, 'image_url' => 'images/laško_malt_0.33l.jpg', 'is_active' => true, 'category' => 'Pivo u bocama svijetlo'],

            // Točeno pivo
            ['title' => 'STAROPRAMEN 0.3L', 'description' => 'Točenje piva iz točionika ispred vaših očiju ima određenu magiju u sebi. Pogled na pjenu koja se polako formira, dok se maleni mjehurići kovitlaju ispod nje stvaravši veličanstven ples u staklu, veoma je očaravajući. Ovo je zasigurno najbolji način da doživite pivo!', 'price' => 3.00, 'image_url' => 'images/staropramen_0.3l.jpg', 'is_active' => true, 'category' => 'Točeno pivo'],
            ['title' => 'STAROPRAMEN 0.5L', 'description' => 'Točenje piva iz točionika ispred vaših očiju ima određenu magiju u sebi. Pogled na pjenu koja se polako formira, dok se maleni mjehurići kovitlaju ispod nje stvaravši veličanstven ples u staklu, veoma je očaravajući. Ovo je zasigurno najbolji način da doživite pivo!', 'price' => 4.00, 'image_url' => 'images/staropramen_0.3l.jpg', 'is_active' => true, 'category' => 'Točeno pivo'],
            ['title' => 'PAULANER HELL 0.3L', 'description' => '', 'price' => 4.00, 'image_url' => 'images/paulaner_hell_0.3l.jpg', 'is_active' => true, 'category' => 'Točeno pivo'],
            ['title' => 'PAULANER HELL 0.5L', 'description' => '', 'price' => 5.00, 'image_url' => 'images/paulaner_hell_0.3l.jpg', 'is_active' => true, 'category' => 'Točeno pivo'],
            ['title' => 'PAULANER WEISSBIER 0.3L', 'description' => '', 'price' => 3.50, 'image_url' => 'images/paulaner_weissbier_0.3l.jpg', 'is_active' => true, 'category' => 'Točeno pivo'],
            ['title' => 'PAULANER WEISSBIER 0.5L', 'description' => '', 'price' => 4.50, 'image_url' => 'images/paulaner_weissbier_0.3l.jpg', 'is_active' => true, 'category' => 'Točeno pivo'],
            ['title' => 'KRONENBOURG BLANC 0.3L', 'description' => '', 'price' => 3.00, 'image_url' => 'images/kronenbourg_blanc_0.3l.jpg', 'is_active' => true, 'category' => 'Točeno pivo'],
            ['title' => 'KRONENBOURG BLANC 0.5L', 'description' => '', 'price' => 4.00, 'image_url' => 'images/kronenbourg_blanc_0.3l.jpg', 'is_active' => true, 'category' => 'Točeno pivo'],
            ['title' => 'TUBORG 0.3L', 'description' => 'Tuborg je visokokvalitetno, blago i pitko pivo, sa smanjenim volumnim udjelom alkohola, idealno za tulume i partyje.', 'price' => 3.00, 'image_url' => 'images/tuborg_0.3l.jpg', 'is_active' => true, 'category' => 'Točeno pivo'],
            ['title' => 'TUBORG 0.5L', 'description' => 'Tuborg je visokokvalitetno, blago i pitko pivo, sa smanjenim volumnim udjelom alkohola, idealno za tulume i partyje.', 'price' => 4.00, 'image_url' => 'images/tuborg_0.3l.jpg', 'is_active' => true, 'category' => 'Točeno pivo'],
            ['title' => 'SARAJEVSKO SVIJETLO 0.3L', 'description' => '', 'price' => 2.50, 'image_url' => 'images/sarajevsko_svijetlo_0.3l.jpg', 'is_active' => true, 'category' => 'Točeno pivo'],
            ['title' => 'SARAJEVSKO SVIJETLO 0.5L', 'description' => '', 'price' => 3.50, 'image_url' => 'images/sarajevsko_svijetlo_0.3l.jpg', 'is_active' => true, 'category' => 'Točeno pivo'],
            ['title' => 'CARLSBERG 0.3L', 'description' => 'Inovativni DraughtMaster sistav postavlja nove standarde u kvaliteti koju su garancija jedinstvenog doživljaja svježine i nepromijenjenog okusa točenog piva.', 'price' => 3.50, 'image_url' => 'images/carlsberg_0.3l.jpg', 'is_active' => true, 'category' => 'Točeno pivo'],
            ['title' => 'CARLSBERG 0.5L', 'description' => 'Inovativni DraughtMaster sistav postavlja nove standarde u kvaliteti koju su garancija jedinstvenog doživljaja svježine i nepromijenjenog okusa točenog piva.', 'price' => 4.50, 'image_url' => 'images/carlsberg_0.3l.jpg', 'is_active' => true, 'category' => 'Točeno pivo'],

            // Žestoka pića
            ['title' => 'MOSKVA VODKA 0.03L', 'description' => 'Vodka Moskva proizvedena je od žitnog alkohola, destilirana i višekratno filtrirana. Neutralnog okusa i blagog mirisa idealna je za koktele kojima ćete uz malo truda iznenaditi svoje prijatelje.', 'price' => 3.00, 'image_url' => 'images/moskva_vodka_0.03l.jpg', 'is_active' => true, 'category' => 'Žestoka pića'],
            ['title' => 'SKYY VODKA 0.03L', 'description' => 'SKYY-ov vrhunski postupak četverostruke destilacije i trostruke filtracije daje votku dokazane iznimne kvalitete i uglađenosti. Počevši od prepoznatljive boce kobaltno plave boje SKYY Vodke i nagrađivane marketinške poruke SKYY je sinonim za kvalitetu, rafiniranost i stil.', 'price' => 3.50, 'image_url' => 'images/skyy_vodka_0.03l.jpg', 'is_active' => true, 'category' => 'Žestoka pića'],
            ['title' => 'NEEDL GIN 0.03L', 'description' => 'Needle je čisti i bistri gin s posebnim okusom crne šume. OKUS: Aromatične bobice smreke uz cvjetnu lavandu i tipičnu oštrinu đumbira, okusni pupoljci doživljavaju intenzivnu avanturu.', 'price' => 4.00, 'image_url' => 'images/needl_gin_0.03l.jpg', 'is_active' => true, 'category' => 'Žestoka pića'],
            ['title' => 'JACK DANIELS 0.03L', 'description' => 'Okus: Karakteristični viski blagog okusa kombinira karamel-vanilu i drvene note i lagani dimni okus. Aroma viskija prilično je lagana i glatka, s ugodnom slatkoćom u njoj možete pronaći naznake začina, orašastih plodova, masnih tonova, dimnih nijansi.', 'price' => 6.00, 'image_url' => 'images/jack_daniels_0.03l.jpg', 'is_active' => true, 'category' => 'Žestoka pića'],
            ['title' => 'JAGERMEISTER 0.03L', 'description' => 'Liker se proizvodi više od 70 godina. Ime u prijevodu znači “Master Hunter”, a na etiketi je prikazan Sveti Hubert, zaštitnik lovaca. Napitak sadrži više od 50 sastojaka (voćna kora, korijen i začini). Jägermeister se izrađuje natapanjem njegovih sastojaka u tekućini – maceracijom. Liker se 12 mjeseci držao u hrastovim bačvama, što omogućava da alkohol postane mekan i bogatog ukusa. U početku se ovaj napitak konzumirao u terapeutske svrhe za poboljšanje probave.', 'price' => 3.50, 'image_url' => 'images/jagermeister_0.03l.jpg', 'is_active' => true, 'category' => 'Žestoka pića'],
            ['title' => 'JOHNNIE WALKER RED LABEL 0.03L', 'description' => 'Johnnie Walker Red Label najprodavaniji je škotski whisky na svijetu. Poizvodi se blendanjem više od 40 različitih vrsta Malt i Grain viskija iz svih regija škotske u kojima se proizvodi whisky. Prvi put su ga proizveli Alexander i George, unuci Johna Walkera, 1820. godine u Kilmarnocku. Red Label je dobitnik više nagrada od bilo kojeg drugog viskija. Konzumira se čist, s ledom ili kao duša raznih miksera.', 'price' => 4.00, 'image_url' => 'images/johnnie_walker_red_label_0.03l.jpg', 'is_active' => true, 'category' => 'Žestoka pića'],
            ['title' => 'JOHNNIE BLACK LABEL 0.03L', 'description' => 'Impresivan whisky kojeg se nudi u svakoj prilici, prava ikona stvorena koristeći viskije minimalne starosti 12 godina iz sva četiri ugla Škotske, ima nepogrešivo gladak, dubok i kompleksan karakter.', 'price' => 9.00, 'image_url' => 'images/johnnie_black_label_0.03l.jpg', 'is_active' => true, 'category' => 'Žestoka pića'],
            ['title' => 'BADEL PELINKOVAC 0.03L', 'description' => 'Najstariji i najpoznatiji Badelov premium hairpin liker, ali i jedno od najintrigantnijih hrvatskih pića. Proizvod datira iz davne 1862.g., godine kada je i osnovana tvrtka Badel 1862. Antique Pelinkovac se od 1862. proizvodi na istovjetan, tradicionalan način, prema izvornom receptu, od 100% prirodnih sastojaka. Okusom ovog premium biljnog likera dominira pelin, aromatska biljka koja se izdvaja mirisom, a zatim i notom gorčine po čemu ga mnogi pamte i prepoznaju zbog blagotvornog djelovanja na organizam što pelinkovac čini savršenim digestivom, ali i jednom od najjačih baza za tradicionalne aperitivne cocktaile.', 'price' => 3.00, 'image_url' => 'images/badel_pelinkovac_0.03l.jpg', 'is_active' => true, 'category' => 'Žestoka pića'],
            ['title' => 'BADEL LAVOV 0.03L', 'description' => 'Poznati biljni liker specifičnog mirisa i gorkastog okusa. Mješavina ljekovitog bilja kao sto su srčanik, kadulja i kičica, koji maceriraju 30 dana, daju prepoznatljivu aromatiku ovom likeru.', 'price' => 3.00, 'image_url' => 'images/badel_lavov_0.03l.jpg', 'is_active' => true, 'category' => 'Žestoka pića'],
            ['title' => 'BADEL TRAVARICA 0.03L', 'description' => 'Ova travarica proizvedena je kombinacijom aromatičnih trava i selekcioniranim vinskim destilatom. Ispunjena mediteranskim okusima, njezina kvaliteta i blagodati bilja čine ju optimalnom za naše tijelo.', 'price' => 3.00, 'image_url' => 'images/badel_travarica_0.03l.jpg', 'is_active' => true, 'category' => 'Žestoka pića'],
            ['title' => 'LORCH WILLIAMS 0.03L', 'description' => '', 'price' => 4.50, 'image_url' => 'images/lorch_williams_0.03l.jpg', 'is_active' => true, 'category' => 'Žestoka pića'],
            ['title' => 'LORCH LIKER VIŠNJA 0.03L', 'description' => '', 'price' => 3.00, 'image_url' => 'images/lorch_liker_višnja_0.03l.jpg', 'is_active' => true, 'category' => 'Žestoka pića'],
            ['title' => 'LORCH LIKER RIBIZLA 0.03L', 'description' => '', 'price' => 3.00, 'image_url' => 'images/lorch_liker_ribizla_0.03l.jpg', 'is_active' => true, 'category' => 'Žestoka pića'],
            ['title' => 'STOCK 0.03L', 'description' => 'Češki brandy koji se proizvodi u Trstu od 1884. po tradicionalnom receptu koristeći kultivirano talijansko grožđe. Njegov karakterističan sklad arome, zlatne boje i jedinstveno sočan okus prepoznatljiv je više od stoljeća.', 'price' => 3.50, 'image_url' => 'images/stock_0.03l.jpg', 'is_active' => true, 'category' => 'Žestoka pića'],
            ['title' => 'MEDUŠA 0.03L', 'description' => 'Puni okus najkvalitetnijeg kestenovog i livadskog meda, stvorenog u ekološki čistom regionu, dopunjen vrhunskom voćnom rakijom i ljekovitim biljem otvara vrata magičnog svijeta Meduške,u kome se miješaju prošlost i sadašnjost. Napravljena po jedinstvenoj recepturi, Meduška će svojim blagim mednim okusom oduševiti vaša čula i povesti vas na vremensko putovanje koje se ne propušta. Služi se umjereno rashlađena.', 'price' => 3.50, 'image_url' => 'images/meduša_0.03l.jpg', 'is_active' => true, 'category' => 'Žestoka pića'],
            ['title' => 'BALLANTINE\'S 0.03L', 'description' => 'Ballantine’s Finest je no. 1 whisky u Europi i 2. u svijetu! Kompleksan, oplemenjen i elegantan škotski viski, cijenjen zbog okusa, koji zadovoljava moderni životni stil. Svijetla zlatna boja i okus koji vam ne može promaknuti rezultat su mješavine jednosladnih i žitnih viskija iz cijele Škotske, koji su dozrijevali barem 3 godine. Okus slada iz Miltonduffa i Glenburgieja daju viskiju Ballantine’s Finest okus čokolade, jabuke i vanilije.', 'price' => 3.00, 'image_url' => 'images/', 'is_active' => true, 'category' => 'Žestoka pića'],
            ['title' => 'CHIVAS REGAL 0.03L', 'description' => 'Ono što ovaj viski čini posebnim je njegova zrelost i način miješanja. Chivas Regal je miks single malt i grain viskija koji su stari najmanje 12 godina, a daju mu izniman i karakterističan okus. Chivas Regal je premium viski s profinjenim i bogatim okusom.', 'price' => 7.00, 'image_url' => 'images/chivas_regal_0.03l.jpg', 'is_active' => true, 'category' => 'Žestoka pića'],
            ['title' => 'UNDERBERG 20ML', 'description' => 'Izvrstan digestiv, radi se po izvornom obiteljskom receptu u koji idu 43 različite biljke. Recept se čuva u krugu obitelji kao poslovna tajna i jedan je od razloga zašto je ovaj digestiv najrasprostranjenije piće ove vrste na svijetu.', 'price' => 4.00, 'image_url' => 'images/underberg_20ml.jpg', 'is_active' => true, 'category' => 'Žestoka pića'],
            ['title' => 'NAKED GROUSE 0.03L', 'description' => 'The Famous Grouse najprodavaniji je whisky u Škotskoj već trideset godina. Nastao je 1896. godine u prvoj destileriji u Škotskoj sljubljivanjem najfinijih malt whiskya kao što su The Macallan i Highland Park. Zbog svoje kvalitete i popularnosti dobio je kraljevski pečat koji danas krasi svaku bocu, a dozrijevanjem u sherry bačvama The Famous Grouse ima slađi okus u odnosu na konkurentske proizvode, zbog čega je prvi izbor većine Škota. Katrakterizira ga izrazita, zlatna i svijetla boja, a ravnoteža njegovih aroma s aromom južnoga voća (agruma) osigurava specifičan čist i dugotrajan okus.', 'price' => 5.00, 'image_url' => 'images/naked_grouse_0.03l.jpg', 'is_active' => true, 'category' => 'Žestoka pića'],
            ['title' => 'TRI I PO JABUKE 0.03L', 'description' => '', 'price' => 3.00, 'image_url' => 'images/tri_i_po_jabuke_0.03l.jpg', 'is_active' => true, 'category' => 'Žestoka pića'],
            ['title' => 'ZLATNA VILIJAMOVKA 0.03L', 'description' => 'Vrhunska voćna rakija, stvorena od odabranih plodova kruške Viljamovke, posjeduje kristalno bistru boju. Istinski gurmani će čašicu viljamovke kombinirati sa mladim sirom neutralnog ukusa ili sa pečenom kruškom punjenom edamerom.', 'price' => 4.50, 'image_url' => 'images/zlatna_vilijamovka_0.03l.jpg', 'is_active' => true, 'category' => 'Žestoka pića'],
            ['title' => 'ZLATNA DUNJA 0.03L', 'description' => 'Zlatna Dunja je izrazito mirisna rakija, gorko-slatke arome dunje. Sadrži 40% alkohola. Zlatna Dunja premium rakija vrhunskog kvaliteta, nastala od pažljivo odabranih plodova dunje. Ugodnog mirisa i bogatog okusa. Nakon kontroliranog procesa fermentacije i destilacije u bakrenim kazanima na tradicionalni način, odlaže se i odležava tri godine do procesa flaširanja. Kristalno bistre boje, pakovana u elegantnu prozirnu staklenu bocu, modernog dizajna, bogastvom mirisa i okusa uspijeva da Vaša osjetila poveže sa prirodom.', 'price' => 4.00, 'image_url' => 'images/zlatna_dunja_0.03l.jpg', 'is_active' => true, 'category' => 'Žestoka pića'],
            ['title' => 'ZLATNA ŠLJIVA 0.03L', 'description' => 'Gružanska zlatna nit je stara rakija šljivovica proizvedena uz primjenu najviših dostignuća u proizvodnji jakih pića. Stari u hrastovim bačvama, u podrumu pod nadzorom stručnog lica i dobrog domaćina. Preporučamo da se servira ohlađena na podrumskoj temperaturi, jer će tada njena izuzetna harmoničnost, poseban, ugodan i blago razvijen miris doći do punog izražaja.', 'price' => 3.00, 'image_url' => 'images/zlatna_šljiva_0.03l.jpg', 'is_active' => true, 'category' => 'Žestoka pića'],
            ['title' => 'ZLATNI PELIN 0.03L', 'description' => 'Zlatni Pelin je prepoznatljiv po izraženom gorkom okusu biljke pelin, iz koje se višemjesečnim odležavanjem u alkoholu oslobađaju najvrednija svojstva. Za puniji okus u svaku bocu Zlatnog pelina se stavlja grančica hercegovačkog pelina, koji spada među najbolje u Europi. Uz nju, razne ljekovite biljke obogaćuju ovaj liker specifičnom aromom i ugodnim, osvježavajućim mirisom. Najbolje ga je konzumirati rashlađenog, kao aperitiv ili digestiv. Odličan je u kombinaciji sa ledom i limunom.', 'price' => 3.00, 'image_url' => 'images/zlatni_pelin_0.03l.jpg', 'is_active' => true, 'category' => 'Žestoka pića'],
            ['title' => 'OLMECA BLANCO TEQUILA 0.03L', 'description' => 'Olmeca je zauzela drugo mjesto u kategoriji premium tequila u svijetu. Olmeca Blanco je tequila koja se puni u boce odmah nakon destilacije i ima aromu limuna, svježeg bilja i paprike.', 'price' => 3.50, 'image_url' => 'images/olmeca_blanco_tequila_0.03l.jpg', 'is_active' => true, 'category' => 'Žestoka pića'],
            ['title' => 'BOS TAURUS WHISKY SINGLE MALT 0.03L', 'description' => 'Kada se govori o viskiju, jednom od najpopularnijih pića, obično se prvo pomisli na Irsku, Škotsku, Ameriku…Rijetki su oni koji bi pomislili da i Bosna i Hercegovina ima svoj viski. I to pravi domaći koji se proizvodi u pivari i destileriji Semizburg u Semizovcu kod Sarajeva.', 'price' => 5.00, 'image_url' => 'images/bos_taurus_whisky_single_malt_0.03l.jpg', 'is_active' => true, 'category' => 'Žestoka pića'],
            ['title' => 'BOS TAURUS WHISKY RYE MALT 0.03L', 'description' => 'Kada se govori o viskiju, jednom od najpopularnijih pića, obično se prvo pomisli na Irsku, Škotsku, Ameriku…Rijetki su oni koji bi pomislili da i Bosna i Hercegovina ima svoj viski. I to pravi domaći koji se proizvodi u pivari i destileriji Semizburg u Semizovcu kod Sarajeva.', 'price' => 5.00, 'image_url' => 'images/bos_taurus_whisky_rye_malt_0.03l.jpg', 'is_active' => true, 'category' => 'Žestoka pića'],
            ['title' => 'ORAHOVAČA 0.03L', 'description' => '', 'price' => 3.00, 'image_url' => 'images/orahovača_0.03l.jpg', 'is_active' => true, 'category' => 'Žestoka pića'],
            ['title' => 'TEQUILA LA CHICA SILVER 0.03L', 'description' => 'Vrlo popularno, tradicionalno meksičko piće koje se proizvodi iz dijelova kaktusa agave. SIERRA TEQUILA SILVER je mlada, čista i oštra. Sierra Tequila dolazi u vrlo zanimljivoj boci s upečatljivom etiketom i čepom u obliku sombrera.', 'price' => 4.00, 'image_url' => 'images/tequila_la_chica_silver_0.03l.jpg', 'is_active' => true, 'category' => 'Žestoka pića'],
            ['title' => 'TEQUILA LA CHICA GOLD 0.03L', 'description' => 'Olmeca je zauzela drugo mjesto u kategoriji premium tequila u svijetu. Olmeca Gold je tequila koja je odležala u malim hrastovim bačvama. Ova tequila nešto je bogatijeg okusa sa slatkastom aromom voća, limuna i grejpa.', 'price' => 4.00, 'image_url' => 'images/tequila_la_chica_gold_0.03l.jpg', 'is_active' => true, 'category' => 'Žestoka pića'],
            ['title' => 'BABA VIŠNJA 0.03L', 'description' => 'Baba Višnja je liker od višnje Maraske, proizveden po originalnoj recepturi. U našim krajevima postoji tradicija pravljenja višnjevače, pa se može često vidjeti da domaćice u teglama drže višnje potopljene u voćnu rakiju. Baba Višnju odlikuje prelijepa boja, kao i bogat voćni okus. Namijenjena je svima koji vole voćne okuse, a najviše onima koji teže da budu svoji. Pije se umjereno rashlađena u svim prigodama, a najčešće uz desert.', 'price' => 3.00, 'image_url' => 'images/baba_višnja_0.03l.jpg', 'is_active' => true, 'category' => 'Žestoka pića'],
            ['title' => 'VIGOR VOTKA 0.03L', 'description' => 'Moderne tehnike proizvodnje vodke čine ovu vrhunsku hrvatsku vodku vrlo mekanom i nježnom. 2019.godine redizajnirana je boca i svrstana je u pića koja imaju najbolji odnos cijena/kvaliteta.', 'price' => 3.00, 'image_url' => 'images/vigor_votka_0.03l.jpg', 'is_active' => true, 'category' => 'Žestoka pića'],
            ['title' => 'GIN BICKENS 0.03L', 'description' => 'Bickens je gin koji savršeno spaja tradiciju i suvremeni pristup i okusom i samim proizvodnim postupkom. U proizvodnji se upotrebljavaju stogodišnji bakreni kotlovi za destilaciju na temelju suvremene recapture te suvremeni kotlovi za destilaciju na temelju recepture stare preko tristo godina. Bickens sadržava samo prirodne sastojke, a okus je dobiven mješavinom deset različitih biljaka prikupljenih diljem svijeta. Da bi se izvuklo najbolje iz odabranih sastojaka, postupak započinje višesatnim miješanjem biljaka i neutralnoga alkohola prije same destilacije, što pridonosi intenziviranju posebnih okusa i oslobađanju odlika upotrijebljenih sastojaka. Unutrašnjost boce otkriva priču o spoju tradicije i modernizacije koja odlikuje ovaj London Dry Gin.', 'price' => 3.50, 'image_url' => 'images/gin_bickens_0.03l.jpg', 'is_active' => true, 'category' => 'Žestoka pića'],

            // Kokteli
            ['title' => 'KOKTEL SALITOS PINK 0.3L', 'description' => 'Svima omiljena boja na plaži – odmah nakon zalaska sunca. SALITOS PINK je elegantna verzija našeg voćnog, pikantnog klasika. Svojom intenzivnom bojom garantovano će ulepšati raspoloženje bez obzira na vremenske prilike. Ultra-voćni ukus jagode sa suptilno izbalansiranim perlažom mami osmeh na usnama svakim gutljajem.', 'price' => 6.50, 'image_url' => 'images/koktel_salitos_pink_0.3l.jpg', 'is_active' => true, 'category' => 'Kokteli'],
            ['title' => 'KOKTEL SALITOS ICE 0.33L', 'description' => 'Lijepa, fina beba – pripremite se da doživite Južnu Ameriku u boci. Ima još osvježavajući okus nego što izgleda! Karbonacija: Blago pjenušava. Napomena za degustaciju: suptilno opor. Senzacija: Jedinstvena, pikantna, citrusna. Pravo voće i posebni dodaci u ovom izbalansiranom receptu najbolje se cijene ledeno hladne za vrhunsko osvježenje sve do vrha jezika.', 'price' => 6.50, 'image_url' => 'images/koktel_salitos_ice_0.33l.jpg', 'is_active' => true, 'category' => 'Kokteli'],
            ['title' => 'KOKTEL SALITOS BLUE 0.33L', 'description' => 'Sa svojom jarko plavom svježinom, SALITOS BLUE nas vodi pravo do mora u pravom južnoameričkom stilu. Intenzivan okus svježeg bobičastog voća i njegova nježna perlaža garantiraju zaista jedinstveno osvježenje.', 'price' => 6.50, 'image_url' => 'images/koktel_salitos_blue_0.33l.jpg', 'is_active' => true, 'category' => 'Kokteli'],
            ['title' => 'KOKTEL SALITOS BEER FLAV.TEQUILA 0.33L', 'description' => 'Napravljen od suncem okupane plave Weber agave, SALITOS Tequila Spirit prenosi zemljani, limunasto svježi karakter svjetski poznate regije Jalisco u Meksiku direktno na jezik poznavaoca! Nepatvorenog karaktera, bez premca po ukusu. Bilo srebro ili zlato.', 'price' => 6.50, 'image_url' => 'images/koktel_salitos_beer_flav.tequila_0.33l.jpg', 'is_active' => true, 'category' => 'Kokteli'],

            // Vino
            ['title' => 'KUTJEVO GRAŠEVINA 0.187L', 'description' => 'Zeleno-žute boje, ugodne svježine, voćnih mirisa jabuke i citrusa i blagih cvijetnih nota.', 'price' => 8.00, 'image_url' => 'images/kutjevo_graševina_0.187l.jpg', 'is_active' => true, 'category' => 'Vino'],
            ['title' => 'VRANAC 0.2L', 'description' => 'Sortno purpurne boje i arome na džemasto voće.', 'price' => 8.00, 'image_url' => 'images/vranac_0.2l.jpg', 'is_active' => true, 'category' => 'Vino'],
            ['title' => 'KUTJEVO GRAŠEVINA 0.75L', 'description' => 'Zeleno-žute boje, kristalno bistro vino, ugodne svježine, svježih voćnih mirisa jabuke citrusa i breskve, uz herbalne note cvijeta lipe i bagrema.', 'price' => 40.00, 'image_url' => 'images/kutjevo_graševina_0.75l.jpg', 'is_active' => true, 'category' => 'Vino'],
            ['title' => 'VRANAC PROCORDE 0.75L', 'description' => 'Vino duboko tamno rubin crvene boje. Na mirisu izražene voćne arome sa dominacijom kupine i trešnje. Dobro izbalansirano vino sa primjetnim taninima koji su fino usklađeni sa tonovima zrelog crvenog voća. Vino je čvrstog tijela, puno i dugotrajno.', 'price' => 50.00, 'image_url' => 'images/vranac_procorde_0.75l.jpg', 'is_active' => true, 'category' => 'Vino'],

            // Roštilj i prilozi
            ['title' => 'PILEĆI SENDVIČ SOLO', 'description' => '(130g piletina, sos, salata)', 'price' => 6.00, 'image_url' => 'images/pileći_sendvič_solo.jpg', 'is_active' => true, 'category' => 'Roštilj i prilozi'],
            ['title' => 'PILEĆI SENDVIČ SA GLJIVAMA', 'description' => '(130g piletina, gljive, sos, salata)', 'price' => 6.50, 'image_url' => 'images/pileći_sendvič_sa_gljivama.jpg', 'is_active' => true, 'category' => 'Roštilj i prilozi'],
            ['title' => 'PILECI SENDVIČ SA PAPRIKOM', 'description' => '(130g piletina, paprika, čedar sir, sos, salata)', 'price' => 7.50, 'image_url' => 'images/pileci_sendvič_sa_paprikom.jpg', 'is_active' => true, 'category' => 'Roštilj i prilozi'],
            ['title' => 'SENDVIČ SA SUHIM MESOM', 'description' => '(suho meso, edamer, kajmak)', 'price' => 5.50, 'image_url' => 'images/sendvič_sa_suhim_mesom.jpg', 'is_active' => true, 'category' => 'Roštilj i prilozi'],
            ['title' => 'SENDVIČ ŠUNKA', 'description' => '(80g šunka, čedar sir, kajmak)', 'price' => 5.50, 'image_url' => 'images/sendvič_šunka.jpg', 'is_active' => true, 'category' => 'Roštilj i prilozi'],
            ['title' => 'HAMBURGER 180 gr', 'description' => '(sos, salata)', 'price' => 6.50, 'image_url' => 'images/hamburger__130_gr.jpg', 'is_active' => true, 'category' => 'Roštilj i prilozi'],
            ['title' => 'HAMBURGER 130 gr', 'description' => '(sos, salata)', 'price' => 5.50, 'image_url' => 'images/hamburger__130_gr.jpg', 'is_active' => true, 'category' => 'Roštilj i prilozi'],
            ['title' => 'CHEESEBURGER 180 gr', 'description' => '', 'price' => 7.50, 'image_url' => 'images/cheeseburger_130_gr.jpg', 'is_active' => true, 'category' => 'Roštilj i prilozi'],
            ['title' => 'CHEESEBURGER 130 gr', 'description' => '', 'price' => 6.50, 'image_url' => 'images/cheeseburger_130_gr.jpg', 'is_active' => true, 'category' => 'Roštilj i prilozi'],
            ['title' => 'PILEĆI ZALOGAJ', 'description' => '', 'price' => 7.00, 'image_url' => 'images/pileći_zalogaj.jpg', 'is_active' => true, 'category' => 'Roštilj i prilozi'],
            ['title' => 'PILEĆA KRILCA', 'description' => '', 'price' => 5.50, 'image_url' => 'images/pileća_krilca.jpg', 'is_active' => true, 'category' => 'Roštilj i prilozi'],
            ['title' => 'ONION RINGS', 'description' => '', 'price' => 3.50, 'image_url' => 'images/onion_rings.jpg', 'is_active' => true, 'category' => 'Roštilj i prilozi'],
            ['title' => 'PEKARSKI KROMPIR OBIČNI', 'description' => '', 'price' => 3.50, 'image_url' => 'images/pekarski_krompir_obični.jpg', 'is_active' => true, 'category' => 'Roštilj i prilozi'],
            ['title' => 'PEKARSKI KROMPIR SA ZAČINOM', 'description' => '', 'price' => 3.50, 'image_url' => 'images/pekarski_krompir_sa_začinom.jpg', 'is_active' => true, 'category' => 'Roštilj i prilozi'],
            ['title' => 'POMFRIT', 'description' => '', 'price' => 3.00, 'image_url' => 'images/pomfrit.jpg', 'is_active' => true, 'category' => 'Roštilj i prilozi'],

            // Hrana
            ['title' => 'UŠTIPCI OBIČNI', 'description' => '(pavlaka, kajmak)', 'price' => 6.00, 'image_url' => 'images/uštipci_obični.jpg', 'is_active' => true, 'category' => 'Hrana'],
            ['title' => 'UŠTIPCI OD HELJDE', 'description' => '(pavlaka, kajmak)', 'price' => 6.50, 'image_url' => 'images/', 'is_active' => true, 'category' => 'Hrana'],
            ['title' => 'UŠTIPCI OBIČNI SUHO MESO', 'description' => '(50g suho meso, 50g kulen, pavlaka, kajmak)', 'price' => 9.50, 'image_url' => 'images/', 'is_active' => true, 'category' => 'Hrana'],
            ['title' => 'UŠTIPCI HELJDA SUHO MESO', 'description' => '(50g suho meso, 50g kulen, pavlaka, kajmak)', 'price' => 10.50, 'image_url' => 'images/uštipci_heljda_suho_meso.jpg', 'is_active' => true, 'category' => 'Hrana'],
            ['title' => 'PILEĆA MASLENICA VELIKA', 'description' => '(150g piletina, edamer, čedar sir, preliv)', 'price' => 11.00, 'image_url' => 'images/pileća_maslenica__velika.jpg', 'is_active' => true, 'category' => 'Hrana'],
            ['title' => 'PILEĆA MASLENICA VELIKA SA SUHIM MESOM', 'description' => '(150g piletina, suho meso, edamer, preliv)', 'price' => 11.00, 'image_url' => 'images/pileća_maslenica__velika.jpg', 'is_active' => true, 'category' => 'Hrana'],
            ['title' => 'PILEĆA MASLENICA MALA SA EDAMEROM', 'description' => '(100g piletina, edamer, preliv)', 'price' => 7.50, 'image_url' => 'images/', 'is_active' => true, 'category' => 'Hrana'],
            ['title' => 'PILEĆA MASLENICA MALA SA ČEDAR SIROM', 'description' => '(100g piletina, edamer, čedar sir, preliv)', 'price' => 8.00, 'image_url' => 'images/pileća_maslenica_mala_sa_čedar_sirom.jpg', 'is_active' => true, 'category' => 'Hrana'],
            ['title' => 'PILEĆA MASLENICA MALA SA SUHIM MESOM', 'description' => '(100g piletina, suho meso, edamer, preliv)', 'price' => 8.00, 'image_url' => 'images/pileća_maslenica__velika.jpg', 'is_active' => true, 'category' => 'Hrana'],
            ['title' => 'PIZZA MARGHERITA', 'description' => '(paradajz sos, sir, origano)', 'price' => 7.50, 'image_url' => 'images/jumbo_pizza_margherita.jpg', 'is_active' => true, 'category' => 'Hrana'],
            ['title' => 'PIZZA CAPPRICIOSSA', 'description' => '(paradajz sos, sir, šunka, gljive, origano)', 'price' => 8.50, 'image_url' => 'images/', 'is_active' => true, 'category' => 'Hrana'],
            ['title' => 'PIZZA KLEK', 'description' => '(kukuruzno brašno, paradajz sos, gljive, suho meso, kajmak, sir, origano)', 'price' => 10.00, 'image_url' => 'images/', 'is_active' => true, 'category' => 'Hrana'],
            ['title' => 'JUMBO PIZZA MARGHERITA', 'description' => '(paradajz sos, sir, origano)', 'price' => 14.00, 'image_url' => 'images/jumbo_pizza_margherita.jpg', 'is_active' => true, 'category' => 'Hrana'],
            ['title' => 'JUMBO PIZZA CAPRICIOSSA', 'description' => '(paradajz sos, sir, šunka, gljive, origano)', 'price' => 16.00, 'image_url' => 'images/jumbo_pizza_capriciossa.jpg', 'is_active' => true, 'category' => 'Hrana'],
            ['title' => 'JUMBO PIZZA KLEK', 'description' => '(kukuruzno brašno, paradajz sos, gljive, suho meso, kajmak, sir, origano)', 'price' => 18.50, 'image_url' => 'images/jumbo_pizza_klek.jpg', 'is_active' => true, 'category' => 'Hrana'],
        ];

        Article::truncate();

        $barCategories = ['Toplo, ali osvježavajuće', 'Hladno i očaravajuće', 'Pivo u bocama tamno', 'Pivo u bocama svijetlo', 'Točeno pivo', 'Žestoka pića', 'Kokteli', 'Vino',];
        $barPrinter = Printer::where('name', 'Bar')->first();
        $kuhinjaPrinter = Printer::where('name', 'Kuhinja')->first();

        foreach ($articles as $article) {
            $category = Category::where('name', $article['category'])->first();
            if ($category) {
                $newArticle = Article::create([
                    'title' => $article['title'],
                    'description' => $article['description'],
                    'price' => $article['price'],
                    'image_url' => $article['image_url'],
                    'is_active' => $article['is_active'],
                ]);

                $newArticle->category()->attach($category->id);

                if (in_array($article['category'], ['Hrana', 'Roštilj i prilozi'])) {
                    $newArticle->printer()->attach($kuhinjaPrinter->id);
                } elseif (in_array($article['category'], $barCategories)) {
                    $newArticle->printer()->attach($barPrinter->id);
                }
            }
        }

        $this->info('Seeding articles completed successfully!');
    }

    private function seedPrinters()
    {
        $printers= [
            [
                'name' => 'Kuhinja',
                'printer_name' => 'MPT-II',
                'mac_address' => '60:6E:41:62:DE:20',
                'interface' => 'Bluetooth',
            ],
            [
                'name' => 'Bar',
                'printer_name' => 'MPT-II',
                'mac_address' => '60:6E:41:62:DE:1F',
                'interface' => 'Bluetooth',
            ],
            [
                'name' => 'Epson',
                'printer_name' => 'TM-T88VII',
                'mac_address' => 'DC:C2:DF:1A:01:A6',
                'interface' => 'USB',
            ],
        ];

        Printer::truncate();

        foreach ($printers as $printer) {
            Printer::create([
                'name' => $printer['name'],
                'printer_name' => $printer['printer_name'],
                'mac_address' => $printer['mac_address'],
                'interface' => $printer['interface'],
            ]);
        }

        $this->info('Seeding printers completed successfully!');
    }

    private function seedTables()
    {
        $tables = [
            [
                'number' => 1,
                'code' => 'XYZ12',
                'web_page' => 'http://192.168.0.102/menu-order?table=XYZ12',
                'is_active' => true,
            ],
            [
                'number' => 2,
                'code' => 'YXZ21',
                'web_page' => 'http://192.168.0.102/menu-order?table=YXZ21',
                'is_active' => true,
            ],
            [
                'number' => 3,
                'code' => 'CD87K',
                'web_page' => 'http://192.168.0.102/menu-order?table=CD87K',
                'is_active' => true,
            ],
            [
                'number' => 4,
                'code' => 'LKN23',
                'web_page' => 'http://192.168.0.102/menu-order?table=LKN23',
                'is_active' => true,
            ],
            [
                'number' => 5,
                'code' => '9K3N8',
                'web_page' => 'http://192.168.0.102/menu-order?table=9K3N8',
                'is_active' => true,
            ],
        ];

        Rtable::truncate();

        foreach ($tables as $table) {
            Rtable::create([
                'number' => $table['number'],
                'code' => $table['code'],
                'web_page' => $table['web_page'],
                'is_active' => $table['is_active'],
            ]);
        }

        $this->info('Seeding tables completed successfully!');
    }
}
