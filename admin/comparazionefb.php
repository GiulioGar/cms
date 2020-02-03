<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 

$titolo = 'Desktop Gestionale';
$sitowebdiriferimento = 'www.millebytes.com';
$areapagina = "home";
$coldx = "no";	  
@$var_pagato = $_REQUEST['var_pagato'];  
@$code = $_REQUEST['code']; 
$id_utente = $_REQUEST['id_utente']; 
$importo=$_GET['importo'];
$email=$_GET['email'];
@$azione = $_REQUEST['azione'];
@$cifra2 = $_REQUEST['cifra2'];
@$cifra5 = $_REQUEST['cifra5'];
@$cifra9 = $_REQUEST['cifra9'];
@$cifra15 = $_REQUEST['cifra15'];
$data=date("Y-m-d");
mysqli_select_db($database_admin, $admin);


require_once('inc_taghead.php');
require_once('inc_tagbody.php');



//COPIO HISTORY
$query_premi="SELECT COUNT(user_id) as total FROM millebytesdb.t_user_history where event_type='withdraw'";
$query_copia_premi_sample = mysqli_query($query_premi, $admin) or die(mysql_error());
$query_copia_premi_sample_t = mysqli_fetch_assoc($query_copia_premi_sample);


$query_premi_s="SELECT DISTINCT event_date FROM millebytesdb.t_user_history where event_type='withdraw'";
$query_copia_premi_sample_s = mysqli_query($query_premi_s, $admin) or die(mysql_error());


$totale_numero_richieste=0;
$totale_numero_iscritti=0;



$data_precedente="";

echo "<table class='premiview'><tr class='intesta'><td>Data Richieste</td><td>Numero Richieste</td><td>Numero Registrati</td></tr>";
while ($row = mysqli_fetch_assoc($query_copia_premi_sample_s))
{
	$data_richiesta=$row['event_date'];
	$newdate = substr($data_richiesta,0,strlen($data_richiesta)-8);
	
	
	
	
	
	
	if ($data_precedente != $newdate)
	{
		
		
		$query_premi_g="SELECT COUNT(h.user_id) as totalg FROM millebytesdb.t_user_history as h, millebytesdb.t_user_info as u where h.event_type='withdraw' AND h.event_date LIKE '".$newdate."%' AND u.user_id=h.user_id AND u.address IS NULL";
		$query_copia_premi_sample_g = mysqli_query($query_premi_g, $admin) or die(mysql_error());
		$query_copia_premi_sample_t_g = mysqli_fetch_assoc($query_copia_premi_sample_g);	
		
		
	
	echo "<tr><td>".$newdate."</td>";
	
	$query_reg="SELECT COUNT(user_id) as totalreg FROM millebytesdb.t_user_info where reg_date LIKE '".$newdate."%'";
	$query_copia_reg_sample = mysqli_query($query_reg, $admin) or die(mysql_error());
	$query_copia_reg_sample_t = mysqli_fetch_assoc($query_copia_reg_sample);
	
	
	$totale_richieste_premi=$query_copia_premi_sample_t_g['totalg'];
	
	$totale_iscritti=$query_copia_reg_sample_t['totalreg'];
	
	
	
	if ($totale_iscritti==""){$totale_iscritti=0;}
	if ($totale_richieste_premi==""){$totale_richieste_premi=0;}
	echo "<td>".$totale_richieste_premi."</td><td>".$totale_iscritti."</td></tr>";
	
	
	$totale_numero_richieste=$totale_numero_richieste+$totale_richieste_premi;
	$totale_numero_iscritti=$totale_numero_iscritti+$totale_iscritti;
	}
	
	$data_precedente=$newdate;
	
}


echo "<tr class='intesta'><td>TOTALE</td><td>".$totale_numero_richieste."</td><td>".$totale_numero_iscritti."</td></table>";



if (!isset($coldx)) {
require_once('inc_col_dx.php');
}
require_once('inc_footer.php'); 

?>