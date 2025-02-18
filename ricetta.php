<?php
session_start();
require './db.php';
require_once './funzioni.php';
if (!isset($_SESSION['username'])) {
    echo "<script>
                alert('Accesso non autorizzato. Sarai reindirizzato alla pagina di login.');
                window.location.href = 'accesso.php'; 
              </script>";
    exit;
} else {
    $username = $_SESSION['username'];
    $id = $_GET['id'];
}
?>
<html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style.css">
    <title>Ricetta</title>
    <script defer src="./funzioni.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="./img/icon.png">
    <link
        href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap">

</head>

<body>

    <header id="headerRicetta">
        <div class="logo">
            <img src="./img/icon.png" onclick="vaiAIndex(event)"></a>
        </div>

        <div class="title" id="titleRicetta">
            <h1> <?php echo getNomeRicetta($id) ?></h1>
            <div class="star">
                <?php
                $isPrefertito = isPrefertito($username, $id);
                $imgPath = $isPrefertito ? "./img/preferiti.png" : "./img/nonPreferiti.png";
                $toggle = $isPrefertito ? 'true' : 'false';
                ?>
                <img src="<?php echo $imgPath; ?>" alt="Immagine Preferiti"
                    onclick="toggleFavorite(event, <?php echo $id; ?>, <?php echo $toggle; ?>)"
                    id="addPreferiti<?php echo $id ?>" class="starImmagine">
            </div>
        </div>

        <div class="loggato">
            <a href="./home.php"> <img src="./img/home.png"></a>
        </div>
    </header>

    <main id="mainRicetta">
        <div class="mainColumn">
            <div class="mainColumnSX">
                <img src=<?php
                echo getFotoRicetta($id) ?> alt="" class="<?php
                   echo getFotoRicetta($id) ?>">
            </div>

            <div class="mainColumnDX">
                <div class="infoRicettaSingola">
                    <p> <img src="./img/difficoltà.png" alt="difficoltà">Difficoltà : <span>
                            <?php
                            echo getDifficoltaRicetta($id); ?> </span></p>
                    <p> <img src="./img/orologio.png" alt="orologio"> Pronto in : <span> <?php
                    echo getTempoRicetta($id); ?>
                        </span> </p>
                    <p> <img src="./img/mangiare.png" alt="dosi"> Dosi per : <span> <?php
                    echo getDosiRicetta($id); ?>
                        </span> </p>
                </div>
                <hr>
                <div class="Ingredienti">
                    <p>Ingredienti </p>
                    <?php echo getIngredientiRicetta($id) ?>
                </div>
            </div>
        </div>
        <div class="presentazione">
            <h1>
                Presentazione
            </h1>
            <p>
                <?php
                echo getPresentazioneRicetta($id) ?>
            </p>
        </div>

        <div class="preparazione">
            <h1>
                <b>Preparazione</b>
            </h1>
            <p><?php
            echo getPreparazioneRicetta($id) ?></p>

        </div>

    </main>

    <footer>
        <div>
            <a href="mailto:miaomiaodevelopers@email.com">
                Mail to
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