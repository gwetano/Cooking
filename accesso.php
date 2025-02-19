<?php
session_start();
require './db.php';
require_once './funzioni.php';

if (!isset($_GET['id']))
    $idRicetta = 0;
else
    $idRicetta = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    $action = $_GET['action'] ?? '';

    if ($action === 'login') {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $hash = get_pwd($username);

        if (!$hash) {
            echo json_encode(['success' => false, 'message' => "L'utente $username non esiste."]);
        } elseif (password_verify($password, $hash)) {
            $_SESSION['username'] = $username;
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Username o password errati.']);
        }
        exit();
    }

    if ($action === 'register') {
        $nome = $_POST['nome'] ?? '';
        $cognome = $_POST['cognome'] ?? '';
        $username = $_POST['usernameRegistrazione'] ?? '';
        $password = $_POST['passwordRegistrazione'] ?? '';
        $repassword = $_POST['repassword'] ?? '';

        if ($password !== $repassword) {
            echo json_encode(['success' => false, 'message' => 'Le password non corrispondono.']);
        } elseif (username_exist($username)) {
            echo json_encode(['success' => false, 'message' => 'Username già esistente.']);
        } elseif (insert_utente($username, $password, $nome, $cognome)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Errore durante la registrazione.']);
        }
        exit();
    }

    echo json_encode(['success' => false, 'message' => 'Azione non valida.']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Style.css">
    <title>Accesso</title>
    <script defer src="./funzioni.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="./img/icon.ico">
    <link
        href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap">
</head>

<body>
    <header id="headerAccesso">
        <div class="titolo">
            <div class="logo">
                <img src="./img/icon.png" onclick="vaiAIndex(event)">
            </div>

            <div class="title">
                <h1>Cooking</h1>
            </div>
        </div>
        <div class="subtitle">
            <p>Se hai già un account, accedi. Altrimenti registrati subito!</p>
        </div>
    </header>

    <main id="mainAccesso">
        <form id="loginForm">
            <p>
                <input type="hidden" name="idRicetta" id="idRicetta" value="<?php echo $idRicetta ?>">
                <input type="text" name="username" class="username" placeholder="Username" required>
            </p>
            <p>
                <input type="password" name="password" class="password" placeholder="Password" required id="password">
                <img src="./img/viewPassword.png" alt="" id="visualizzaPassword" height="20px" width="20px"
                    class="viewPassword">
            </p>
            <p>
                <button type="submit" class="bottone">Accedi</button>
            </p>
            <p>Non hai un account? <span id="registratiCliccabile" class="registratiCliccabile">Registrati</span></p>
        </form>
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

    document.getElementById('loginForm').addEventListener('submit', function (event) {
        event.preventDefault();
        const formData = new FormData(this);
        const id = document.getElementById('idRicetta').value;

        fetch('?action=login', {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (id > 0) {
                        window.location.href = 'ricetta.php?id=' + id;
                    }
                    else {
                        window.location.href = 'index.php';
                    }
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Errore:', error));
    });

    document.getElementById('registratiCliccabile').addEventListener('click', function () {
        document.getElementById('mainAccesso').innerHTML = `
                 <form id="registerForm">
        
                    <img src="./img/bottoneChiudiFinestra.png" alt="chiudiFinestra" onclick="chiudiFinestra()" class="closeButton">
    
                    <p>
                        <input type="text" name="nome" placeholder="Nome" required class="nome">
                    </p>
                    <p>
                        <input type="text" name="cognome" placeholder="Cognome" required class="cognome">
                    </p>
                    <p>
                        <input type="text" name="usernameRegistrazione" placeholder="Username" required class="username">
                    </p>
                    <p>
                        <input type="password" name="passwordRegistrazione" placeholder="Password" required class="password">
                    </p>
                    <p>
                        <input type="password" name="repassword" placeholder="Ripeti Password" required class="ripetipassword">
                    </p>
                    <p>
                        <input type="checkbox" name="terms" required> Accetto termini e condizioni
                    </p>
                    <p>
                    <button type="submit" class="bottone">Registrati</button>
                    </p>
                </form>
            `;

        document.getElementById('registerForm').addEventListener('submit', function (event) {
            event.preventDefault();
            const formData = new FormData(this);
            fetch('?action=register', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Registrazione completata! Ora puoi accedere.');
                        window.location.reload();
                    } else {
                        alert(data.message);
                    }
                })
                .catch(error => console.error('Errore:', error));
        });
    });

    document.getElementById('visualizzaPassword').addEventListener('mouseover', function (event) {
        document.getElementById('password').setAttribute('type', 'text');
    });

    document.getElementById('visualizzaPassword').addEventListener('mouseout', function (event) {
        document.getElementById('password').setAttribute('type', 'password');
    });

</script>