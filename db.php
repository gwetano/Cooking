<?php
$host = 'localhost';
$db = 'GRUPPO12';
$port = '5432';
$username = 'simonegrimaldi';
$password = 'Simone03';
$connection_string = "host=$host dbname=$db port=$port user=$username password=$password";

//CONNESSIONE AL DB
$db = pg_connect($connection_string) or die('Impossibile connetersi al database: ' . pg_last_error());
?>