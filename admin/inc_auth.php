<?php


if (!isset($_SESSION)) {
  session_start();
}
require_once('../Connections/admin.php'); 
/*
// Definisci le variabili di accesso
$MM_authorizedUsers = "g_garofalo";
$MM_restrictGoTo = "index.php";

// Funzione per il controllo degli accessi
function isAuthorized($allowedUsers, $allowedGroups, $userName, $userGroup) {
    if (empty($userName)) {
        return false; // Non autorizzato se l'utente non è loggato
    }

    $usersArray = explode(",", $allowedUsers);
    $groupsArray = explode(",", $allowedGroups);

    return in_array($userName, $usersArray) || in_array($userGroup, $groupsArray);
}

// Controllo di accesso
if (!isset($_SESSION['MM_Username']) || 
    !isAuthorized($MM_authorizedUsers, "", $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])) {
    
    // Costruzione del parametro accesscheck per il reindirizzamento
    $MM_qsChar = (strpos($MM_restrictGoTo, "?") !== false) ? "&" : "?";
    $MM_referrer = $_SERVER['PHP_SELF'];
    
    if (!empty($_SERVER['QUERY_STRING'])) {
        $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
    }

    $MM_restrictGoTo .= $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
    header("Location: " . $MM_restrictGoTo);
    exit;
}
*/
?>
<?php 
mysqli_select_db($admin,$database_admin);

require_once('inc_func.php'); 
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.2.1/css/fontawesome.min.css" integrity="sha384-QYIZto+st3yW+o8+5OHfT6S482Zsvz2WfOzpFSXMF9zqeLcFV0/wlZpMtyFcZALm" crossorigin="anonymous">