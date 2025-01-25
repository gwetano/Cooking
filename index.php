<?php
session_start();
require './db.php';
function getNomeRicetta($id)
{
    global $db;
    $sql = "SELECT nome FROM ricette WHERE id=$1";
    $result = pg_query_params($db, $sql, array($id));
    if ($result && pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        return $row['nome'];
    }
    return null;
}

function getDescrizioneRicetta($id)
{
    global $db;
    $sql = "SELECT descrizione FROM ricette WHERE id=$1";
    $result = pg_query_params($db, $sql, array($id));
    if ($result && pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        return $row['descrizione'];
    }
    return null;
}

function getFotoRicetta($id)
{
    global $db;
    $sql = "SELECT foto FROM ricette WHERE id=$1";
    $result = pg_query_params($db, $sql, array($id));
    if ($result && pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        return $row['foto'];
    }
    return null;
}

function getRicettePreferite($username)
{
    global $db;
    $sql = "SELECT id FROM preferiti WHERE username=$1";
    $result = pg_query_params($db, $sql, array($username));
    if ($result && pg_num_rows($result) > 0) {
        $ids = [];
        while ($row = pg_fetch_assoc($result)) {
            $ids[] = $row['id'];
        }
        return $ids;
    }
    return [];
}

function addRicettePreferite($username,$id) {
    global $db;
    $sql = "INSERT INTO preferiti(username, id) VALUES($1, $2";
    $result = pg_query_params($db, $sql, array($username, $id));
    return $result !== false;
}

function removeRicettePreferite($username, $id) {
    global $db;
    $sql = "DELETE FROM preferiti WHERE id = $1 AND username = $2";
    $result = pg_query_params($db, $sql, array($id, $username));
    return $result !== false;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>HOME</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="./img/icon.png">
    <link
        href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap">
    <link rel="stylesheet" href="index.css">
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
            <div class="account">
                <a href="./account.php"> Account</a>
            </div>
        <?php } else { ?>
            <div class="account">
                <a href="./accesso.php"> Accesso</a>
            </div>
        <?php } ?>
    </header>

    <main>
        <?php if (isset($_SESSION['username'])) {
            $username = $_SESSION['username']; ?>
            <div class="mainColumn1">
                <h2>
                    <p>Le tue ricette preferite</p>
                    <div>
                        <?php
                        $ricettePreferite = getRicettePreferite($username);
                        if (!empty($ricettePreferite)) {
                            foreach ($ricettePreferite as $id) {
                                $nome = getNomeRicetta($id);
                                $descrizione = getDescrizioneRicetta($id);
                                $foto = getFotoRicetta($id);
                                ?>
                                <div class="ricetta">
                                    <div class="nomeRicetta">
                                        <?php
                                        echo getNomeRicetta($id); ?>
                                    </div>
                                    <div class="descrizioneRicetta">
                                        <?php
                                        echo getDescrizioneRicetta($id) ?>
                                    </div>

                                    <div class="FotoRicetta">
                                        <img src="<?php echo getFotoRicetta($id); ?>" alt="" height="50px" width="50px">
                                    </div>
                                </div>
                                <?php
                            }
                        } else {
                            echo "Non ci sono ricette preferite per l'utente.";
                        }
                        ?>
                    </div>
                </h2>
            </div>
            <div class="mainColumn2">
                <div>
                    <p>Le più cliccate</p>

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
                            echo getFotoRicetta(1) ?> alt="" height="50px" width="50px">
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
                            echo getFotoRicetta(2) ?> alt="" height="50px" width="50px">
                        </div>
                    </div>

                    <div class="ricetta3">
                        <div class="nomeRicetta">
                            <?php
                            echo getNomeRicetta(3); ?>
                        </div>
                        <div class="classFotoRicetta">
                            <?php
                            echo getDescrizioneRicetta(3) ?>
                        </div>

                        <div classFotoRicetta>
                            <img src=<?php
                            echo getFotoRicetta(3) ?> alt="" height="50px" width="50px">
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
                            echo getFotoRicetta(4) ?> alt="" height="50px" width="50px">
                        </div>
                    </div>
                    <div>
                        <a href="./home.php">tutte le ricette</a>
                    </div>
                </div>
                <?php

        } else { ?>
                <div class="mainColumn1">
                    <h2>
                        <p>Ricetta del giorno</p>
                        <p>Descrizione della ricetta</p>
                        <p>
                            <img src="./img/pentola.png" alt="" height="80px" width="80px">
                        </p>
                    </h2>
                </div>
                <div class="mainColumn2">
                    <p>
                        <img src="" alt="">
                    </p>
                    <p>
                        <img src="" alt="">
                    </p>
                    <p>
                        <img src="" alt="">
                    </p>
                    <p>
                        <img src="" alt="">
                    </p>
                    <div>
                        <a href="./home.php">tutte le ricette</a>
                    </div>
                </div>
                <?php
        }
        ?>

    </main>
    <footer>
        <p>
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
        </p>
    </footer>
</body>

</html>