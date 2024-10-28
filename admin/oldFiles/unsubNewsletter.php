<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$hostname_admin = "localhost"; 
$database_admin = "millebytesdb";
$username_admin = "mbuser";
$password_admin = '$leeple%1598';

$conn = new mysqli($hostname_admin, $username_admin,$password_admin, $database_admin);

if ($conn->connect_error){
    die($conn->connect_error);
}

$email=$_GET['em'];
$data=date("Y-m-d H:i:s");

if (!(empty($email))){

    $sql_insert=sprintf("INSERT IGNORE INTO unsub_newsletter (email, data) VALUES ('%s','$data'); ",
    $conn->real_escape_string($email));
    $results=$conn->query($sql_insert);

    echo "<b>Cancellazione riuscita.<br>Il tuo indirizzo e-mail è stato rimosso dall'elenco selezionato.</b>";

}else{
    echo "Errore, il campo email è vuoto";
}


?>	