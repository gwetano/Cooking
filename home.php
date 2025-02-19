<?php
session_start();
require './db.php';
require_once './funzioni.php';

if (!isset($_SESSION['username'])) { 
    echo "<script>
        window.location.href = 'accesso.php';
    </script>";
} else {
    $username = $_SESSION['username'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    $action = $_POST['action'] ?? '';
    $id = $_POST['id'] ?? '';

    if (!$id) {
        echo json_encode(['error' => 'ID non valido']);
        exit;
    }

    if ($action === 'add') {
        $result = addRicettePreferite($username,$id);
    } elseif ($action === 'remove') {
        $result = removeRicettePreferite($username,$id);
    } else {
        echo json_encode(['error' => 'Azione non valida']);
        exit;
    }

    echo json_encode(['success' => $result ? true : false, 'error' => $result ? null : pg_last_error($db)]);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style.css">
    <title>Home</title>
    <script defer src="./funzioni.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="./img/icon.ico">
    <link
        href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap">
</head>

<body>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const searchInput = document.getElementById('searchInput'); 
            const recipes = document.querySelectorAll('[class^="mainRow"]'); 

            searchInput.addEventListener('input', function () {
                const query = searchInput.value.toLowerCase(); 

                recipes.forEach(recipe => {
                    const keywords = recipe.getAttribute('data-keywords')?.toLowerCase(); 
                    if (!query || (keywords && keywords.includes(query))) {
                        recipe.style.display = 'block';
                    } else {
                        recipe.style.display = 'none';
                    }
                });
            });
        });
    </script>
    
    <header id="headerHome">
        <div class="logo">
            <img src="./img/icon.png" onclick="vaiAIndex(event)">
        </div>

        <div class="search-form">
            <input id="searchInput" type="text" name="query" placeholder="Cerca una ricetta" class="search-input">
        </div>

        <div class="containerImmagine">
            <a href="./account.php"> <img src="<?php echo getImage($username) ?>" alt="Immagine Utente" class="loggato">
            </a>
        </div>
    </header>

    <main id="mainHome">
        <?php
        $idRicette = getIdRicette();
        if (!empty($idRicette)) { ?>
            <div class="allRicette">
                <?php
                foreach ($idRicette as $id) {
                    $nome = getNomeRicetta($id);
                    $descrizione = getDescrizioneRicetta($id);
                    $foto = getFotoRicetta($id);
                    $dataKeywords = getDataKeywords($id);
                    ?>
                    <div class="mainRow<?php echo $id ?>" data-keywords="<?php echo $dataKeywords ?>"
                        onclick="vaiAllaRicetta(event,<?php echo $id; ?>)">
                        <div class="ricetta">
                            <div class="nomeRicetta">
                                <?php
                                echo $nome; ?>
                            </div>
                            <div class="descrizioneRicetta">
                                <?php
                                echo $descrizione; ?>
                            </div>
                        </div>
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
                        <div class="classFotoRicetta">
                            <img src="<?php echo htmlspecialchars($foto); ?>" alt="ricetta<?php echo $id ?>" height="100%">
                        </div>

                    </div>

                    <?php
                }
        } ?>
        </div>
    </main>

    <footer>
        <div>
            <a href="mailto:miaomiaodevelopers@email.com">
            Contact Us
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