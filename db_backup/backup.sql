--
-- PostgreSQL database dump
--

-- Dumped from database version 17.2
-- Dumped by pg_dump version 17.2

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: preferiti; Type: TABLE; Schema: public; Owner: www
--

CREATE TABLE public.preferiti (
    username character varying NOT NULL,
    id character varying
);


ALTER TABLE public.preferiti OWNER TO www;

--
-- Name: ricette; Type: TABLE; Schema: public; Owner: www
--

CREATE TABLE public.ricette (
    nome text NOT NULL,
    descrizione text NOT NULL,
    foto character varying DEFAULT './img/padella.jpg'::character varying,
    ingredienti text NOT NULL,
    preparazione text NOT NULL,
    id integer NOT NULL,
    data_keywords character varying,
    difficolta character varying,
    tempo character varying,
    dosi character varying,
    presentazione character varying
);


ALTER TABLE public.ricette OWNER TO www;

--
-- Name: utente; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.utente (
    username character varying NOT NULL,
    password character varying NOT NULL,
    nome character varying NOT NULL,
    cognome character varying NOT NULL,
    foto character varying DEFAULT './immaginiUser/user.png'::character varying
);


ALTER TABLE public.utente OWNER TO postgres;

--
-- Data for Name: preferiti; Type: TABLE DATA; Schema: public; Owner: www
--

COPY public.preferiti (username, id) FROM stdin;
\.


--
-- Data for Name: ricette; Type: TABLE DATA; Schema: public; Owner: www
--

