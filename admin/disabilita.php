<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 

$sitowebdiriferimento = 'www.millebytes.com';
$titolo = 'Strumenti Utenti';
$areapagina = "tools";
$coldx = "no";

require_once('inc_taghead.php');
require_once('inc_tagbody.php'); 




mysqli_select_db($database_admin, $admin);


//$query_insid = "Select  INTO t_respint VALUES ('$sid','$varId',0,-1,'$prj')";


$query_user = "DELETE FROM t_respint WHERE sid='ITA1509136' AND uid NOT LIKE 'GUEST'";
$tot_userGirl = mysqli_query($query_user, $admin) or die(mysql_error());
$tot_useGirl = mysqli_fetch_assoc($tot_userGirl);




?>