<?php
session_start();
require './db.php';

if (!isset($_SESSION['username'])) {
    echo "<script>
                alert('Accesso non autorizzato. Sarai reindirizzato alla pagina di login.');
                window.location.href = 'accesso.php'; // Cambia con il percorso della tua pagina di login
              </script>";
    exit;
} else
    $username = $_SESSION['username'];

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: accesso.php");
    exit;
}

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
            } elseif ($newPassword == $password) {
                echo json_encode(['success' => false, 'message' => 'Nessun cambiamento, vecchia password e nuova password corrispondono']);
            } else {
                changePassword($username, $newPassword);
                echo json_encode(['success' => true, 'message' => "Password modificate con successo"]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Password errata']);
        }
        exit();
    } elseif (!empty($_FILES['file'])) {
        // Directory di destinazione per i file caricati
        $uploads_dir = $_SERVER['DOCUMENT_ROOT'] . "/Cooking/img";
            
        // Nome temporaneo del file caricato
        $tmp_name = $_FILES['file']['tmp_name'];
    
        // Costruisci il percorso finale per il salvataggio
        $path = $uploads_dir . "/user.png";
        echo $path;
        // Prova a spostare il file nella destinazione
        move_uploaded_file($tmp_name, $path);
        
        $name = "./img/user.png";
        // Verifica se il file è stato caricato correttamente
        echo "File $name caricato con successo!";
        changeImage($username, $name); // Passa solo il nome del file, non l'array
    }
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
    $result = pg_query_params($db, $sql, array($Newhash, $username));
    return $result !== false;
}

function getImage($username)
{
    global $db;
    $sql = "SELECT foto FROM utente WHERE username=$1";
    $result = pg_query_params($db, $sql, array($username));
    if ($result && pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        return $row['foto'];
    }
    return null;
}

function changeImage($username, $newPhoto)
{
    global $db;
    $sql = "UPDATE utente SET foto = $1 WHERE username = $2";
    $result = pg_query_params($db, $sql, array($newPhoto, $username));
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
    <link rel="stylesheet" href="account1.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    <title>Area Riservata</title>
</head>

<body>
    <header>
        <div class="titleUtente">
            <h1>
                Area utente
            </h1>
        </div>
        <div>
            <a href="./home.php" class="returnHome"> Home</a>
        </div>
    </header>

    <main>
        <div class="subTitle1Utente">
            <h2>
                Dati anagrafici
            </h2>
            <p>
                Nome : <?php echo get_Nome($username) ?>
            </p>

            <p>
                Cognome :<?php echo get_Cognome($username) ?>
            </p>
            <p>
                <img src="<?php echo getImage($username)?>" alt="" height="50px" width="50px">
            </p>

            <p>Vuoi aggiornare la immagine di profilo ? <a id="mostraBannerImg" href="#">Clicca qui</a></p>

            <div class = banner>
                <div class="banner-content">
                <button class="bottoneAnnulla" id="nascondiBannerImg">
                                Annulla
                        </button>
                        <p>Trascina i file qui</p>
                        <div id="drop-area"></div>
                        <p>Oppure clicca per selezionare un file</p>
                        <input type="file" id="fileElem" name="file" accept="image/png, image/jpeg">
                        <div id="file-list"></div>
                    </div>
                </div>
            </div>

        </div>



        <div class="subTitle2Utente">
            <h2> Dati di Accesso </h2>
            <p>
                Username : <?php echo $username ?>
            </p>

            <p>Vuoi aggiornare la password ? <a id="mostraBannerPass" href="#">Clicca qui</a></p>

            <form id="CambiaPasswordForm" method="post">
                <div class = "banner">
                    <div class="banner-content">
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
                        <button class="bottoneAnnulla" id="nascondiBannerPass">
                            Annulla
                        </button>
                    </div>
                </div>
                <div class="logout" action="logout">
                    <a href="?logout=true" class="logoutButton">Logout</a>
                </div>
            </form>
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

<script>
    document.getElementById('mostraBannerPass').addEventListener('click', function (event) {
        event.preventDefault();
        const banner = document.getElementsByClassName('banner')[1].style.display = 'flex';
    });
    document.getElementById('nascondiBannerPass').addEventListener('click', function (event) {
        event.preventDefault();
        const banner = document.getElementsByClassName('banner')[1].style.display = 'none';
    });

    document.getElementById('mostraBannerImg').addEventListener('click', function (event) {
        event.preventDefault();
        const banner = document.getElementsByClassName('banner')[0].style.display = 'flex';
    });
    document.getElementById('nascondiBannerImg').addEventListener('click', function (event) {
        event.preventDefault();
        const banner = document.getElementsByClassName('banner')[0].style.display = 'none';
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
    // Elementi della pagina
    const dropArea = document.getElementById('drop-area');
    const fileInput = document.getElementById('fileElem');
    const fileList = document.getElementById('file-list');

    // Impediamo l'azione di default per il drag and drop
    dropArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropArea.style.backgroundColor = '#e9e9e9'; // cambia colore per feedback
    });

    dropArea.addEventListener('dragleave', () => {
        dropArea.style.backgroundColor = '#fff'; // ripristina il colore
    });

    // Gestiamo il drop dei file
    dropArea.addEventListener('drop', (e) => {
        e.preventDefault();
        dropArea.style.backgroundColor = '#fff';

        const files = e.dataTransfer.files;
        handleFiles(files);
    });

    // Quando un file viene selezionato tramite input file
    fileInput.addEventListener('change', () => {
        const files = fileInput.files;
        handleFiles(files);
    });

    // Funzione per mostrare i file selezionati
    function handleFiles(files) {
        // Mostra i file nella lista
        const fileArray = Array.from(files)[0];
        fileList.innerHTML = '';
        const p = document.createElement('p');
        p.textContent = fileArray.name;
        fileList.appendChild(p);

        // Chiamata per caricare i file sul server
        uploadFiles(fileArray);
    }


    // Funzione per caricare i file sul server usando AJAX
    function uploadFiles(files) {
        const formData = new FormData();

        formData.append('file', files);
        // Creazione della richiesta XMLHttpRequest
        const xhr = new XMLHttpRequest();
        // Impostiamo il tipo di richiesta e l'URL del server
        xhr.open('POST', 'account.php', true);

        // Impostiamo la funzione di callback che verrà chiamata quando la richiesta è completata
        xhr.onload = function () {
            if (xhr.status === 200) {
                // Se la richiesta ha avuto successo
                alert('Caricamento completato:' + xhr.responseText);
                window.location.reload();
            } else {
                // Se si è verificato un errore
                alert('Errore nel caricamento: ' + xhr.statusText);
            }
        };

        // Invio dei dati tramite AJAX
        xhr.send(formData);
    }

</script>