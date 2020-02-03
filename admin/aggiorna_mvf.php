<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 

$titolo = 'Desktop Gestionale';
$sitowebdiriferimento = 'www.millebytes.com';
$areapagina = "home";
$coldx = "no";



$conta=0;
$conta0=0;
$conta1=0;
$conta2=0;
$conta3=0;
$conta4=0;
$conta5=0;



mysqli_select_db($database_admin, $admin);
$query_singolo_utente = "SELECT *  FROM t_user_info where active='1' and provenienza='Registrazione classica da Panel'";
$tot_mvf0_ncontatto = mysqli_query($query_singolo_utente, $admin) or die(mysql_error());
while($row = mysql_fetch_row($tot_mvf0_ncontatto))
{
  $id[$conta]=$row[0];
  $conta=$conta+1;
}
for ($i = 0; $i < $conta; $i++) {
    mysqli_select_db($database_admin, $admin);
	$query_conta_attivita = "SELECT COUNT(*) as total  FROM t_respint where uid='$id[$i]' AND (iid <> -1)";
    $tot_mvf0_attivita = mysqli_query($query_conta_attivita, $admin) or die(mysql_error());
    $tot_mvf_0_attivita = mysqli_fetch_assoc($tot_mvf0_attivita);
	if ($tot_mvf_0_attivita['total']==0) {$conta0=$conta0+1;}
	if ($tot_mvf_0_attivita['total']==1) {$conta1=$conta1+1;}
	if ($tot_mvf_0_attivita['total']==2) {$conta2=$conta2+1;}
	if ($tot_mvf_0_attivita['total']==3) {$conta3=$conta3+1;}
	if ($tot_mvf_0_attivita['total']==4) {$conta4=$conta4+1;}
	if ($tot_mvf_0_attivita['total']>4) {$conta5=$conta5+1;}
	
}



mysqli_select_db($database_admin, $admin);
$query_aggiorna_riga = "UPDATE  t_mvf_red set zero_att=$conta0, una_att=$conta1, due_att=$conta2, tre_att=$conta3, quattro_att=$conta4, resto_att=$conta5 where idt_mvf_red=1";
$tot_mvf0_aggiorna = mysqli_query($query_aggiorna_riga, $admin) or die(mysql_error());


echo "AGGIORNAMENTO COMPLETATO";
?>


