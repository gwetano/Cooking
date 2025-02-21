<?php
session_start();
require './db.php';
require_once './funzioni.php';

if (!isset($_SESSION['username'])) {
    echo "<script>
        window.location.href = 'accesso.php';
    </script>";
    exit;
} else
    $username = $_SESSION['username'];

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_GET['action'] ?? '';
    if ($action === 'cambiaPassword') {
        header('Content-Type: application/json');
        $password = $_POST['oldPassword'] ?? '';
        $newPassword = $_POST['newPassword'] ?? '';
        $confermaNewPassword = $_POST['confermaNewPassword'] ?? '';

        $hash = get_pwd($username);
        if (password_verify($password, $hash)) {
            if ($newPassword !== $confermaNewPassword) {
                echo json_encode(['success' => false, 'message' => 'Le password non corrispondono.']);
            } elseif ($newPassword == $password) {
                echo json_encode(['success' => false, 'message' => 'Nessun cambiamento, vecchia password e nuova password corrispondono']);
            } else {
                changePassword($username, $newPassword);
                echo json_encode(['success' => true, 'message' => "Password modificata con successo"]);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Password errata']);
        }
        exit();
    } elseif (!empty($_FILES['file'])) {
        $uploads_dir = $_SERVER['DOCUMENT_ROOT'] . "/Cooking/immaginiUser";
        $tmp_name = $_FILES['file']['tmp_name'];
        $file_type = mime_content_type($tmp_name);
        $allowed_types = ['image/png', 'image/jpeg'];
        if (!in_array($file_type, $allowed_types)) {
            echo "Errore: formato file non supportato! Carica solo PNG o JPEG.";
            exit;
        }

        $path = $uploads_dir . "/$username.png";

        move_uploaded_file($tmp_name, $path);

        $name = "./immaginiUser/$username.png";
        echo "File caricato con successo!";
        changeImage($username, $name);
    }
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style.css">
    <title>Account</title>
    <script defer src="./funzioni.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="./img/icon.ico">
    <link
        href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap">
</head>

<body>
    <header id="headerAccount">
        <div class="logo">
            <a href="./index.php"><img src="./img/icon.png" class="logoHome"></a>
        </div>

        <div class="title">
            <h1>Area Utente</h1>
        </div>
        <div class="loggato">
            <a href="./home.php"> <img src="./img/home.png" class="logoHome"></a>
        </div>
    </header>

    <main id="mainAccount">
        <div class="mainAccountRow1">
            <div class="datiImmagine">
                <div class="containerImmagine">
                    <img src="<?php echo getImage($username) ?>" alt="Immagine Utente" class="ImmagineUtente">
                    <img src="./img/matita.png" alt="cambiaImmagine" class="matita" id="mostraBannerImg">
                </div>
                <div class=banner>
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

            <div class="Dati">
                <div class="DatiAnagrafici">
                    <h2>
                        Dati anagrafici
                    </h2>
                    <p>
                        Nome : <span><?php echo ucfirst(get_Nome($username)) ?></span>
                    </p>

                    <p>
                        Cognome : <span><?php echo ucfirst(get_Cognome($username)) ?></span>
                    </p>
                </div>
                <div class="DatiAccesso">
                    <h2> Dati di Accesso </h2>
                    <p>
                        Username : <span><?php echo $username ?></span>
                    </p>

                    <p>
                        Vuoi aggiornare la password ? <a id="mostraBannerPass" href="#">Clicca qui</a>
                    </p>

                    <form id="CambiaPasswordForm" method="post">
                        <div class="banner">
                            <div class="banner-content">
                                <div class="input-group">
                                    <label for="oldPassword">Vecchia Password:</label>
                                    <input type="password" id="oldPassword" name="oldPassword" required>
                                </div>

                                <div class="input-group">
                                    <label for="newPassword">Nuova Password:</label>
                                    <input type="password" id="newPassword" name="newPassword" required>
                                </div>

                                <div class="input-group">
                                    <label for="confermaNewPassword">Conferma Password:</label>
                                    <input type="password" id="confermaNewPassword" name="confermaNewPassword" required>
                                </div>

                                <div class="button-group">
                                    <button class="bottoneConferma">Conferma</button>
                                    <button class="bottoneAnnulla" id="nascondiBannerPass">Annulla</button>
                                </div>
                            </div>
                        </div>
                        <div class="Containerlogout" action="logout">
                            <a href="?logout=true" class="logoutButton">LOGOUT</a>
                        </div>
                </div>
                </form>
            </div>
        </div>

        <div class="mainAccountRow2">
            <h1>Le tue ricette preferite</h1>
            <?php
            $ricettePreferite = getRicettePreferite($username);
            if (!empty($ricettePreferite)) { ?>
                <div class="ricettePreferiteAreaUtente">
                    <?php
                    foreach ($ricettePreferite as $id) {
                        $nome = getNomeRicetta($id);
                        $descrizione = getDescrizioneRicetta($id);
                        $foto = getFotoRicetta($id);
                        ?>
                        <div class="ricetta<?php echo $id ?>" onclick="vaiAllaRicetta(event, <?php echo $id; ?>)">
                            <div class="fotoRicettaAccount">
                                <img src="<?php echo htmlspecialchars($foto); ?>" alt="ricetta<?php echo $id; ?>" height="20px">
                            </div>
                            <div class="infoRicettaAccount">
                                <div class="nomeRicetta">
                                    <?php
                                    echo $nome; ?>
                                </div>
                                <div class="descrizioneRicetta">
                                    <?php
                                    echo $descrizione; ?>
                                </div>
                            </div>

                        </div>

                        <?php
                    }
                    ?>
                </div><?php
            } else { ?>
                <div class="contenutoEmptyMainColumn1">
                    <p>Nessuna ricetta nei preferiti</p>
                </div>
                <?php
            }
            ?>
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

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'account.php?action=cambiaPassword', true);

        xhr.onload = function () {
            if (xhr.status == 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success == true) {
                    alert(response.message);
                    window.location.href = 'account.php';
                }
                else {
                    alert(response.message);
                }
            }
            else {
                alert('Errore nel caricamento;');
            }
        };
        xhr.send(formData);
    });

    const dropArea = document.getElementById('drop-area');
    const fileInput = document.getElementById('fileElem');

    dropArea.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropArea.style.backgroundColor = '#e9e9e9';
    });

    dropArea.addEventListener('dragleave', () => {
        dropArea.style.backgroundColor = '#fff';
    });

    dropArea.addEventListener('drop', (e) => {
        e.preventDefault();
        dropArea.style.backgroundColor = '#fff';

        const files = e.dataTransfer.files;
        if (files.length > 0) {
            uploadFiles(files[0]);
        }
    });

    fileInput.addEventListener('change', () => {
        const files = fileInput.files;
        if (files.length > 0) {
            uploadFiles(files[0]);
        }
    });
</script>