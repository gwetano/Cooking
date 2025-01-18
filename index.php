<?php
session_start();
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
    <link rel="stylesheet" href="StyleRicette3.css">
</head>

<body>
    <header>
        <div class="logo">
            <img src="./img/icon.png" height="50px" width="50px">
        </div>

        <div class="title">
            <h1>Cooking</h1>
        </div>

        <div class="account">
            <a href="./accesso.php"> Accesso</a>
        </div>

    </header>

    <main>
        <?php if (!isset($_SESSION['autenticato'])) { ?>
            <div>
                <h2>
                    <p>Le tue ricette preferite</p>
                </h2>
            </div>
            <div>
                <p>Le più cliccate</p>
            </div>
        <?php
        } else { ?>
            <div>
                <h2>
                    <p>Ricetta del giorno</p>
                    <p>Descrizione della ricetta</p>
                    <p>
                        <img src="./img/pentola.png" alt="" height="80px" width="80px">
                    </p>
                </h2>
            </div>
            <div>
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
            <a href="./index.html">
                Welcome
            </a>
            ● © 2025 Cooking
        </p>
    </footer>
</body>

</html>