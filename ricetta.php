<?php
session_start();
require './db.php';

if (!isset($_SESSION['username'])) {
    echo "<script>
                alert('Accesso non autorizzato. Sarai reindirizzato alla pagina di login.');
                window.location.href = 'accesso.php'; 
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

function isPrefertito($username, $id)
{
    global $db;
    $sql = "SELECT id FROM preferiti WHERE username=$1 AND id=$2";
    $result = pg_query_params($db, $sql, array($username, $id));
    return $result && pg_num_rows($result) > 0;
}

?>
<html>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style.css">
    <title>RICETTA</title>

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

        <div class="title">
            <h1> <?php echo getNomeRicetta($id) ?></h1>
        </div>
        <div class="loggato">
            <a href="./home.php"> <img src="./img/home.png" height="50px" width="50px"></a>
        </div>
    </header>

    <main id="mainRicetta">
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
        <div class="introduzione">
            <div class="fotoRicetta">
                <img src=<?php
                echo getFotoRicetta($id) ?> alt="" class="foto">
            </div>
            <div class="descrizioneGenerale">

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
            <div class="Ingredienti">
                <p>Ingredienti : <br><?php echo getIngredientiRicetta($id) ?></p>
            </div>
        </div>
        <div class="Preparazione">
            <h2>
                <b>Preparazione</b>
            </h2>
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

<script>
    function toggleFavorite(event, id, isFavorite) {
        event.stopPropagation();  // Previene il click sulla ricetta
        const star = document.getElementById('addPreferiti' + id);

        // Inverti il valore di isFavorite
        const action = isFavorite ? 'remove' : 'add';
        const newIsFavorite = !isFavorite;  // Nuovo stato di isFavorite

        fetch('home.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                id: id,
                action: action
            })
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json(); // Parso sempre come JSON
            })
            .then(data => {
                if (data.success) {
                    star.src = newIsFavorite ? './img/preferiti.png' : './img/nonPreferiti.png';
                    star.setAttribute('onclick', `toggleFavorite(event, ${id}, ${newIsFavorite})`);
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