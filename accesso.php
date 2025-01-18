<?php
session_start();
require './db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: application/json');

    $action = $_GET['action'] ?? '';

    if ($action === 'login') {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $hash = get_pwd($username, $db);

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

function get_pwd($user, $db) {
    $sql = "SELECT password FROM utente WHERE username=$1";
    $result = pg_query_params($db, $sql, array($user));
    if ($result && pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        return $row['password'];
    }
    return null;
}

function username_exist($user) {
    global $db;
    $sql = "SELECT username FROM utente WHERE username=$1";
    $result = pg_query_params($db, $sql, array($user));
    return $result && pg_num_rows($result) > 0;
}

function insert_utente($username, $password, $nome, $cognome) {
    global $db;
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO utente(username, password, nome, cognome) VALUES($1, $2, $3, $4)";
    $result = pg_query_params($db, $sql, array($username, $hash, $nome, $cognome));
    return $result !== false;
}
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="./img/icon.png">
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styleAccesso2.css">
    <title>Pagina di accesso</title>
</head>
<body>
    <header>
        <div class="title">Accedi a Cooking</div>
        <div class="subtitle">Se hai già un account, accedi. Altrimenti registrati subito!</div>
    </header>

    <main id="main-content">
        <form id="loginForm">
            <p>
            <input type="text" name="username" class="username" placeholder="Username" required>
            </p>
            <p>
                <input type="password" name="password" class="password" placeholder="Password" required id="password">
                <img src="./img/viewPassword.png" alt="" id="visualizzaPassword">
            </p>
            <p>
                <button type="submit">Accedi</button>
            </p>
            <p>Non hai un account? <span id="registratiCliccabile" class="registratiCliccabile">Registrati</span></p>
        </form>

    </main>

    <script>
        document.getElementById('loginForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this); 
            fetch('?action=login', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = 'home.php';
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Errore:', error));
        });

        document.getElementById('registratiCliccabile').addEventListener('click', function() {
            document.getElementById('main-content').innerHTML = `
                 <form id="registerForm">
                    <p>
                        <button onclick="chiudiFinestra()" class=closeButton>
                            X
                        </button>
                    </p>
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
                    <button type="submit">Registrati</button>
                </form>
            `;

            document.getElementById('registerForm').addEventListener('submit', function(event) {
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

        function chiudiFinestra() {
            window.location.reload();
        }

        document.getElementById('visualizzaPassword').addEventListener('mouseover',function(event) {
            document.getElementById('password').setAttribute('type','text');
        });

        document.getElementById('visualizzaPassword').addEventListener('mouseout',function(event) {
            document.getElementById('password').setAttribute('type','password');
        });
        
    </script>

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