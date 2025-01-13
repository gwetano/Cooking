<?php
session_start(); // Avvia la sessione

// Controlla se la sessione "username" è impostata
/*if (!isset($_SESSION['username'])) {
    // Se non è autenticato, mostriamo un alert e reindirizziamo alla pagina di login
    echo "<script>
            alert('Accesso non autorizzato. Sarai reindirizzato alla pagina di login.');
            window.location.href = 'login.php'; // Cambia con il percorso della tua pagina di login
          </script>";
    exit; // Termina l'esecuzione del codice
}*/

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
    <link rel="stylesheet" href="StyleRicette1.css">
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
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
        <button class="menu-btn" onclick="openMenu()">☰</button>
        
        <div id="sidebar" class="sidebar">
            <a href="#" class="close-btn" onclick="closeMenu()">×</a>
            <a href="./index.html">Home</a>
            <a href="#./account">Account</a>
            <a href="./contact">Contact</a>
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
            <input id="searchInput" type="text" name="query" placeholder="Cerca una ricetta" class="search-input">
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
        <div class=mainRow1 data-keywords="spaghetti,aglio,olio,vegetariano">
            <div class="text">
                <div class="preview">
                    <h2>
                    Spaghetti Aglio e Olio	
                    </h2>
                    <p>
                    Un classico italiano, semplice e veloce: aglio, olio d'oliva e un pizzico di peperoncino.
                    </p>
                </div>
                <img src="./img/padella.jpg" alt="" class="immagineRicetta">    
            </div>        
        </div>

        <div class=mainRow2 data-keywords="tacos,pollo">
            <div class="text">
                <div class="preview">
                    <h2>
                    Tacos di Pollo
                    </h2>
                    <p>
                    Tortillas croccanti ripiene di pollo speziato, guacamole e salsa fresca.
                    </p>
                </div>
                <img src="./img/padella.jpg" alt="" class="immagineRicetta">
            </div>         
        </div>

        <div class=mainRow3 data-keywords="zuppa,lenticchie,vegetariano">
            <div class="text">
                <div class="preview">
                    <h2>
                    Zuppa di Lenticchie
                    </h2>
                    <p>
                    Una calda e confortante zuppa con lenticchie, verdure e un tocco di rosmarino.
                    </p>
                </div>
                <img src="./img/padella.jpg" alt="" class="immagineRicetta">
            </div>          
        </div>

        <div class=mainRow4 data-keywords="pancakes,cioccolato">
            <div class="text">
                <div class="preview">
                    <h2>
                    Pancakes al Cioccolato
                    </h2>
                    <p>
                    Soffici e golosi, con cacao nell’impasto e una cascata di sciroppo di cioccolato.
                    </p>
                </div>
            <img src="./img/padella.jpg" alt="" class="immagineRicetta">
            </div>            
        </div>

        <div class=mainRow5 data-keywords="polpette,melanzane,vegetariano">
            <div class="text">
                <div class="preview">
                    <h2>
                    Polpette di Melanzane
                    </h2>
                    <p>
                    Deliziose polpettine vegetariane, croccanti fuori e morbide dentro.
                    </p>
                </div>
            <img src="./img/padella.jpg" alt="" class="immagineRicetta">  
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
            <a href="./index.html">
                Welcome
            </a>
            ● © 2025 Cooking
        </p>
    </footer>

</body>
HTML;
echo $html;
?>