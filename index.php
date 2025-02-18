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
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap">
</head>

<body>
    <header id="topIndex">
        <div id="headerIndex">
            <div class="logo">
                <img src="./img/icon.png">
            </div>

            <div class="title">
                <h1>Cooking</h1>
            </div>

            <?php if (isset($_SESSION['username'])) { ?>
                <div class="containerImmagine">
                    <a href="./account.php"> <img src="<?php echo getImage($_SESSION['username']) ?>" alt="Immagine Utente" class="loggato"> </a>
                </div>
            <?php } else { ?>
                <div>
                    <a href="./accesso.php"> <p class="nonLoggato">Accesso</p></a>
                 </div>
                <?php } ?>
        </div>
        <div id="animated-navbar">
            <div class="buttons-container">
                <a href="./home.php" class="nav-button">TUTTE LE RICETTE</a>
                <a href="./Relazione_Tecnologie_Web.pdf" class="nav-button">ABOUT</a>
            </div>
        </div>
    </header>
    

    <main id="mainIndex">

        <?php if (isset($_SESSION['username'])) {
            /* UTENTE LOGGATO */
            $username = $_SESSION['username']; ?>
            <div class="mainColumn1">
                <?php $idRicettaDelGiorno = generaIdCasuale(); ?>
                <div class="contenutoMainColumnRicettaDelGiorno"
                    onclick="vaiAllaRicetta(event,<?php echo $idRicettaDelGiorno; ?>)">
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
                            <p> <img src="./img/difficoltà.png" alt="difficoltà">Difficoltà : <span>
                                    <?php
                                    echo getDifficoltaRicetta($idRicettaDelGiorno); ?> </span></p>
                            <p> <img src="./img/orologio.png" alt="orologio"> Pronto in : <span> <?php
                            echo getTempoRicetta($idRicettaDelGiorno); ?>
                                </span> </p>
                            <p> <img src="./img/mangiare.png" alt="dosi"> Dosi per : <span> <?php
                            echo getDosiRicetta($idRicettaDelGiorno); ?>
                                </span> </p>
                        </div>
                    </div>

                    <div class="presentazioneRicettaDelGiorno">

                        <h2>Presentazione</h2>
                        <p>
                            <?php
                            echo getPresentazioneRicetta($idRicettaDelGiorno); ?>
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
                                if ($counter >= 4)
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
                                $counter++;
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
                    <div class="goHome">
                        <a href="./home.php">Vai a tutte le ricette ▶</a>
                </div>
                </div>
            </div>
                <?php
            /* UTENTE NON LOGGATO */
        } else { ?>
                <div class="mainColumn1">
                <?php $idRicettaDelGiorno = generaIdCasuale(); ?>
                    <div class="contenutoMainColumnRicettaDelGiorno" onclick="registerOrLogin(event,<?php echo $idRicettaDelGiorno?>)">
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
                            <p> <img src="./img/difficoltà.png" alt="difficoltà">Difficoltà : <span>
                                    <?php
                                    echo getDifficoltaRicetta($idRicettaDelGiorno); ?> </span></p>
                            <p> <img src="./img/orologio.png" alt="orologio"> Pronto in : <span> <?php
                            echo getTempoRicetta($idRicettaDelGiorno); ?>
                                </span> </p>
                            <p> <img src="./img/mangiare.png" alt="dosi"> Dosi per : <span> <?php
                            echo getDosiRicetta($idRicettaDelGiorno); ?>
                                </span> </p>
                        </div>
                        </div>
                    </div>

                    <div class="presentazioneRicettaDelGiorno">

                        <h2>Presentazione</h2>
                        <p>
                            <?php
                            echo getPresentazioneRicetta($idRicettaDelGiorno); ?>
                        </p>
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
                            <div class="ricetta<?php echo $idRicettaCliccata ?> " onclick="registerOrLogin(event,<?php echo $idRicettaDelGiorno?>)">
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