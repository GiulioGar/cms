<?php

require_once('../Connections/admin.php'); 

mysqli_select_db($database_admin, $admin);	


$errore=0;

$data=date("Y-m-d");

// Recupero i valori inseriti nel form
$invitante = $_POST['invitante'];
$invitato = $_POST['invitato'];



// la stringa rispetta il formato classico di una mail?
if(!preg_match( '/^[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}$/', $invitato)) {
	$errore=1;
	$txterrore=$txterrore."<br>L'indirizzo email dell'invitato non risulta valido";
}



if ($invitante==$invitato)
						 {
						 $errore=1;
						 $txterrore=$txterrore."<br>L'indirizzo email dell'invitante non può essere lo stesso dell'invitato";
						 }
	

$query_conta = "SELECT COUNT(email_invitante) as tot  FROM PortaAmico where email_invitante='".$invitante."'";
$surClo = mysqli_query($query_conta, $admin) or die(mysql_error());
$cloSur = mysqli_fetch_assoc($surClo);

if ($cloSur['tot']>5)
{
	$errore=1;
	$txterrore=$txterrore."<br>L'invitante ha superato il numero massimo di inviti";
}	

						 
$query_conta = "SELECT COUNT(email) as tot  FROM t_user_info where email='".$invitato."'";
$surClo = mysqli_query($query_conta, $admin) or die(mysql_error());
$cloSur = mysqli_fetch_assoc($surClo);

if ($cloSur['tot']>0)
{
	$errore=1;
	$txterrore=$txterrore."<br>L'indirizzo email dell'invitato risulta essere già registrato al sito";
}



$query_conta = "SELECT COUNT(email) as tot  FROM t_user_info where email='".$invitante."'";
$surClo = mysqli_query($query_conta, $admin) or die(mysql_error());
$cloSur = mysqli_fetch_assoc($surClo);

if ($cloSur['tot']==0)
{
	$errore=1;
	$txterrore=$txterrore."<br>L'indirizzo email dell'invitante non risulta essere registrato al sito";
}





$query_conta = "SELECT COUNT(email_invitato) as tot  FROM PortaAmico where email_invitato='".$invitato."'";
$surClo = mysqli_query($query_conta, $admin) or die(mysql_error());
$cloSur = mysqli_fetch_assoc($surClo);

if ($cloSur['tot']>0)
{
	$errore=1;
	$txterrore=$txterrore."<br>L'indirizzo email dell'invitato risulta essere già stato invitato da un altro utente";
}







if ($errore==0)
{
$query_user = "INSERT INTO PortaAmico (email_invitante,email_invitato,campo_data) 
VALUES ('".$invitante."','".$invitato."','".$data."')";
mysqli_query($query_user, $admin) or die(mysql_error());

// Mostro un messaggio di conferma all'utente
echo 'Inserimento effettuato correttamente!';
}
else
{
echo $txterrore;
}



?>