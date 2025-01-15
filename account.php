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
    $user = $_SESSION['username'];

function get_pwd($user) {
    global $db;
    $sql = "SELECT password FROM utente WHERE username=$1";
    $result = pg_query_params($db, $sql, array($user));
    if ($result && pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        return $row['password'];
    }
    return null;
}

function get_Nome($user) {
    global $db;
    $sql = "SELECT nome FROM utente WHERE username=$1";
    $result = pg_query_params($db, $sql, array($user));
    if ($result && pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        return $row['nome'];
    }
    return null;
}

function get_Cognome($user) {
    global $db;
    $sql = "SELECT cognome FROM utente WHERE username=$1";
    $result = pg_query_params($db, $sql, array($user));
    if ($result && pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        return $row['cognome'];
    }
    return null;
}

function username_exist($user)
{
    global $db;
    $sql = "SELECT username FROM utente WHERE username=$1";
    $result = pg_query_params($db, $sql, array($user));
    return $result && pg_num_rows($result) > 0;
}

function insert_utente($username, $password, $nome, $cognome)
{
    global $db;
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO utente(username, password, nome, cognome) VALUES($1, $2, $3, $4)";
    $result = pg_query_params($db, $sql, array($username, $hash, $nome, $cognome));
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
    <link rel="stylesheet" href="styleRicette1.css">
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
        <form id="registerForm">
            <p>
                Nome : <input type="text" name="nome" placeholder="Nome" required class="nome" value ="<?php echo get_Nome($user)?>" >
            <p>

            <p>
                Cognome : <input type="text" name="cognome" placeholder="Cognome" required class="cognome" value ="<?php echo get_Cognome($user)?>">
            </p>

            <p>
                Username : <input type="text" name="usernameRegistrazione" placeholder="Username" required value ="<?php echo $user?>"
                    class="username" >
            </p>

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