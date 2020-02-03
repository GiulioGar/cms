<?php 

require_once('../Connections/admin.php'); 
require_once('inc_auth.php'); 
mysqli_select_db($database_admin, $admin);	

require_once('inc_taghead.php');
require_once('inc_tagbody.php');


$cerca_svolte=$_REQUEST['svo'];
if ($cerca_svolte==""){$cerca_svolte="%";}

$cerca_registrati=$_REQUEST['reg'];
if ($cerca_registrati==""){$cerca_registrati="%";}


$utenti = isset($_POST['utenti']) ? $_POST['utenti'] : array();
foreach($utenti as $utente) {
	

$utentecompleto = explode("|", $utente);

$invitante=$utentecompleto[0]; 
$invitato=$utentecompleto[1]; 

//echo $invitante."<br>";
//echo $invitato."<br>"; 
	

$query_cerca_livello = "SELECT field_data_field_user_level.entity_id,field_user_level_value FROM field_data_field_user_id, t_user_info,field_data_field_user_level where t_user_info.email='".$invitante."' AND t_user_info.user_id=field_data_field_user_id.field_user_id_value AND field_data_field_user_id.entity_id=field_data_field_user_level.entity_id";
$cerca_livello = mysqli_query($admin,$query_cerca_livello) or die(mysql_error());
$lvl = mysqli_fetch_assoc($cerca_livello);

//echo "ciaooo ".$lvl['entity_id'];

//$query_aggiorna = "UPDATE field_data_field_user_level SET field_user_level_value=field_user_level_value+1 WHERE entity_id='".$lvl['entity_id']."'";
$query_aggiorna = "UPDATE field_data_field_user_level SET field_user_level_value=field_user_level_value+1 WHERE entity_id='".$lvl['entity_id']."'";
$add_livello = mysqli_query($admin,$query_aggiorna) or die(mysql_error());

//echo "ciaooo ".$lvl['entity_id'];

$query_aggiorna = "UPDATE PortaAmico SET assegnato=1 WHERE (email_invitante='".$invitante."' and email_invitato='".$invitato."')";
$add_livello = mysqli_query($admin,$query_aggiorna) or die(mysql_error());

 

}


$x_pag = 50;

// Recupero il numero di pagina corrente.
// Generalmente si utilizza una querystring

$pag = isset($_GET['pag']) ? $_GET['pag'] : 1;

// Controllo se $pag è valorizzato e se è numerico
// ...in caso contrario gli assegno valore 1
if (!$pag || !is_numeric($pag)) $pag = 1; 






//$all_rows=mysql_num_rows(mysqli_query("SELECT * FROM PortaAmico where assegnato=0"));

$all_pages = ceil($all_rows / $x_pag);




// Calcolo da quale record iniziare
$first = ($pag - 1) * $x_pag;


//$query_cerca = "SELECT * FROM PortaAmico where assegnato=0 LIMIT $first, $x_pag";
$query_cerca = "SELECT * FROM PortaAmico";
$cerca = mysqli_query($admin,$query_cerca) or die(mysql_error());

?>

<!--
<form name="modulo_cerca_registrati" style="height:50px; margin-left:150px; max-width:500px; position:relative; top:10px; " action="RichiestePortaAmico2.php" method="get">
	<select name="reg">
	<option value="">[REG/No REG]</option>
	<option value="REG" <?php if ($cerca_registrati=="REG") {echo 'selected="selected"';} ?>>REGISTRATI</option>
	<option value="REN" <?php if ($cerca_registrati=="REN") {echo 'selected="selected"';} ?>>NON REGISTRATI</option>
	</select>
	<select name="svo">
	<option value="">[Svolte/No Svolte]</option>
	<option value="SVO" <?php if ($cerca_svolte=="SVO") {echo 'selected="selected"';} ?>>SVOLTE</option>
	<option value="SVN" <?php if ($cerca_svolte=="SVN") {echo 'selected="selected"';} ?>>NON SVOLTE</option>
	</select>
	<input type="submit" value="Filtra"></td>
	</form>

-->



<form name="modulo_cerca_registrati" style="height:50px; margin-left:150px; max-width:500px; position:relative; top:10px; " action="RichiestePortaAmico.php" method="get">
	<select name="svo">
	<option value="">[Svolte/No Svolte]</option>
	<option value="SVO" <?php if ($cerca_svolte=="SVO") {echo 'selected="selected"';} ?>>SVOLTE</option>
	<option value="SVN" <?php if ($cerca_svolte=="SVN") {echo 'selected="selected"';} ?>>NON SVOLTE</option>
	</select>
	<input type="submit" value="Filtra"></td>
	</form>



