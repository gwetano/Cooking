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

    <header>
        <div class="logo">
            <a href="./index.php"><img src="./img/icon.png" height="50px" width="50px"></a>
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
            <a href="./home.php"> <img src="./img/home.png" height="50px" width="50px"></a>
        </div>
    </header>

    <main id="mainRicetta">
        <div class="mainColumnSX">
            <div class="primaRiga">
                <div class="fotoRicetta">
                    <img src=<?php
                    echo getFotoRicetta($id) ?> alt="" class="foto" height="50px" width="50px">
                </div>
            </div>
            <div class="secondaRiga">
                <div class="difficoltà">
                    <p>Difficoltà : <span class="difficoltàText"> Facile </span></p>
                </div>
                <div class="tempo">
                    <p>Pronto in : <span class="tempoText"> 15 min </span></p>
                </div>
                <div class="dosi">
                    <p>Dosi per : <span class="dosiText"> 4 </span></p>
                </div>
            </div>
        </div>

        <div class="mainColumnDX">
            <div class="descrizione">

            </div>
            <div class="Ingredienti">
                <p>Ingredienti : <br><?php echo getIngredientiRicetta($id) ?></p>
            </div>
            <div class="preparazione">
                <h2>
                    <b>Preparazione</b>
                </h2>
                <?php
                echo getPreparazioneRicetta($id) ?></p>
            </div>
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
            <a href="./index.php">
                Welcome
            </a>

            <a href="#">
                ● © 2025 Cooking
            </a>
        </p>
    </footer>
</body>

</html>