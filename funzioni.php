<?php

require './db.php';
function get_pwd($username)
{
    global $db;
    $sql = "SELECT password FROM utente WHERE username=$1";
    $result = pg_query_params($db, $sql, array($username));
    if ($result && pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        return $row['password'];
    }
    return null;
}

function get_Nome($username)
{
    global $db;
    $sql = "SELECT nome FROM utente WHERE username=$1";
    $result = pg_query_params($db, $sql, array($username));
    if ($result && pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        return $row['nome'];
    }
    return null;
}

function get_Cognome($username)
{
    global $db;
    $sql = "SELECT cognome FROM utente WHERE username=$1";
    $result = pg_query_params($db, $sql, array($username));
    if ($result && pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        return $row['cognome'];
    }
    return null;
}

function changePassword($username, $newpassword)
{
    global $db;
    $Newhash = password_hash($newpassword, PASSWORD_DEFAULT);
    $sql = "UPDATE utente SET password = $1 WHERE username = $2";
    $result = pg_query_params($db, $sql, array($Newhash, $username));
    return $result !== false;
}

function getImage($username)
{
    global $db;
    $sql = "SELECT foto FROM utente WHERE username=$1";
    $result = pg_query_params($db, $sql, array($username));
    if ($result && pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        return $row['foto'];
    }
    return null;
}

function changeImage($username, $newPhoto)
{
    global $db;
    $sql = "UPDATE utente SET foto = $1 WHERE username = $2";
    $result = pg_query_params($db, $sql, array($newPhoto, $username));
    return $result !== false;
}

?>