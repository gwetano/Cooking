<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Sign-In</title>

	<link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" href="./img/icon.png">
    <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
</head>
<body>
<?php
	if(isset($_POST['nome']))
		$nome = $_POST['nome'];
	else
		$nome = "";
    if(isset($_POST['cognome']))
		$cognome = $_POST['cognome'];
	else
		$cognome = "";
	if(isset($_POST['username']))
		$user = $_POST['username'];
	else
		$user = "";
	if(isset($_POST['password']))
		$pass = $_POST['password'];
	else
		$pass = "";
	if(isset($_POST['repassword']))
		$repassword = $_POST['repassword'];
	else
		$repassword = "";
    if(isset($_POST["vegano"]))
        $vegano = 1;
    else
        $vegano = 0;
    if(isset($_POST["vegetariano"]))
        $vegetariano = 1;
    else
        $vegetariano = 0;

	// Se il campo password è vuoto non effettuiamo nessun altro controllo
	if (!empty($pass)){
		// Se le due password sono diverse mostriamo un messaggio di errore
		if($pass!=$repassword){
			echo "<p> Hai sbagliato a digitare la password. Riprova</p>";
			// a $pass e $repass assegniamo una stringa vuota in modo tale che nel modulo sticky non capariranno più le password errate
			$pass = "";
			$repassword = "";
		}
		else{
			// Se la password è stata inserita e la password di conferma coincide, proseguiamo
			//ANDREBBERO INSERITI ANCHE I CONTROLLI DEGLI ALTRI VALORI OBBLIGATORI
			//....

			//CONTROLLO SE L'UTENTE GIA' ESISTE
			if(username_exist($user)){
				echo "<p> Username $user già esistente. Riprova</p>";
			}
			else{
				//ORA posso inserire il nuovo utente nel db
				if(insert_utente($user,$pass,$nome,$cognome, $vegano, $vegetariano)){
					echo "<p> Utente registrato con successo. Effettua il <a href=\"login.php\">login</a></p>";
					session_start();
                	$_SESSION['username']=$user;
					header("location: ./ricette.html");
                
				}
				else{
					echo "<p> Errore durante la registrazione. Riprova</p>";
				}
			}
		}
	}

?>
<!-- Il form viene visualizzato sempre, sia prima che dopo l'invio -->
<!-- Abbiamo realizzato uno sticky form -->
	<h3>Registrati</h3>
	<form method="post" action="signin.php">
		<p>
		<label for="nome">Nome:
			<input type="text" name="nome" id="nome" value="<?php echo $nome?>"/>
		</label>
		</p>
        <p>
		<label for="cognome">Cognome:
			<input type="text" name="cognome" id="cognome" value="<?php echo $cognome?>"/>
		</label>
		</p>
		<p>
		<label for="username">Username:
			<input type="text" name="username" id="username" value="<?php echo $user?>"/>
		</label>
		</p>
		<p>
		<label for="password">Password:
			<input type="password" name="password" id="password" value="<?php echo $pass?>"/>
		</label>
		</p>
		<p>
		<label for="repassword">Ripeti la password:
			<input type="password" name="repassword" id="repassword" value="<?php echo $repassword?>"/>
		</label>
		</p>
        <label for="vegano">Vegano
			<input type="checkbox" name="vegano" id="vegano"/>
		</label>
		</p>
        </p>
        <label for="vegetariano">Vegetariano
			<input type="checkbox" name="vegetariano" id="vegetariano"/>
		</label>
		</p>
		<p>
		<input type="submit" name="registra" value="Registrati"/>
		</p>
	</form>
</body>
</html>

<?php
function username_exist($user){
	require "./db.php";
	//CONNESSIONE AL DB
	//echo "Connessione al database riuscita<br/>";
	$sql = "SELECT username FROM utente WHERE username=$1";
	$prep = pg_prepare($db, "sqlUsername", $sql);
	// $prep sarà uguale a false in caso di fallimento nella creazione del prepared statement

	$ret = pg_execute($db, "sqlUsername", array($user));
	// $ret sarà uguale a false in caso di fallimento nell'esecuzione del prepared statement

	if(!$ret) {
		echo "ERRORE QUERY: " . pg_last_error($db);
		return false;
	}
	else{
		// $row sarà uguale a false se non sono state restituite righe della tabella
		// a seguito dell'esecizone del prepared statement.
		// Nelle specifico, è false se la tabella non contiene un record con username uguale a $user
		if ($row = pg_fetch_assoc($ret)){
			return true;
		}
		else{
			return false;
		}
	}
	pg_close($db);
}

function insert_utente($user,$pass,$nome,$cognome, $vegano, $vegetariano){
	require "./db.php";
	//CONNESSIONE AL DB
	echo "Connessione al database riuscita<br/>";
	$hash = password_hash($pass, PASSWORD_DEFAULT);
	$sql = "INSERT INTO utente(username,password,nome,cognome, vegano, vegetariano) VALUES($1, $2, $3,$4,$5,$6)";
	$prep = pg_prepare($db, "insertUser", $sql);
	$ret = pg_execute($db, "insertUser", array($user,$hash,$nome,$cognome, $vegano, $vegetariano));
	if(!$ret) {
		echo "ERRORE QUERY: " . pg_last_error($db);
		return false;
	}
	else{
		return true;
	}
	pg_close($db);
}
?>