COPY public.ricette (nome, descrizione, foto, ingredienti, preparazione, id, data_keywords, difficolta, tempo, dosi, presentazione) FROM stdin;
Spaghetti Cacio e Pepe	Un classico della cucina romana, cremoso e saporito, con soli tre ingredienti che si trasformano in pura magia.	./img/SpaghettiCacioPepe.jpg	<ul>\n    <li>200g di spaghetti</li>\n    <li>100g di pecorino romano grattugiato</li>\n    <li>2g di pepe nero in grani</li>\n</ul>	<p><span style="font-weight: bold; color: orange;">Passo 1:</span> Porta a ebollizione una pentola con abbondante acqua salata e cuoci gli spaghetti al dente.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 2:</span> Nel frattempo, tosta i grani di pepe nero in una padella a fuoco medio e poi pestali grossolanamente.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 3:</span> In una ciotola, mescola il pecorino grattugiato con un mestolo di acqua di cottura della pasta, mescolando fino a ottenere una crema liscia.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 4:</span> Scola gli spaghetti (conservando altra acqua di cottura) e versali nella padella con il pepe tostato.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 5:</span> A fuoco spento, aggiungi la crema di pecorino, mescolando energicamente e aggiungendo acqua di cottura se necessario per ottenere una consistenza cremosa.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 6:</span> Servi subito con un’ulteriore spolverata di pepe nero e pecorino grattugiato.</p>	1	spaghetti,cacio,pepe,pasta	Facile	20 minuti	2 persone	Cacio e pepe è un piatto che racconta una storia: quella dei pastori romani, che con pochi ingredienti creavano un capolavoro di semplicità e gusto. Il segreto? Il perfetto equilibrio tra il pecorino, il pepe e l’acqua di cottura, che deve trasformarsi in una crema vellutata avvolgente. Il profumo del pepe tostato riempie la cucina, e ogni forchettata è un abbraccio caldo che sa di tradizione. Non c’è bisogno di panna o burro: la cremosità nasce dalla tecnica e dalla qualità degli ingredienti. Prepararlo è un’arte, ma una volta padroneggiata, diventa una coccola irrinunciabile!
Tiramisù Classico	Il dessert italiano per eccellenza, un mix perfetto tra crema vellutata al mascarpone e il gusto intenso del caffè. 	./img/Tiramisu	<ul>\n    <li>300g di savoiardi</li>\n    <li>3 uova fresche</li>\n    <li>100g di zucchero</li>\n    <li>250g di mascarpone</li>\n    <li>200ml di caffè espresso amaro</li>\n    <li>30g di cacao amaro in polvere</li>\n</ul>	<p><span style="font-weight: bold; color: orange;">Passo 1</span>: Separa i tuorli dagli albumi. Monta i tuorli con lo zucchero fino a ottenere un composto chiaro e spumoso.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 2</span>: Aggiungi il mascarpone e mescola delicatamente fino a ottenere una crema omogenea.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 3</span>: Monta a neve gli albumi e incorporali al composto con movimenti delicati dal basso verso l’alto.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 4</span>: Immergi velocemente i savoiardi nel caffè e disponili in uno strato in una pirofila.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 5</span>: Copri con uno strato di crema al mascarpone, poi ripeti l’operazione fino a esaurire gli ingredienti.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 6</span>: Spolvera la superficie con cacao amaro e lascia riposare in frigo per almeno 4 ore prima di servire.</p>	2	tiramisu,savoiardi,mascarpone,caffè	Media	30 minuti	6 persone	Il tiramisù è il dolce che mette d’accordo tutti: cremoso, profumato, avvolgente. Ogni cucchiaiata è un viaggio nei sapori della tradizione italiana, con il mascarpone che si scioglie in bocca e il caffè che regala quella nota decisa e inconfondibile. Il segreto? Non avere fretta: far riposare il tiramisù in frigorifero è essenziale per amalgamare i sapori e rendere ogni strato un’esplosione di gusto. Servilo in una teglia classica o in monoporzioni eleganti, e lasciati conquistare dal suo irresistibile richiamo. Un morso e sarai subito in una pasticceria italiana, tra aromi di caffè e dolcezza pura.
Risotto allo Zafferano	Un primo piatto raffinato e cremoso, con il colore dorato e il profumo inconfondibile dello zafferano.	./img/RisottoZafferano	<ul>\n    <li>320g di riso Carnaroli</li>\n    <li>1 bustina di zafferano</li>\n    <li>1l di brodo vegetale caldo</li>\n    <li>1 scalogno</li>\n    <li>50g di burro</li>\n    <li>50g di Parmigiano Reggiano grattugiato</li>\n    <li>100ml di vino bianco secco</li>\n    <li>Sale e pepe q.b.</li>\n</ul>	<p><span style="font-weight: bold; color: orange;">Passo 1</span>: In una casseruola, sciogli metà del burro e fai soffriggere lo scalogno tritato fino a doratura.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 2</span>: Aggiungi il riso e tostalo per 2 minuti, poi sfuma con il vino bianco.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 3</span>: Quando il vino sarà evaporato, inizia ad aggiungere il brodo poco alla volta, mescolando continuamente.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 4</span>: A metà cottura (dopo circa 10 minuti), sciogli lo zafferano in un mestolo di brodo e versalo nel risotto.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 5</span>: Continua a cuocere aggiungendo brodo fino a ottenere la consistenza desiderata.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 6</span>: Spegni il fuoco, manteca con il burro rimasto e il Parmigiano, copri per un minuto e poi mescola bene prima di servire.</p>	3	risotto,zafferano,brodo,pasta	Media	30 minuti	4 persone	Il risotto allo zafferano è l’eleganza servita in un piatto. Il suo colore dorato richiama il sole di un tramonto lombardo, mentre la sua cremosità avvolge il palato in un abbraccio vellutato. Il segreto? La tostatura iniziale del riso e la pazienza nel mescolare, perché un buon risotto richiede attenzione e amore. Ogni chicco deve essere perfettamente cotto, con il gusto delicato dello zafferano che si diffonde ad ogni boccone. Servitelo con una spolverata di Parmigiano extra e preparatevi a conquistare i vostri ospiti!\n
Pollo al Limone	Un secondo piatto semplice ma delizioso, con carne succosa e una salsa agrumata irresistibile.\n	./img/PolloLimone	<ul>\n    <li>2 petti di pollo</li>\n    <li>1 limone biologico (succo e scorza)</li>\n    <li>30g di burro</li>\n    <li>1 cucchiaio di farina</li>\n    <li>200ml di brodo di pollo</li>\n    <li>1 spicchio d’aglio</li>\n    <li>Sale e pepe q.b.</li>\n</ul>	<p><span style="font-weight: bold; color: orange;">Passo 1:</span> Infarina leggermente i petti di pollo e scuoti via l’eccesso di farina.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 2:</span> In una padella, sciogli il burro e rosola lo spicchio d’aglio intero.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 3:</span> Aggiungi i petti di pollo e cuocili a fuoco medio fino a doratura su entrambi i lati.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 4:</span> Versa il succo di limone e il brodo di pollo, abbassa il fuoco e lascia cuocere per 10 minuti finché la salsa si addensa leggermente.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 5:</span> Aggiungi la scorza di limone grattugiata, mescola bene e servi caldo con contorno di verdure o riso.</p>	4	pollo,limone	Facile	20 minuti	2 persone	Il pollo al limone è la perfetta combinazione tra freschezza e sapore, un piatto che profuma di Mediterraneo. La carne rimane tenera e succosa, mentre la salsa agrumata regala una nota vivace che rende ogni boccone irresistibile. È la ricetta ideale per chi cerca un secondo leggero ma gustoso, da accompagnare con un’insalata croccante o un contorno di riso basmati. Il segreto? Usare un limone biologico e non avere paura di abbondare con la scorza, che aggiunge un tocco aromatico incredibile. Servitelo ben caldo e lasciatevi conquistare dalla sua semplicità raffinata!\n
Torta di Mele Soffice	Un dolce da credenza irresistibile, con un cuore morbido e il profumo avvolgente della cannella.\n	./img/TortaMele	<ul>\n    <li>3 mele Golden</li>\n    <li>250g di farina 00</li>\n    <li>150g di zucchero</li>\n    <li>3 uova</li>\n    <li>100ml di latte</li>\n    <li>80g di burro fuso</li>\n    <li>1 bustina di lievito per dolci</li>\n    <li>1 cucchiaino di cannella</li>\n    <li>Succo di ½ limone</li>\n</ul>	<p><span style="font-weight: bold; color: orange;">Passo 1 :</span> Sbuccia le mele, tagliale a fettine sottili e irrorale con succo di limone per non farle annerire.</p>\n    <hr>\n    <p><span style="font-weight: bold; color: orange;">Passo 2 :</span> In una ciotola, monta le uova con lo zucchero fino a ottenere un composto chiaro e spumoso.</p>\n    <hr>\n    <p><span style="font-weight: bold; color: orange;">Passo 3 :</span> Aggiungi il burro fuso e il latte, continuando a mescolare.</p>\n    <hr>\n    <p><span style="font-weight: bold; color: orange;">Passo 4 :</span> Incorpora la farina setacciata con il lievito e la cannella, amalgamando fino a ottenere un impasto omogeneo.</p>\n    <hr>\n    <p><span style="font-weight: bold; color: orange;">Passo 5 :</span> Versa metà dell’impasto in una tortiera imburrata e infarinata, distribuisci metà delle mele, poi copri con il restante impasto e finisci con le mele in superficie.</p>\n    <hr>\n    <p><span style="font-weight: bold; color: orange;">Passo 6 :</span> Inforna a 180°C per 40-45 minuti. Fai la prova stecchino prima di sfornare.</p>	5	torta,limone,mele,soffice	Facile	60 minuti	8 persone	La torta di mele è il dolce che sa di casa, di pomeriggi in famiglia e di cucine che profumano di buono. Morbida, avvolgente, con quelle fettine di mela che si sciolgono in bocca, è un comfort food perfetto in ogni stagione. Il segreto per un impasto soffice? Montare bene le uova e non avere paura di abbondare con la cannella, che regala un profumo irresistibile. Perfetta con una tazza di tè fumante o un velo di zucchero a velo, questa torta è il classico che non stanca mai. Provatela e lasciatevi trasportare dai ricordi più dolci!
Lasagna alla Bolognese	Un primo piatto ricco e avvolgente, con strati di pasta, ragù saporito e besciamella cremosa.\n	./img/Lasagna.jpg	<h2>Per il Ragù:</h2>\n    <ul>\n        <li>400g di macinato misto (manzo e maiale)</li>\n        <li>1 carota, 1 costa di sedano, 1 cipolla</li>\n        <li>500ml di passata di pomodoro</li>\n        <li>1 bicchiere di vino rosso</li>\n        <li>3 cucchiai di olio d’oliva</li>\n        <li>Sale e pepe q.b.</li>\n    </ul>\n\n    <h2>Per la Besciamella:</h2>\n    <ul>\n        <li>500ml di latte</li>\n        <li>50g di burro</li>\n        <li>50g di farina</li>\n        <li>Noce moscata e sale q.b.</li>\n    </ul>\n\n    <h2>Per Assemblare:</h2>\n    <ul>\n        <li>250g di sfoglie di lasagna</li>\n        <li>100g di Parmigiano Reggiano grattugiato</li>\n    </ul>	<p><span style="font-weight: bold; color: orange;">Passo 1:</span> Prepara il ragù: soffriggi carota, sedano e cipolla tritati con l’olio. Aggiungi la carne e rosola, poi sfuma con il vino. Versa la passata di pomodoro, aggiusta di sale e pepe e cuoci a fuoco basso per almeno 1 ora.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 2:</span> Prepara la besciamella: sciogli il burro, aggiungi la farina mescolando e poi il latte a filo. Continua a mescolare finché si addensa, poi aggiungi sale e noce moscata.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 3:</span> Assembla la lasagna: in una teglia, alterna strati di pasta, ragù, besciamella e Parmigiano. Continua fino a esaurire gli ingredienti, finendo con besciamella e Parmigiano in superficie.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 4:</span> Cuoci in forno statico a 180°C per circa 30 minuti. Lascia riposare 10 minuti prima di servire.</p>	6	lasagna,bolognese,pasta	Media	120 minuti	6 persone	La lasagna alla Bolognese è il piatto che sa di domenica, di pranzi in famiglia e di attesa trepidante mentre il forno sprigiona il suo profumo irresistibile. Strato dopo strato, la magia si compone: la sfoglia che si fonde con il ragù, la besciamella che avvolge tutto con la sua cremosità e il Parmigiano che regala quella crosticina dorata inconfondibile. È comfort food nella sua espressione più autentica, un piatto che coccola e conquista al primo assaggio. Non c’è niente di meglio di una forchettata di lasagna fumante per sentirsi a casa, ovunque tu sia!\n
Crostata alla Marmellata	Un dolce classico e friabile, con una base di pasta frolla burrosa e un cuore di marmellata vellutata.\n	./img/CrostataMarmellata.jpg	<ul>\n    <li>250g di farina 00</li>\n    <li>120g di burro freddo</li>\n    <li>100g di zucchero</li>\n    <li>1 uovo intero + 1 tuorlo</li>\n    <li>Scorza di 1 limone grattugiata</li>\n    <li>300g di marmellata a scelta</li>\n</ul>	<p><span style="font-weight: bold; color: orange;">Passo 1:</span> In una ciotola, mescola la farina con il burro a pezzetti fino a ottenere un composto sabbioso.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 2:</span> Aggiungi lo zucchero, la scorza di limone, l’uovo e il tuorlo. Impasta velocemente fino a ottenere un panetto omogeneo.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 3:</span> Avvolgi la frolla nella pellicola e lascia riposare in frigo per almeno 30 minuti.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 4:</span> Stendi la pasta e fodera uno stampo imburrato. Bucherella il fondo con una forchetta e spalma la marmellata.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 5:</span> Con la frolla avanzata, crea delle strisce per decorare la superficie.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 6:</span> Inforna a 180°C per 30-35 minuti. Lascia raffreddare prima di servire.</p>	7	crostata,marmellata	Facile	60 minuti	8 persone	La crostata alla marmellata è il dolce che non passa mai di moda, quello che trovi sempre in cucina, pronto a regalarti una colazione speciale o una merenda golosa. La frolla è friabile e profumata, grazie alla scorza di limone che esalta ogni morso, mentre la marmellata aggiunge la giusta dolcezza, che sia di albicocche, fragole o frutti di bosco. Il suo aspetto rustico, con quelle strisce dorate intrecciate, la rende irresistibile già alla vista. Accompagnata da un tè caldo o da una tazza di caffè, diventa il simbolo perfetto della semplicità che conquista. Un dolce che sa di casa, di nonne che impastano con amore e di ricordi felici!
Spaghetti alle Vongole	Un primo piatto raffinato e saporito, con il gusto autentico del mare e un tocco di prezzemolo fresco.\n	./img/SpaghettiVongole	<ul>\n    <li>320g di spaghetti</li>\n    <li>1kg di vongole fresche</li>\n    <li>2 spicchi d’aglio</li>\n    <li>100ml di vino bianco secco</li>\n    <li>4 cucchiai di olio extravergine d’oliva</li>\n    <li>Prezzemolo fresco tritato q.b.</li>\n    <li>Peperoncino q.b. (opzionale)</li>\n    <li>Sale q.b.</li>\n</ul>	<p><span style="font-weight: bold; color: orange;">Passo 1:</span> Metti le vongole a spurgare in acqua salata per almeno 2 ore. Sciacquale sotto l’acqua corrente.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 2:</span> In una padella capiente, scalda l’olio e soffriggi l’aglio con il peperoncino.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 3:</span> Aggiungi le vongole e sfuma con il vino bianco. Copri e lascia cuocere finché si aprono (circa 5 minuti).</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 4:</span> Cuoci gli spaghetti in abbondante acqua salata, scolali al dente e versali nella padella con le vongole.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 5:</span> Salta il tutto per un paio di minuti, aggiungi il prezzemolo tritato e servi subito.</p>	8	spaghetti, vongole, pasta	Facile	30 minuti	4 persone	Gli spaghetti alle vongole sono un omaggio alla cucina mediterranea, un piatto che profuma di mare e vacanze. Ogni boccone racchiude la sapidità dell’oceano, esaltata dal vino bianco e dal tocco aromatico del prezzemolo. Il segreto? Usare vongole freschissime e non cuocerle troppo, per preservarne tutta la succosità. Perfetto per una cena elegante ma senza stress, questo piatto si abbina magnificamente a un bicchiere di vino bianco freddo. Che sia estate o inverno, portare in tavola un piatto di spaghetti alle vongole è sempre un’ottima idea!
Uova Strapazzate con Verdure	Un secondo piatto proteico e colorato, facile da personalizzare con le verdure preferite.\n	./img/UovaStrapazzate.jpg	<ul>\n  <li>4 uova</li>\n  <li>1 zucchina media</li>\n  <li>1 peperone piccolo</li>\n  <li>1 cipolla piccola</li>\n  <li>2 cucchiai di olio extravergine d’oliva</li>\n  <li>Sale e pepe q.b.</li>\n</ul>	<p><span style="font-weight: bold; color: orange;">Passo 1:</span> Lava le verdure e tagliale a cubetti.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 2:</span> In una padella, scalda l’olio e soffriggi la cipolla fino a doratura.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 3:</span> Aggiungi il peperone e la zucchina, cuocendo per circa 5-7 minuti fino a quando sono tenere.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 4:</span> In una ciotola, sbatti le uova con un pizzico di sale e pepe.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 5:</span> Versa le uova nella padella con le verdure e cuoci a fuoco medio, mescolando continuamente fino a raggiungere la consistenza desiderata.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 6:</span> Servi caldo, accompagnato da pane tostato se desiderato.</p>	9	uova,strapazzate,verdure	Facile	15 minuti	2 persone	Le uova strapazzate con verdure sono un’ottima soluzione per un pasto nutriente e veloce. Questo piatto versatile permette di utilizzare le verdure di stagione o quelle che si hanno a disposizione, rendendolo perfetto per gli studenti che cercano di combinare gusto e semplicità. Accompagnato da una fetta di pane integrale, diventa un pasto completo e soddisfacente.\n
⁠Pasta con Pomodoro e Mozzarella\n	Un classico primo piatto italiano, semplice e gustoso, con pomodoro fresco e mozzarella filante.\n	./img/PastaPomodoro.jpg	<ul>\n  <li>200g di pasta (penne o fusilli)</li>\n  <li>200g di pomodorini ciliegia</li>\n  <li>125g di mozzarella</li>\n  <li>2 cucchiai di olio extravergine d’oliva</li>\n  <li>1 spicchio d’aglio</li>\n  <li>Basilico fresco q.b.</li>\n  <li>Sale e pepe q.b.</li>\n</ul>	<p><span style="font-weight: bold; color: orange;">Passo 1:</span> Cuoci la pasta in abbondante acqua salata secondo le istruzioni sulla confezione.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 2:</span> Nel frattempo, in una padella, scalda l’olio e soffriggi l’aglio fino a doratura.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 3:</span> Aggiungi i pomodorini tagliati a metà e cuoci per circa 5 minuti.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 4:</span> Scola la pasta al dente e aggiungila alla padella con i pomodorini.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 5:</span> Aggiungi la mozzarella a cubetti e mescola fino a quando non inizia a sciogliersi.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 6:</span> Condisci con sale, pepe e basilico fresco.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 7:</span> Servi caldo.</p>	10	pasta,pomodoro,mozzarella	Facile	20 minuti	2 persone	La pasta con pomodoro e mozzarella è un piatto che racchiude i sapori autentici dell’Italia. La dolcezza dei pomodorini si combina perfettamente con la cremosità della mozzarella, creando un’esperienza culinaria semplice ma deliziosa. Perfetto per una cena veloce dopo una lunga giornata di studio, questo piatto ti farà sentire come a casa.
Pasta con Tonno e Limone	Un primo piatto leggero e saporito, perfetto per un pasto veloce.\n	./img/SpaghettiTonno.jpg	<ul>\n  <li>200g di pasta (preferibilmente spaghetti o penne)</li>\n  <li>1 scatoletta di tonno sott’olio (circa 80g)</li>\n  <li>1 limone non trattato</li>\n  <li>2 cucchiai di olio extravergine d’oliva</li>\n  <li>Sale e pepe q.b.</li>\n  <li>Prezzemolo fresco tritato (opzionale)</li>\n</ul>	<p><span style="font-weight: bold; color: orange;">Passo 1:</span> Cuoci la pasta in abbondante acqua salata secondo le istruzioni sulla confezione.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 2:</span> Nel frattempo, scola il tonno dall’olio e sgranalo con una forchetta in una ciotola.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 3:</span> Grattugia la scorza del limone e spremine il succo.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 4:</span> In una padella, scalda l’olio d’oliva, aggiungi il tonno e fallo insaporire per un paio di minuti.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 5:</span> Aggiungi la scorza e il succo di limone, mescolando bene.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 6:</span> Scola la pasta al dente e trasferiscila nella padella con il condimento.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 7:</span> Salta la pasta per un minuto, aggiustando di sale e pepe.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 8:</span> Servi caldo, guarnendo con prezzemolo fresco se desiderato.</p>	11	pasta,tonno,limone	Facile	15 minuti	2 persone	La pasta con tonno e limone è un classico salva-cena per gli studenti. La freschezza del limone si sposa perfettamente con la sapidità del tonno, creando un piatto equilibrato e gustoso. Con ingredienti che spesso si hanno già in dispensa, questo piatto si prepara in un lampo, ideale per chi ha poco tempo ma non vuole rinunciare al gusto.\n
Insalata di Riso	Un piatto unico fresco e colorato, ideale per pranzi veloci o da portare con sé.	./img/InsalataRiso.jpg	<ul>\n    <li>150g di riso per insalate</li>\n    <li>80g di tonno in scatola</li>\n    <li>50g di mais dolce</li>\n    <li>50g di piselli lessati</li>\n    <li>50g di olive nere denocciolate</li>\n    <li>1 carota</li>\n    <li>2 cucchiai di olio extravergine d’oliva</li>\n    <li>Succo di mezzo limone</li>\n    <li>Sale e pepe q.b.</li>\n</ul>	<p><span style="font-weight: bold; color: orange;">Passo 1:</span> Cuoci il riso in abbondante acqua salata, scolalo al dente e lascialo raffreddare.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 2:</span> Scola il tonno e il mais.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 3:</span> Taglia la carota a cubetti piccoli.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 4:</span> In una ciotola capiente, unisci il riso, il tonno, il mais, i piselli, le olive e la carota.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 5:</span> Condisci con olio, succo di limone, sale e pepe.</p>\n<hr>\n<p><span style="font-weight: bold; color: orange;">Passo 6:</span> Mescola bene e lascia riposare.</p>	12	insalta,riso	Facile	25 minuti	2 persone	L’insalata di riso è un piatto estivo per eccellenza, amato per la sua freschezza, versatilità e facilità di preparazione. Perfetta per un pranzo leggero, un picnic all’aperto o come piatto da portare in ufficio, questa ricetta combina sapori e consistenze in un’esplosione di gusto. La base di riso si arricchisce con ingredienti colorati e nutrienti come tonno, mais, piselli, olive e carote, il tutto condito con un filo di olio extravergine d’oliva e una spruzzata di succo di limone per esaltarne la freschezza. La bellezza dell’insalata di riso risiede nella sua adattabilità: puoi personalizzarla con gli ingredienti che preferisci o che hai a disposizione, rendendola ogni volta unica. Preparala in anticipo e conservala in frigorifero; i sapori si amalgameranno ancora di più, regalando un piatto sempre più gustoso con il passare del tempo. Semplice, economica e deliziosa, l’insalata di riso è la soluzione ideale per chi desidera un pasto sano senza rinunciare al sapore.
\.


--
-- Data for Name: utente; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.utente (username, password, nome, cognome, foto) FROM stdin;
\.


--
-- Name: ricette ricette_pkey; Type: CONSTRAINT; Schema: public; Owner: www
--

ALTER TABLE ONLY public.ricette
    ADD CONSTRAINT ricette_pkey PRIMARY KEY (id);


--
-- Name: utente utente_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.utente
    ADD CONSTRAINT utente_pkey PRIMARY KEY (username, password);


--
-- Name: SCHEMA public; Type: ACL; Schema: -; Owner: pg_database_owner
--

GRANT USAGE ON SCHEMA public TO www;


--
-- Name: TABLE utente; Type: ACL; Schema: public; Owner: postgres
--

GRANT SELECT,INSERT,UPDATE ON TABLE public.utente TO www;


--
-- PostgreSQL database dump complete
--

