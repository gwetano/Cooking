<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Log-In</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="./img/icon.png">
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>
<body>
    <?php if(empty($_POST)) {?>
    <h3>Accedi</h3>
    <form method="post" action= <?php $_SERVER["PHP_SELF"] ?> >
        <input type="text" name="username" value="" class="username" placeholder="Username" required> <br><br>
        <input type="password" name="password" value="" class="password" placeholder="Password" required><br><br>
        <input type="submit" name="invio" value="Accedi"><br>
        <p>
           Non hai un Account? <a href="signin.php">Registrati</a>
        </p>
    </form>
    <?php 
    }elseif($_POST['username'] || $_POST['password']){
        $user =  $_POST['username'];
        $pass =  $_POST['password'];
        require "db.php";
        //chiama la funzione get_pwd che controlla
        //se username esiste nel DB. Se esiste, restituisce la password (hash), altrimenti restituisce false.
        $hash = get_pwd($user,$db);
        if(!$hash){
            echo "<p> L'utente $user non esiste. <a href=\"login.php\">Riprova</a></p>";
        }
        else{
            if(password_verify($pass, $hash)){
                echo "<p>Login Eseguito con successo</p>";
                //Se il login è corretto, inizializziamo la sessione
                session_start();
                $_SESSION['username']=$user;
                header("location: ./ricette.php");
            }else{
                echo "<p> La password è errata. <a href=\"login.php\">Riprova</a></p>";
            }
        }
    }
    if (isset($_GET['error']) && $_GET['error'] == 'not_logged_in') {
        echo "<p style='color: red;'>Devi effettuare l'accesso per accedere a questa pagina.</p>";
    }
    

    function get_pwd($user,$db){
        $sql = "SELECT password FROM utente WHERE username='$user'";
        $result = pg_query($db,$sql);
        if(pg_num_rows($result) > 0) {
            $row = pg_fetch_assoc($result);
            return $row["password"];
        }
    }
    ?>    
</body>
</html>