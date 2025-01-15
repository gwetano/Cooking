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


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_GET['action'] ?? '';
    if ($action === 'cambiaPassword') {
        header('Content-Type: application/json');
        $password = $_POST['oldPassword'] ?? '';
        $newPassword = $_POST['newPassword'] ?? '';
        $confermaNewPassword = $_POST['confermaNewPassword'] ?? '';

        $hash = get_pwd($username, $db);
        if (password_verify($password, $hash)) {
            if ($newPassword !== $confermaNewPassword) {
                echo json_encode(['success' => false, 'message' => 'Le password non corrispondono.']);
            }
            elseif($newPassword == $password) {
                echo json_encode(['success' => false, 'message' => 'Nessun cambiamento, vecchia password e nuova password corrispondono']);
            }
            else {
                changePassword($username, $newPassword);
                echo json_encode(['success' => true, 'message' => "Password modificate con successo"]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Password errata']);
        }
        exit();
    }
    echo json_encode(['success' => false, 'message' => 'Azione non valida.']);
    exit();
}

//FUNZIONI -------
function get_pwd($username)
{
    global $db;
    $sql = "SELECT password FROM utente WHERE username=$1";
    $result = pg_query_params($db, $sql, array($username));
    if ($result && pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        return $row['password'];
    }
    return null;
}

function get_Nome($username)
{
    global $db;
    $sql = "SELECT nome FROM utente WHERE username=$1";
    $result = pg_query_params($db, $sql, array($username));
    if ($result && pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        return $row['nome'];
    }
    return null;
}

function get_Cognome($username)
{
    global $db;
    $sql = "SELECT cognome FROM utente WHERE username=$1";
    $result = pg_query_params($db, $sql, array($username));
    if ($result && pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        return $row['cognome'];
    }
    return null;
}

function changePassword($username, $newpassword)
{
    global $db;
    $Newhash = password_hash($newpassword, PASSWORD_DEFAULT);
    $sql = "UPDATE utente SET password = $1 WHERE username = $2";
    $result = pg_query_params($db, $sql, array($Newhash,$username));
    return $result !== false;
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
    <link rel="stylesheet" href="account.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <title>Area Riservata</title>
</head>

<body>
    <header>
        <div>
            <h1>
                Area utente
            </h1>
        </div>
    </header>

    <main>
        <p>Dati anagrafici</p>
        <p>
            Nome : <?php echo get_Nome($username) ?>
        </p>

        <p>
            Cognome :<?php echo get_Cognome($username) ?>
        </p>
        <p> Dati di Accesso </p>
        <p>
            Username : <?php echo $username ?>
        </p>

        <p>Vuoi aggiornare la password ? <a id="mostraBanner" href="#">Clicca qui</a></p>

        <form id="CambiaPasswordForm" method="post">
            <div id="banner">
                <div banner-content>
                    <p>
                        Vecchia Password : <input type="password" name="oldPassword" required>
                    </p>
                    <p>
                        Nuova Password : <input type="password" name="newPassword" required>
                    </p>

                    <p>
                        Conferma Password : <input type="password" name="confermaNewPassword" required>
                    </p>
                    <button class="bottoneConferma">
                        Conferma
                    </button>
                    <button class="bottoneConferma" id="nascondiBanner">
                        Annulla
                    </button>
                </div>
            </div>
        </form>
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

</html>

<script>
    document.getElementById('mostraBanner').addEventListener('click', function (event) {
        event.preventDefault();
        const banner = document.getElementById('banner').style.display = 'flex';
    });
    document.getElementById('nascondiBanner').addEventListener('click', function (event) {
        event.preventDefault();
        const banner = document.getElementById('banner').style.display = 'none';
    });

    document.getElementById('CambiaPasswordForm').addEventListener('submit', function (event) {
        event.preventDefault();
        const formData = new FormData(this);
        fetch('?action=cambiaPassword', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = 'account.php';
                    alert(data.message);
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Errore:', error));
    });
</script>