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
            <img src="./img/icon.png" height="50px" width="50px">
        </div>

        <div class="title">
            <h1>Cooking</h1>
        </div>
        <?php if (isset($_SESSION['username'])) { ?>
            <div class="loggato">
                <a href="./account.php"> <img src="./img/username.png" height="50px" width="50px"></a>
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
                <div class="contenutoMainColumn">
                    <h1>Le tue ricette preferite</h1>
                    <?php
                    $ricettePreferite = getRicettePreferite($username);
                    if (!empty($ricettePreferite)) { ?>
                        <div class="ricette">
                            <?php
                            foreach ($ricettePreferite as $id) {
                                $nome = getNomeRicetta($id);
                                $descrizione = getDescrizioneRicetta($id);
                                $foto = getFotoRicetta($id);
                                ?>
                                <div class="ricetta<?php echo $id ?>" onclick="vaiAllaRicetta(event, <?php echo $id; ?>)">
                                    <div class="nomeRicetta">
                                        <?php
                                        echo $nome; ?>
                                    </div>
                                    <div class="descrizioneRicetta">
                                        <?php
                                        echo $descrizione; ?>
                                    </div>
                                    <div class="classFotoRicetta">
                                        <img src="<?php echo htmlspecialchars($foto); ?>" alt="ricetta<?php echo $id; ?>"
                                            height="100%">
                                    </div>
                                </div>

                                <?php
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
            </div>
            
            <div class="mainColumn2">
                <div class="contenutoMainColumn">
                    <h1>Le più cliccate</h1>
                    <div class="ricette">
                        <div class="ricetta1" onclick="vaiAllaRicetta(event,1)">
                            <div class="nomeRicetta">
                                <?php
                                echo getNomeRicetta(1); ?>
                            </div>
                            <div class="descrizioneRicetta">
                                <?php
                                echo getDescrizioneRicetta(1) ?>
                            </div>
                            <div class="classFotoRicetta">
                                <img src=<?php
                                echo getFotoRicetta(1) ?> alt="ricetta1" height="100%">
                            </div>
                        </div>

                        <div class="ricetta2" onclick="vaiAllaRicetta(event,2)">
                            <div class="nomeRicetta">
                                <?php
                                echo getNomeRicetta(2); ?>
                            </div>
                            <div class="descrizioneRicetta">
                                <?php
                                echo getDescrizioneRicetta(2) ?>
                            </div>
                            <div class="classFotoRicetta">
                                <img src=<?php
                                echo getFotoRicetta(2) ?> alt="ricetta2" height="100%">
                            </div>
                        </div>

                        <div class="ricetta3" onclick="vaiAllaRicetta(event,3)">
                            <div class="nomeRicetta">
                                <?php
                                echo getNomeRicetta(3); ?>
                            </div>
                            <div class="descrizioneRicetta">
                                <?php
                                echo getDescrizioneRicetta(3) ?>
                            </div>
                            <div class="classFotoRicetta">
                                <img src=<?php
                                echo getFotoRicetta(3) ?> alt="ricetta3" height="100%">
                            </div>
                        </div>

                        <div class="ricetta4" onclick="vaiAllaRicetta(event,4)">
                            <div class="nomeRicetta">
                                <?php
                                echo getNomeRicetta(4); ?>
                            </div>
                            <div class="descrizioneRicetta">
                                <?php
                                echo getDescrizioneRicetta(4) ?>
                            </div>
                            <div class="classFotoRicetta">
                                <img src=<?php
                                echo getFotoRicetta(4) ?> alt="ricetta4" height="100%">
                            </div>
                        </div>
                    </div>
                    <div class="goHome">
                        <a href="./home.php">Vai a tutte le ricette ▶</a>
                    </div>
                </div>
            </div>
            <?php
/* UTENTE NON LOGGATO */
        } else { ?>
            <div class="mainColumn1">
                <div class="contenutoMainColumn">  
                    <h1>Ricetta del giorno</h1>
                    <div class="ricette" id="ricettaDelGiorno">
                        <div class="ricetta1">
                            <div class="nomeRicetta">
                                <?php
                                echo getNomeRicetta(1); ?>
                            </div>
                            <div class="descrizioneRicetta">
                                <?php
                                echo getDescrizioneRicetta(1) ?>
                            </div>
                            <div class="classFotoRicetta">
                                <img src=<?php
                                echo getFotoRicetta(1) ?> alt="ricetta1" height="100%">
                            </div>
                        </div>
                    </div>
            </div>

            </div>
            <div class="mainColumn2">
                <div class="contenutoMainColumn">
                <h1>Le più cliccate</h1>
                <div class="ricette">
                    <div class="ricetta1">
                        <div class="nomeRicetta">
                            <?php
                            echo getNomeRicetta(1); ?>
                        </div>
                        <div class="descrizioneRicetta">
                            <?php
                            echo getDescrizioneRicetta(1) ?>
                        </div>
                        <div class="classFotoRicetta">
                            <img src=<?php
                            echo getFotoRicetta(1) ?> alt="ricetta1" height="100%">
                        </div>
                    </div>

                    <div class="ricetta2">
                        <div class="nomeRicetta">
                            <?php
                            echo getNomeRicetta(2); ?>
                        </div>
                        <div class="descrizioneRicetta">
                            <?php
                            echo getDescrizioneRicetta(2) ?>
                        </div>
                        <div class="classFotoRicetta">
                            <img src=<?php
                            echo getFotoRicetta(2) ?> alt="ricetta2" height="100%">
                        </div>
                    </div>

                    <div class="ricetta3">
                        <div class="nomeRicetta">
                            <?php
                            echo getNomeRicetta(3); ?>
                        </div>
                        <div class="descrizioneRicetta">
                            <?php
                            echo getDescrizioneRicetta(3) ?>
                        </div>
                        <div class="classFotoRicetta">
                            <img src=<?php
                            echo getFotoRicetta(3) ?> alt="ricetta3" height="100%">
                        </div>
                    </div>

                    <div class="ricetta4">
                        <div class="nomeRicetta">
                            <?php
                            echo getNomeRicetta(4); ?>
                        </div>
                        <div class="descrizioneRicetta">
                            <?php
                            echo getDescrizioneRicetta(4) ?>
                        </div>
                        <div class="classFotoRicetta">
                            <img src=<?php
                            echo getFotoRicetta(4) ?> alt="ricetta4" height="100%">
                        </div>
                    </div>
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
                Cookie Policy
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

<script>

    document.addEventListener('DOMContentLoaded', function () {
    const ricette = document.querySelectorAll('.ricetta1, .ricetta2, .ricetta3, .ricetta4');
    const isLoggedIn = <?php echo isset($_SESSION['username']) ? 'true' : 'false'; ?>;

    ricette.forEach(ricetta => {
        if (isLoggedIn) {
            ricetta.classList.add('cursor-pointer');
            ricetta.classList.remove('cursor-not-allowed');
        } else {
            ricetta.classList.add('cursor-not-allowed');
            ricetta.classList.remove('cursor-pointer');
        }
    });
    });
    
</script>