<?php
session_start();
require './db.php';
require_once './funzioni.php';

if (!isset($_SESSION['username'])) { ?>
    <script>
        window.location.href = 'accesso.php';
    </script>
    <?php
} else {
    $username = $_SESSION['username'];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type:application/json'); // Imposta l'intestazione per JSON
    $data = json_decode(file_get_contents('php://input'), true);
    $action = $data['action'] ?? '';
    $id = $data['id'] ?? '';

    if (!$id) {
        $response['error'] = 'ID non valido';
        echo json_encode($response);
        exit;
    }

    if ($action === 'add') {
        $sql = "INSERT INTO preferiti (username, id) VALUES ($1, $2)";
        $result = pg_query_params($db, $sql, array($username, $id));
    } elseif ($action === 'remove') {
        $sql = "DELETE FROM preferiti WHERE username = $1 AND id = $2";
        $result = pg_query_params($db, $sql, array($username, $id));
    } else {
        $response['error'] = 'Azione non valida';
        echo json_encode($response);
        exit;
    }

    if ($result) {
        $response['success'] = true;
    } else {
        $response['error'] = pg_last_error($db);
    }

    echo json_encode($response);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="./img/icon.png">
    <link rel="stylesheet" href="Style.css">
    <title>Home</title>
    <script defer src="./funzioni.js"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
</head>

<body>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const searchInput = document.getElementById('searchInput'); // Campo di input
            const recipes = document.querySelectorAll('[class^="mainRow"]'); // Seleziona tutte le ricette

            searchInput.addEventListener('input', function () {
                const query = searchInput.value.toLowerCase(); // Ottiene il valore della ricerca in minuscolo

                recipes.forEach(recipe => {
                    const keywords = recipe.getAttribute('data-keywords')?.toLowerCase(); // Ottiene le parole chiave della ricetta
                    if (!query || (keywords && keywords.includes(query))) {
                        // Mostra la ricetta se il campo è vuoto o corrisponde alla ricerca
                        recipe.style.display = 'block';
                    } else {
                        // Nasconde la ricetta se non corrisponde
                        recipe.style.display = 'none';
                    }
                });
            });
        });
    </script>

        <div id="headerHome">
            <div class="logo">
                <img src="./img/icon.png" onclick="vaiAIndex(event)">
            </div>

            <div class="search-form">
                <input id="searchInput" type="text" name="query" placeholder="Cerca una ricetta" class="search-input">
            </div>

            <div class="containerImmagine">
            <a href="./account.php"> <img src="<?php echo getImage($username) ?>" alt="Immagine Utente" class="loggato"> </a>
        </div>
        </div>

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