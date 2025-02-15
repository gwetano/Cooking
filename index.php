<?php
session_start();
require './db.php';
require_once './funzioni.php'
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style.css">
    <title>Index</title>
    <script defer src="./funzioni.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="./img/icon.png">
    <link
        href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap">
</head>

<body>

    <header>
        <div class="logo">
            <img src="./img/icon.png">
        </div>

        <div class="title">
            <h1>Cooking</h1>
        </div>
        <?php if (isset($_SESSION['username'])) { ?>
            <div class="loggato">
                <a href="./account.php"> <img src="./img/username.png"></a>
            </div>
        <?php } else { ?>
            <div class="nonLoggato">
                <a href="./accesso.php"> Accesso</a>
            </div>
        <?php } ?>
    </header>

    <main id="mainIndex">

        <?php if (isset($_SESSION['username'])) {
            /* UTENTE LOGGATO */
            $username = $_SESSION['username']; ?>
            <div class="mainColumn1">
                <?php $idRicettaDelGiorno = generaIdCasuale(); ?>
                <div class="contenutoMainColumnRicettaDelGiorno" onclick="vaiAllaRicetta(event,<?php echo $idRicettaDelGiorno; ?>)">
                    <h1>Ricetta del giorno</h1>
                    <div class="ricette" id="ricettaDelGiorno">
                        <div class="ricetta">
                            <div class="infoRicetta">
                                <div class="nomeRicetta">
                                    <span> <?php
                                    echo getNomeRicetta($idRicettaDelGiorno); ?></span>
                                </div>
                            </div>
                            <div class="containerFotoRicetta">
                                <img src=<?php
                                echo getFotoRicetta($idRicettaDelGiorno) ?> alt="ricettaDelGiorno"
                                    class="fotoRicetta">
                            </div>
                        </div>
                        <div class="infoRicettaDelGiorno">
                            <p> <img src="./img/difficoltà.png" alt="difficoltà">DIFFICOLTA' : <span style="color:red;">
                                    FACILE </span></p>
                            <p> <img src="./img/orologio.png" alt="orologio"> PRONTO IN : <span style="color:red;"> 4
                                    minuti </span> </p>
                            <p> <img src="./img/mangiare.png" alt="dosi"> DOSI PER : <span style="color:red;"> 4 persone
                                </span> </p>
                        </div>
                    </div>

                    <div class="presentazioneRicettaDelGiorno">

                        <h3>Presentazione</h3>
                        <p>
                            Gli spaghetti aglio e olio sono un piatto simbolo della tradizione culinaria italiana,
                            semplice
                            ma ricco di sapore. Originari della Campania, ma amati in tutta Italia, questo piatto mette
                            in
                            evidenza l’arte di cucinare con pochi ingredienti di qualità. Il profumo avvolgente
                            dell’aglio,
                            il gusto ricco e aromatico dell’olio extravergine di oliva, e la piccantezza delicata del
                            peperoncino si combinano perfettamente per un’esperienza gustativa indimenticabile.

                            Questa ricetta, ideale per una cena veloce o un pranzo senza compromessi sul gusto, si
                            prepara
                            in pochi minuti e può essere personalizzata con aggiunta di prezzemolo fresco o una
                            spolverata
                            di formaggio grattugiato, se lo desideri. Facile da preparare ma incredibilmente saporito,
                            gli
                            spaghetti aglio e olio sono il comfort food per eccellenza.

                        </p>
                    </div>
                </div>
            </div>

            <div class="mainColumn2">
                <div class="contenutoMainColumn">
                    <h1>Le tue ricette preferite</h1>
                    <?php
                    $ricettePreferite = getRicettePreferite($username);
                    if (!empty($ricettePreferite)) { ?>
                        <div class="ricette">
                            <?php
                            $counter = 0;
                            foreach ($ricettePreferite as $id) {
                                if($counter >= 4)
                                    break;
                                $nome = getNomeRicetta($id);
                                $descrizione = getDescrizioneRicetta($id);
                                $foto = getFotoRicetta($id);
                                ?>
                                <div class="ricetta<?php echo $id ?>" onclick="vaiAllaRicetta(event, <?php echo $id; ?>)">
                                    <div class="infoRicetta">
                                        <div class="nomeRicetta">
                                            <span><?php
                                            echo $nome; ?></span>

                                        </div>
                                        <div class="descrizioneRicetta">
                                            <span><?php
                                            echo $descrizione; ?></span>
                                        </div>
                                    </div>
                                    <div class="containerFotoRicetta">
                                        <img src="<?php echo htmlspecialchars($foto); ?>" alt="ricetta<?php echo $id; ?>"
                                            class="fotoRicetta">
                                    </div>
                                </div>

                                <?php
                                $counter ++;
                            }
                            ?>
                        </div><?php
                    } else { ?>
                        <div class="contenutoEmptyMainColumn1">
                            <p>Nessuna ricetta nei preferiti</p>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <?php
            /* UTENTE NON LOGGATO */
        } else { ?>
                <div class="mainColumn1">
                    <div class="contenutoMainColumnRicettaDelGiorno" onclick="registerOrLogin()">
                        <h1>Ricetta del giorno</h1>
                        <?php $idRicettaDelGiorno = generaIdCasuale(); ?>
                        <div class="ricette" id="ricettaDelGiorno">
                            <div class="ricetta">
                                <div class="infoRicetta">
                                    <div class="nomeRicetta">
                                        <span> <?php
                                        echo getNomeRicetta($idRicettaDelGiorno); ?></span>
                                    </div>
                                </div>
                                <div class="containerFotoRicetta">
                                    <img src=<?php
                                    echo getFotoRicetta($idRicettaDelGiorno) ?> alt="ricettaDelGiorno"
                                        class="fotoRicetta">
                                </div>
                            </div>
                            <div class="infoRicettaDelGiorno">
                                <p> <img src="./img/difficoltà.png" alt="difficoltà">DIFFICOLTA' : <span style="color:red;">
                                        FACILE </span></p>
                                <p> <img src="./img/orologio.png" alt="orologio"> PRONTO IN : <span style="color:red;"> 4
                                        minuti </span> </p>
                                <p> <img src="./img/mangiare.png" alt="dosi"> DOSI PER : <span style="color:red;"> 4 persone
                                    </span> </p>
                            </div>
                        </div>

                        <div class="presentazioneRicettaDelGiorno">

                            <h3>Presentazione</h3>
                            <p>
                                Gli spaghetti aglio e olio sono un piatto simbolo della tradizione culinaria italiana,
                                semplice
                                ma ricco di sapore. Originari della Campania, ma amati in tutta Italia, questo piatto mette
                                in
                                evidenza l’arte di cucinare con pochi ingredienti di qualità. Il profumo avvolgente
                                dell’aglio,
                                il gusto ricco e aromatico dell’olio extravergine di oliva, e la piccantezza delicata del
                                peperoncino si combinano perfettamente per un’esperienza gustativa indimenticabile.

                                Questa ricetta, ideale per una cena veloce o un pranzo senza compromessi sul gusto, si
                                prepara
                                in pochi minuti e può essere personalizzata con aggiunta di prezzemolo fresco o una
                                spolverata
                                di formaggio grattugiato, se lo desideri. Facile da preparare ma incredibilmente saporito,
                                gli
                                spaghetti aglio e olio sono il comfort food per eccellenza.

                            </p>
                        </div>
                    </div>

                </div>
                <div class="mainColumn2">
                    <div class="contenutoMainColumn">
                        <h1>Le più cliccate</h1>
                        <div class="ricette">
                            <?php
                            $VettoreIdRicetteCliccate = generaNumeriCasualiDiversi();
                            for ($i = 0; $i < 4; $i++) {
                                $idRicettaCliccata = $VettoreIdRicetteCliccate[$i];
                                $nome = getNomeRicetta($idRicettaCliccata);
                                $descrizione = getDescrizioneRicetta($idRicettaCliccata);
                                $foto = getFotoRicetta($idRicettaCliccata);
                                ?>
                                <div class="ricetta<?php echo $idRicettaCliccata ?> " onclick="registerOrLogin()">
                                    <div class="infoRicetta">
                                        <div class="nomeRicetta">
                                            <span><?php
                                            echo $nome; ?></span>

                                        </div>
                                        <div class="descrizioneRicetta">
                                            <span><?php
                                            echo $descrizione; ?></span>
                                        </div>
                                    </div>
                                    <div class="containerFotoRicetta">
                                        <img src="<?php echo htmlspecialchars($foto); ?>"
                                            alt="ricetta<?php echo $idRicettaCliccata; ?>" class="fotoRicetta">
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
        }
        ?>

    </main>
    <footer>
        <div>
            <a href="">
                Privacy Policy
            </a>
            ●
            <a href="">
                Termini e condizioni
            </a>
            ●
            <a href="./index.php">
                Welcome
            </a>
            ● © 2025 Cooking
        </div>
    </footer>
</body>

</html>