<?php
// Verifica se l'utente è autenticato
if (!isset($_SESSION['username'])) {
    // Reindirizza alla pagina di login con un messaggio
    header("Location: login.php?error=not_logged_in");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>ALL</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="./img/icon.png">
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <h1>Benvenuto, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <h1>TUTTE LE RICETTE per gli utenti autenticati</h1>
</body>
</html>