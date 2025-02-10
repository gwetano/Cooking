<?php
session_start();
require './db.php';

if (!isset($_SESSION['username'])) {
    echo "<script>
            alert('Accesso non autorizzato. Sarai reindirizzato alla pagina di login.');
            window.location.href = 'accesso.php'; // Cambia con il percorso della tua pagina di login
          </script>";
    exit;
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

function isPrefertito($username, $id)
{
    global $db;
    $sql = "SELECT id FROM preferiti WHERE username=$1 AND id=$2";
    $result = pg_query_params($db, $sql, array($username, $id));
    return $result && pg_num_rows($result) > 0;
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

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="./img/icon.png">
    <link rel="stylesheet" href="StyleRicette.css">
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
    <header>
        <div class="logo">
        <a href="./index.php"><img src="./img/icon.png" height="50px" width="50px"></a>
        </div>

        <div class="title">
            <h1>Cooking</h1>
        </div>


        <div class="search-form">
            <input id="searchInput" type="text" name="query" placeholder="Cerca una ricetta" class="search-input">
        </div>

        <div class="account">
            <a href="./account.php"> <img src="./img/username.png" height="40px" width="40px"></a>
        </div>
    </header>
    <main>
        <div class=mainRow1 data-keywords="spaghetti,aglio,olio,vegetariano" onclick="vaiAllaRicetta(1)">
            <div class="text">
                <div class="preview">
                    <h2>
                        Spaghetti Aglio e Olio
                    </h2>
                    <p>
                        Un classico italiano, semplice e veloce: aglio, olio d'oliva e un pizzico di peperoncino.
                        <div class="star">
                        <?php
                            $isPrefertito = isPrefertito($username, 1);
                            $imgPath = $isPrefertito ? "./img/preferiti.png" : "./img/nonPreferiti.png";
                            $toggle = $isPrefertito ? 'true' : 'false';
                            ?>
                            <img src="<?php echo $imgPath; ?>"
                                alt="Immagine Preferiti"
                                onclick="toggleFavorite(event, 1, <?php echo $toggle; ?>)"
                                id="addPreferiti1">

                        </div>
                    </p>
                </div>
                <img src=<?php echo getFotoRicetta(1) ?>  alt="" class="immagineRicetta">
            </div>
        </div>

        <div class=mainRow2 data-keywords="tacos,pollo" onclick="vaiAllaRicetta(2)">
            <div class="text">
                <div class="preview">
                    <h2>
                        Tacos di Pollo
                    </h2>
                    <p>
                        Tortillas croccanti ripiene di pollo speziato, guacamole e salsa fresca.
                    </p>
                </div>
                <img src=<?php
                            echo getFotoRicetta(2) ?>  alt="" class="immagineRicetta">
            </div>
        </div>

        <div class=mainRow3 data-keywords="zuppa,lenticchie,vegetariano" onclick="vaiAllaRicetta(3)">
            <div class="text">
                <div class="preview">
                    <h2>
                        Zuppa di Lenticchie
                    </h2>
                    <p>
                        Una calda e confortante zuppa con lenticchie, verdure e un tocco di rosmarino.
                    </p>
                </div>
                <img src=<?php
                            echo getFotoRicetta(3) ?>  alt="" class="immagineRicetta">
            </div>
        </div>

        <div class=mainRow4 data-keywords="pancakes,cioccolato" onclick="vaiAllaRicetta(4)">
            <div class="text">
                <div class="preview">
                    <h2>
                        Pancakes al Cioccolato
                    </h2>
                    <p>
                        Soffici e golosi, con cacao nell’impasto e una cascata di sciroppo di cioccolato.
                    </p>
                </div>
                <img src=<?php
                            echo getFotoRicetta(4) ?>  alt="" class="immagineRicetta">
            </div>
        </div>

        <div class=mainRow5 data-keywords="polpette,melanzane,vegetariano" onclick="vaiAllaRicetta(5)">
            <div class="text">
                <div class="preview">
                    <h2>
                        Polpette di Melanzane
                    </h2>
                    <p>
                        Deliziose polpettine vegetariane, croccanti fuori e morbide dentro.
                    </p>
                </div>
                <img src=<?php
                            echo getFotoRicetta(5) ?>  alt="" class="immagineRicetta">
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
            ● © 2025 Cooking
        </p>
    </footer>
</body>

</html>

<script>
    function vaiAllaRicetta(id) {
        // Cambia la pagina in base all'ID della ricetta
        window.location.href = 'ricetta.php?id=' + id;
    }

    function toggleFavorite(event, id, isFavorite) {
    event.stopPropagation();  // Previene il click sulla ricetta
    const star = document.getElementById('addPreferiti' + id);
    
    fetch('home.php', { 
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({
        id: id,
        action: isFavorite ? 'remove' : 'add'
    })
})
.then(response => {
    // Controlla se la risposta è ok
    if (!response.ok) {
        throw new Error('Network response was not ok');
    }
    return response.json(); // Parso sempre come JSON
})
.then(data => {
    if (data.success) {
        star.src = isFavorite ? './img/nonPreferiti.png' : './img/preferiti.png';
        star.setAttribute('onclick', `toggleFavorite(event, ${id}, ${!isFavorite})`);
    } else {
        alert('Errore durante l’operazione: ' + data.error);
    }
})
.catch(error => {
    console.error('Errore:', error);
    alert('Errore durante l’operazione!');
});
}

</script>