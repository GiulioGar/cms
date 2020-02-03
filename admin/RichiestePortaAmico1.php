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
	

$query_cerca_livello = "SELECT field_data_field_user_level.entity_id,field_user_level_value FROM field_data_field_user_id, t_user_info,field_data_field_user_level where t_user_info.email='".$utente."' AND t_user_info.user_id=field_data_field_user_id.field_user_id_value AND field_data_field_user_id.entity_id=field_data_field_user_level.entity_id";
$cerca_livello = mysqli_query($query_cerca_livello, $admin) or die(mysql_error());
$lvl = mysqli_fetch_assoc($cerca_livello);



$query_aggiorna = "UPDATE field_data_field_user_level SET field_user_level_value=field_user_level_value+1 WHERE entity_id=".$lvl['entity_id']."";
$add_livello = mysqli_query($query_aggiorna, $admin) or die(mysql_error());

$query_aggiorna = "UPDATE PortaAmico SET assegnato=1 WHERE email_invitante='".$utente."'";
$add_livello = mysqli_query($query_aggiorna, $admin) or die(mysql_error());

 

}



$query_cerca = "SELECT * FROM PortaAmico where assegnato=0";
$cerca = mysqli_query($query_cerca, $admin) or die(mysql_error());

$x_pag = 10;

?>


<form name="modulo_cerca_registrati" style="height:50px; margin-left:150px; max-width:500px; position:relative; top:10px; " action="RichiestePortaAmico.php" method="get">
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


<form method="post" action="RichiestePortaAmico.php">
<table style="font-size:12px; border:1px dotted gray; width:90%">
<tr><th></th><th>Invitante</th><th>Invitato</th><th>Data</th><th>Stato Registrazione</th><th>Stato Ricerca</th><th>Livello</th></tr>

<?php

	while ($row = mysqli_fetch_assoc($cerca))
		{
		
		
		
		
			$query_conta = "SELECT COUNT(email) as tot  FROM t_user_info where email='".$row['email_invitato']."'";
			$surClo = mysqli_query($query_conta, $admin) or die(mysql_error());
			$cloSur = mysqli_fetch_assoc($surClo);
			
			if ($row['assegnato']==1){$txt='disabled'; $livello='ASSEGNATO';}
								      else
									  {$txt='';  $livello='NON ASSEGNATO';}
			
			if ($cloSur['tot']>0)
			{
			$stato='<span style="background-color:green;">REGISTRATO</span>';
			}
			else
			{
			$stato='<span style="background-color:red;">NON REGISTRATO</span>';	
			}
			
			
			
		
	    
		/*
		$query_cerca_livello = "SELECT field_data_field_user_level.entity_id,field_user_level_value FROM field_data_field_user_id, t_user_info,field_data_field_user_level where t_user_info.email='".$row['email_invitato']."' AND t_user_info.user_id=field_data_field_user_id.field_user_id_value AND field_data_field_user_id.entity_id=field_data_field_user_level.entity_id";
        $cerca_livello = mysqli_query($query_cerca_livello, $admin) or die(mysql_error());
        $lvl = mysqli_fetch_assoc($cerca_livello);
		*/
	
		
		$query_cerca_uid = "SELECT user_id FROM t_user_info where t_user_info.email='".$row['email_invitato']."'";
		$cerca_uid = mysqli_query($query_cerca_uid, $admin) or die(mysql_error());
		$uidtrovato = mysqli_fetch_assoc($cerca_uid);
			
		
		$user_id=$uidtrovato['user_id'];
		
		
		$query_conta = "SELECT COUNT(uid) as tot  FROM t_respint where ((uid ='$user_id') AND ((status=1)||(status=3)||(status=4)||(status=5))) limit 10";
		$surClo = mysqli_query($query_conta, $admin) or die(mysql_error());
		$cloSur = mysqli_fetch_assoc($surClo);
		
		
		
		
		
		if ($cloSur['tot']>0)
		{
		$testostato="SVOLTA";
		}
		else
		{
		$testostato="NON SVOLTA";
		}
        
		if ((($stato=='<span style="background-color:green;">REGISTRATO</span>')&&($cerca_registrati=="%" || $cerca_registrati=="REG"))|| (($stato=='<span style="background-color:red;">NON REGISTRATO</span>')&&($cerca_registrati=="%" || $cerca_registrati=="REN")))
        {	

		if ((($testostato=='SVOLTA')&&($cerca_svolte=="%" || $cerca_svolte=="SVO"))|| (($testostato=='NON SVOLTA')&&($cerca_svolte=="%" || $cerca_svolte=="SVN")))
        {		
		
		
		echo "<tr style='border:1px gray'><td><input type=\"checkbox\"  ".$txt." name=\"utenti[]\" value=\"".$row['email_invitante']."\"/></td><td>".$row['email_invitante']."</td><td>".$row['email_invitato']."</td><td>".$row['campo_data']."</td><td>".$stato."</td><td>".$testostato."</td><td>".$livello."</td></tr>";
		}
		}
		
		}
		
	

	
		

?>
</table>
<input type="submit" value="Assegna"/>
</form>
<?php

require_once('inc_footer.php'); 