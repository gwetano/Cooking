<?php
function getNomeRicetta($id)
{
    global $db;
    $sql = "SELECT nome FROM ricette WHERE id=$1";
    $result = pg_query_params($db, $sql, array($id));
    if ($result && pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        return $row['nome'];
    }
    return null;
}

function getDescrizioneRicetta($id)
{
    global $db;
    $sql = "SELECT descrizione FROM ricette WHERE id=$1";
    $result = pg_query_params($db, $sql, array($id));
    if ($result && pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        return $row['descrizione'];
    }
    return null;
}

function getFotoRicetta($id)
{
    global $db;
    $sql = "SELECT foto FROM ricette WHERE id=$1";
    $result = pg_query_params($db, $sql, array($id));
    if ($result && pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        return $row['foto'];
    }
    return null;
}

function getIngredientiRicetta($id)
{
    global $db;
    $sql = "SELECT ingredienti FROM ricette WHERE id=$1";
    $result = pg_query_params($db, $sql, array($id));
    if ($result && pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        return $row['ingredienti'];
    }
    return null;
}

function getPreparazioneRicetta($id)
{
    global $db;
    $sql = "SELECT preparazione FROM ricette WHERE id=$1";
    $result = pg_query_params($db, $sql, array($id));
    if ($result && pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        return $row['preparazione'];
    }
    return null;
}

function getDifficoltaRicetta($id)
{
    global $db;
    $sql = "SELECT difficolta FROM ricette WHERE id=$1";
    $result = pg_query_params($db, $sql, array($id));
    if ($result && pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        return $row['difficolta'];
    }
    return null;
}

function getTempoRicetta($id)
{
    global $db;
    $sql = "SELECT tempo FROM ricette WHERE id=$1";
    $result = pg_query_params($db, $sql, array($id));
    if ($result && pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        return $row['tempo'];
    }
    return null;
}

function getDosiRicetta($id)
{
    global $db;
    $sql = "SELECT dosi FROM ricette WHERE id=$1";
    $result = pg_query_params($db, $sql, array($id));
    if ($result && pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        return $row['dosi'];
    }
    return null;
}

function getPresentazioneRicetta($id)
{
    global $db;
    $sql = "SELECT presentazione FROM ricette WHERE id=$1";
    $result = pg_query_params($db, $sql, array($id));
    if ($result && pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        return $row['presentazione'];
    }
    return null;
}

function getDataKeywords($id)
{
    global $db;
    $sql = "SELECT data_keywords FROM ricette WHERE id=$1";
    $result = pg_query_params($db, $sql, array($id));
    if ($result && pg_num_rows($result) > 0) {
        $row = pg_fetch_assoc($result);
        return $row['data_keywords'];
    }
    return null;
}

function getIdRicette()
{
    global $db;
    $query = "SELECT id FROM ricette ORDER BY id ASC";
    $result = pg_query($db, $query);

    if (!$result) {
        echo "Errore nella query.";
        return [];
    }

    $ids = [];
    while ($row = pg_fetch_assoc($result)) {
        $ids[] = $row['id'];
    }

    return $ids;
}

function getRicettePreferite($username)
{
    global $db;
    $sql = "SELECT id FROM preferiti WHERE username=$1";
    $result = pg_query_params($db, $sql, array($username));
    if ($result && pg_num_rows($result) > 0) {
        $ids = [];
        while ($row = pg_fetch_assoc($result)) {
            $ids[] = $row['id'];
        }
        return $ids;
    }
    return [];
}

function addRicettePreferite($username, $id)
{
    global $db;
    $sql = "INSERT INTO preferiti(username, id) VALUES($1, $2)";
    $result = pg_query_params($db, $sql, array($username, $id));
    return $result !== false;
}

function removeRicettePreferite($username, $id)
{
    global $db;
    $sql = "DELETE FROM preferiti WHERE id = $1 AND username = $2";
    $result = pg_query_params($db, $sql, array($id, $username));
    return $result !== false;
}

function isPrefertito($username, $id)
{
    global $db;
    $sql = "SELECT id FROM preferiti WHERE username=$1 AND id=$2";
    $result = pg_query_params($db, $sql, array($username, $id));
    return $result && pg_num_rows($result) > 0;
}

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

function generaIdCasuale()
{
    $ids = getIdRicette();
    $randomIndex = array_rand($ids);
    return $ids[$randomIndex];
}

function generaNumeriCasualiDiversi()
{
    $arrayNumeri = getIdRicette();
    $count = 4;
    shuffle($arrayNumeri);
    return array_slice($arrayNumeri, 0, $count);
}

?>