<?php
session_start(); // Avvia la sessione

// Controlla se la sessione "username" è impostata
if (!isset($_SESSION['username'])) {
    // Se non è autenticato, mostriamo un alert e reindirizziamo alla pagina di login
    echo "<script>
            alert('Accesso non autorizzato. Sarai reindirizzato alla pagina di login.');
            window.location.href = 'login.php'; // Cambia con il percorso della tua pagina di login
          </script>";
    exit; // Termina l'esecuzione del codice
}

// Se l'utente fa clic sul logout, distruggi la sessione
if (isset($_GET['logout'])) {
    session_unset(); // Rimuove tutte le variabili di sessione
    session_destroy(); // Distrugge la sessione
    header("Location: login.php"); // Reindirizza l'utente alla pagina di login
    exit; // Termina l'esecuzione del codice
}

$html = <<<HTML
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="./img/icon.png">
    <link rel="stylesheet" href="StyleRicette.css">
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <button class="menu-btn" onclick="openMenu()">☰</button>
        
        <div id="sidebar" class="sidebar">
            <a href="#" class="close-btn" onclick="closeMenu()">×</a>
            <a href="#Home">Home</a>
            <a href="#Account">Account</a>
            <a href="#contact">Contact</a>
        </div>
        
        <script>
            function openMenu() {
                document.getElementById("sidebar").style.width = "250px";
            }
        
            function closeMenu() {
                document.getElementById("sidebar").style.width = "0";
            }
        </script>

        <div class="search-form">
            <form action="search.php" method="get">
                <input type="text" name="query" placeholder="Cerca una ricetta" required class="search-input">
                <button type="submit" class="button-startSearch">🍳</button>
            </form>
        </div>

        <div class="logout">
            <a href="?logout=true" class="return"> 
                <img id="logoutImage" src="./img/logoutButton.svg" alt="Logout" height="50px" width="50px">
            </a>
        </div>

        <script>
            const logoutButton = document.getElementById('logoutImage');

            logoutButton.addEventListener('mouseover', function() {
                logoutButton.src = './img/logoutButtonRed.png'; // Assicurati che questo percorso sia corretto
            });

            logoutButton.addEventListener('mouseout', function() {
                logoutButton.src = './img/logoutButton.svg'; // Assicurati che questo percorso sia corretto
            });
        </script>

    </header>

    <main>
    </main>

    <footer>
    </footer>

</body>
HTML;
echo $html;
?>