<form method="post" action="RichiestePortaAmico.php">
<table style="font-size:12px; border:1px dotted gray; width:90%">
<tr><th></th><th>Invitante</th><th>Invitato</th><th>Data</th><th>Stato Ricerca</th><th>Livello</th></tr>

<?php
$reg=0;
$svo=0;
$contact=0;

	while ($row = mysqli_fetch_assoc($cerca))
		{
		
		
		
			
			$query_conta = "SELECT COUNT(email) as tot  FROM t_user_info where email='".$row['email_invitato']."'";
			$surClo = mysqli_query($admin,$query_conta) or die(mysql_error());
			$cloSur = mysqli_fetch_assoc($surClo);
			
			
			
			if ($row['assegnato']==1){$txt='disabled'; $livello='ASSEGNATO';}
								      else
									  {$txt='';  $livello='NON ASSEGNATO';}
			
			
			if ($cloSur['tot']>0)
			{
			$stato='<span style="background-color:green;">REGISTRATO</span>';
			$reg++;
			$contact++;
			
			}
			else
			{
			$stato='<span style="background-color:red;">NON REGISTRATO</span>';	
			$contact++;
			}
			
		
			
			
		
	    if ($cloSur['tot']>0)
		{
	    
		/*
		$query_cerca_livello = "SELECT field_data_field_user_level.entity_id,field_user_level_value FROM field_data_field_user_id, t_user_info,field_data_field_user_level where t_user_info.email='".$row['email_invitato']."' AND t_user_info.user_id=field_data_field_user_id.field_user_id_value AND field_data_field_user_id.entity_id=field_data_field_user_level.entity_id";
        $cerca_livello = mysqli_query($query_cerca_livello, $admin) or die(mysql_error());
        $lvl = mysqli_fetch_assoc($cerca_livello);
		*/
	
		
		$query_cerca_uid = "SELECT user_id FROM t_user_info where t_user_info.email='".$row['email_invitato']."'";
		$cerca_uid = mysqli_query($admin,$query_cerca_uid) or die(mysql_error());
		$uidtrovato = mysqli_fetch_assoc($cerca_uid);
			
		
		$user_id=$uidtrovato['user_id'];
		
		
		//$query_conta2 = "SELECT COUNT(user_id) FROM (SELECT user_id FROM t_user_history WHERE (user_id ='".$user_id."') LIMIT 2)  as tot";
		$query_conta2 = "SELECT COUNT(user_id) as tot FROM t_user_history WHERE (user_id ='".$user_id."')";
		$surClo2 = mysqli_query($admin,$query_conta2) or die(mysql_error());
		$cloSur2 = mysqli_fetch_assoc($surClo2);
		
		
		if ($cloSur2['tot']>1)
		{
		$testostato="<span style=\"background-color:green;\">SVOLTA</span>";
		$svo++;
		}
		else
		{
		$testostato="<span style=\"background-color:red;\">NON SVOLTA</span>";
		}
        

		if ((($testostato=="<span style=\"background-color:green;\">SVOLTA</span>")&&($cerca_svolte=="%" || $cerca_svolte=="SVO"))|| (($testostato=="<span style=\"background-color:red;\">NON SVOLTA</span>")&&($cerca_svolte=="%" || $cerca_svolte=="SVN")))
        {		
		
		echo "<tr style='border:1px gray'><td><input type=\"checkbox\"  ".$txt." name=\"utenti[]\" value=\"".$row['email_invitante']."|".$row['email_invitato']."\"/></td><td>".$row['email_invitante']."</td><td>".$row['email_invitato']."</td><td>".$row['campo_data']."</td><td>".$testostato."</td><td>".$livello."</td></tr>";
		
		}
		
		/*
		}
		*/
	
		
		}
		
		
		
		}
	

	
		

?>
</table>

<br><br>
<?php
echo "Registrati:".$reg."<br/>";
echo "Contatti:".$contact."<br/>";
echo "Svolte:".$svo."<br/>";

/*
	// Se le pagine totali sono più di 1...
	// stampo i link per andare avanti e indietro tra le diverse pagine!
	if ($all_pages > 1){
	
	
	for ($i = 1; $i <= $all_pages; $i++) {
	echo "<a href=\"" . $_SERVER['PHP_SELF'] . "?pag=" . ($i) . "\">";
	echo $i."</a>&nbsp;";
	
	}
	
	
	
	}
	
*/
	
?>

<input type="submit" value="Assegna"/>




</form>
<?php

require_once('inc_footer.php'); 