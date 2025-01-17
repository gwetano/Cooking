<?php
session_start();
require './db.php';

if (!isset($_SESSION['autenticato'])) {
    echo "<script>
                alert('Accesso non autorizzato. Sarai reindirizzato alla pagina di login.');
                window.location.href = 'accesso.php'; // Cambia con il percorso della tua pagina di login
              </script>";
    exit;
} else
    $username = $_SESSION['username'];
    $id = $_GET['id'];
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

function getIngredientiRicetta($id)
{
    global $db;
    $sql = "SELECT ingredienti FROM ricette WHERE id=$1";
    $result = pg_query_params($db, $sql, array($id));
    if ($result && pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        return $row['ingredienti'];
    }
    return null;
}

function getPreparazioneRicetta($id)
{
    global $db;
    $sql = "SELECT preparazione FROM ricette WHERE id=$1";
    $result = pg_query_params($db, $sql, array($id));
    if ($result && pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        return $row['preparazione'];
    }
    return null;
}

?>
<html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="./img/icon.png">
    <link rel="stylesheet" href="account1.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <title>Area Riservata</title>
</head>

<body>

    <header>
        <div class="titleRicetta">
            <h1>
                <?php
                echo getNomeRicetta($id) ?>
            </h1>
        </div>
        <div>
            <a href="./home.php" class="returnHome"> Home</a>
        </div>

        <div>
            <h2>
                <?php
                echo getDescrizioneRicetta($id) ?>
            </h2>
        </div>
    </header>

    <main>
        <div>
            <p><?php
            echo getIngredientiRicetta($id) ?></p>
        </div>
        <div>
            <img src=<?php
            echo getFotoRicetta($id) ?> alt="" height="50px" width="50px">
        </div>
        <div>
            <?php
            echo getPreparazioneRicetta($id) ?></p>

        </div>
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
            <a href="./index.html">
                Welcome
            </a>

            <a href="#">
                ● © 2025 Cooking
            </a>
        </p>
    </footer>
</body>

</html>