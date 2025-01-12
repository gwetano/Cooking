<?php
session_start(); // Avvia la sessione

if (isset($_SESSION['username'])) {
    echo 'Ciao, ' . $_SESSION['username'];
} else {
    exit;
}

$html = <<<HTML
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALL</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="./img/icon.png">
    <link rel="stylesheet" href="ricette.css">
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <header>
            <button class="menu-btn" onclick="openMenu()">☰ </button>
            
            <div id="sidebar" class="sidebar">
                <a href="#" class="close-btn" onclick="closeMenu()">×</a>
                <a href="#home">Home</a>
                <a href="#about">About</a>
                <a href="#services">Services</a>
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
        </div>
        <div class="search-form">
            <form action="search.php" method="get">
                <input type="text" name="query" placeholder="Cerca..." required class ="search-input"> 
                <button type="submit" onclick="changeView()" class="button-startSearch">🍳</button>
            </form>
        </div>

        <script>
            function changeView() {
                
            }
        </script>

        <div class="infoProfilo">
            <a href="">
                <img src="./img/imgProfilo.webp" alt="" height="90px" width="130px">
            </a>
        </div>
        
    </header>

    <main>

    </main>

    <aside>

    </aside>

    <footer>

    
    </footer>

</body>
HTML;
echo $html;
?>