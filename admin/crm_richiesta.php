<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 

$titolo = 'Gestione CRM';
$sitowebdiriferimento = 'www.millebytes.com'; 
$areapagina = "crm";
$coldx = "no";

$crm_id = $_REQUEST['crm_id'];
@$azione = $_REQUEST['azione'];
	switch ($azione) {
		case "aggiorna":
				$updateSQL = sprintf("UPDATE t_crm SET status_id=%s, date_update=%s WHERE crm_id=%s",
						GetSQLValueString($_POST['status_id'], "int"),
						GetSQLValueString(date("d-m-Y H:i:s"), "text"),
						GetSQLValueString($_POST['crm_id'], "int"));

				  mysqli_select_db($database_admin, $admin);
			$Result1 = mysqli_query($updateSQL, $admin) or die(mysql_error());
			
			/*
			$oggettomail = "Aggiornamento dallo stato della tua richiesta di assistenza";
			$testomessaggio = "Lo stato della tua richiesta di assistenza ".$_POST['crm_id']." è stato aggiornato.";
			$testomessaggio .= "<br /><a href = \"http://www.millebytes.com/members/show-tickets\"><strong>Clicca qui per collegarti all'area assistenza </strong></a>";
				  require_once('inc_mail.php');
				  
			*/
				  
			break;
		case "aggiungi":
		
		$text = $_POST['requiredtext'];
		$caratteri = array(chr(149),chr(133),chr(96),chr (145),chr(146),chr(147),chr(148),chr(150),"\n"); 
		$cambio = array(chr(42),"...",chr(39),chr(39),chr(39),chr(34), chr(34),chr(45),"<br />");
		$text = str_replace( $caratteri, $cambio, $text); 
		
				$insertSQL = sprintf("INSERT INTO t_crm_messages (crm_id, date_msg, author_id, text) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['crm_id'], "int"),
                       GetSQLValueString(date("d-m-Y H:i:s"), "text"),
                       GetSQLValueString($_POST['author_id'], "int"),
                       GetSQLValueString($text, "text"));

				  mysqli_select_db($database_admin, $admin);
				  $Result1 = mysqli_query($insertSQL, $admin) or die(mysql_error());
				  
				  $updateSQL = sprintf("UPDATE t_crm SET date_update=%s WHERE crm_id=%s",
						GetSQLValueString(date("d-m-Y H:i:s"), "text"),
						GetSQLValueString($_POST['crm_id'], "int"));

				  mysqli_select_db($database_admin, $admin);
				  $Result1 = mysqli_query($updateSQL, $admin) or die(mysql_error());
			$oggettomail = "Nuova risposta alla tua richiesta di assistenza";
			$testomessaggio = "Hai ricevuto una risposta alla tua richiesta di assistenza: ".$_POST['crm_id'];
			$testomessaggio .= "<br /><a href = \"http://www.millebytes.com/members/show-tickets\"><strong>Clicca qui per collegarti all'area assistenza</strong></a>";
			require_once('inc_mail.php');
		    break;
		
		case "allega":
			$upload_dir = $_SERVER["DOCUMENT_ROOT"] . "/crm_files/";
			$new_name = $crm_id."_".$_FILES["allegato"]["name"];
			$new_name = str_replace(" ", "_", $new_name);

			if(trim($_FILES["allegato"]["name"]) == "") {die("Non hai indicato il file da uploadare!");}
			if(@is_uploaded_file($_FILES["allegato"]["tmp_name"])) {@move_uploaded_file($_FILES["allegato"]["tmp_name"], $upload_dir.$new_name)or die("Impossibile spostare il file, controlla l'esistenza o i permessi della directory dove fare l'upload.".$upload_dir.$new_name);
			} else { $esitoupload = "Problemi nell'upload del file " . $_FILES["allegato"]["name"];}
			
			$insertSQL = sprintf("INSERT INTO t_crm_files (crm_id, filename) VALUES (%s, %s)",
                       GetSQLValueString($_POST['crm_id'], "int"),
                       GetSQLValueString($new_name, "text"));

				  mysqli_select_db($database_admin, $admin);
				  $Result1 = mysqli_query($insertSQL, $admin) or die(mysql_error());

			$esitoupload = $_FILES["allegato"]["name"] . " allegato correttamente";
			break;
			
		case "cancella":
		$deleteSQL = sprintf("DELETE FROM t_crm_messages WHERE msg_id=%s",
                       GetSQLValueString($_POST['msg_id'], "int"));

			  mysqli_select_db($database_admin, $admin);
			  $Result1 = mysqli_query($deleteSQL, $admin) or die(mysql_error());
		break;
	}

mysqli_select_db($database_admin, $admin);
$query_richiesta = "SELECT * FROM t_crm WHERE crm_id = '".$crm_id."'";
$richiesta = mysqli_query($query_richiesta, $admin) or die(mysql_error());
$row_richiesta = mysqli_fetch_assoc($richiesta);
$total_richiesta = mysql_num_rows($richiesta);

mysqli_select_db($database_admin, $admin);
$query_messaggi = "SELECT * FROM t_crm_messages WHERE crm_id = '".$crm_id."' ORDER BY str_to_date(date_msg,'%d-%m-%Y %H:%i:%s') DESC";
$messaggi = mysqli_query($query_messaggi, $admin) or die(mysql_error());
$row_messaggi = mysqli_fetch_assoc($messaggi);
$total_messaggi = mysql_num_rows($messaggi);


require_once('inc_taghead.php');
?>
<script type="text/javascript" language="JavaScript"> 
<!--
function campirichiesti2(which){
var pass=true
if (document.images){
for (i=0;i<which.length;i++){
var tempobj=which.elements[i]
if (tempobj.name.substring(0,8)=="required"){
if (((tempobj.type=="text"||tempobj.type=="textarea")&&tempobj.value=='')||(tempobj.type.toString().charAt(0)=="s"&&tempobj.selectedIndex==-1)){
pass=false
break
}
}
}
}
if (!pass){
alert("ATTENZIONE!!! \n Un testo di rispodta &egrave; obbligatorio!")
return false
}
else
return true
}
 
//-->
</script>
<?php
require_once('inc_tagbody.php'); 
?>
<div id="bluebox">

<?php if ( $total_richiesta > 0) {
	$object_id = "SELECT description FROM t_crm_objects WHERE object_id='". $row_richiesta['object_id']. "'";
	list($oggetto) = mysql_fetch_row(mysqli_query($object_id));
	$user_idq = "SELECT first_name, second_name FROM t_user_info WHERE user_id='". $row_richiesta['user_id']. "'";
	list($first_name, $second_name) = mysql_fetch_row(mysqli_query($user_idq));
	$status_id = $row_richiesta['status_id'];
	$user_id = $row_richiesta['user_id'];
	
	?>
<div class="title">TICKET ASSISTENZA NUMERO <?php echo $crm_id ?></div>
<table width="100%" border="1">
<tr><td>Nome e Cognome</td><td><?php echo $first_name." ".$second_name ?></td><td><form action="user.php" method="get" target="_blank">
<input type="hidden" name="user_id" value="<?php echo $user_id ?>" /><input type="submit" value="SCHEDA" style="width:100%" /></form></td></tr>
<tr>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
<input type="hidden" name="user_id" value="<?php echo $user_id ?>" />
<td>Oggetto</td><td colspan="2"><?php echo $oggetto ?></td></tr>
<tr><td>Stato della richiesta</td><td colspan="2">
<select name="status_id" style="width:95%"><?php 
$campo = $status_id;
$tabella = "t_crm_status";
$campoconversione = "status_id";
$descrizione = "description";
mysqli_select_db($database_admin, $admin);
$conversion = "SELECT $descrizione, $campoconversione FROM $tabella";
$conv = mysqli_query($conversion, $admin) or die(mysql_error()); 
$txt = mysqli_fetch_assoc($conv);
do {
$valore = $txt['status_id'];
if ($valore == $campo) { $selected = 1; }
?>
<option value="<?php echo $valore ?>" <?php if (@$selected == "1") { echo "selected=\"selected\""; } ?>><?php echo htmlspecialchars($txt['description']) ?></option>
<?php 
$selected = "";
} while ($txt = mysqli_fetch_assoc($conv)) ?>
</select>
</td></tr>
<tr><td colspan="2">
<input type="hidden" value="<?php echo $crm_id ?>" name="crm_id" />
<input type="hidden" value="aggiorna" name="azione" />
</td><td>
<input type="submit" value="CONFERMA" style="width:100%" />
</td></tr></form>

<tr><td colspan="3">
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="return campirichiesti2(this)">
<input type="hidden" value="<?php echo $crm_id ?>" name="crm_id" />
<input type="hidden" value="aggiungi" name="azione" />
<input type="hidden" value="2" name="author_id" />
<input type="hidden" name="user_id" value="<?php echo $user_id ?>" />
<textarea name="requiredtext" cols="150" rows="10" style="width:90%"></textarea>
<input type="submit" value="AGGIUNGI RISPOSTA" style="width:60%" />
</form>
</td></tr>
<tr><td colspan="2" align="left">
<?php 
if (!empty($esitoupload)){ echo $esitoupload."<br />";}

mysqli_select_db($database_admin, $admin);
$files_query = "SELECT * FROM t_crm_files WHERE crm_id = '$crm_id'";
$files = mysqli_query($files_query, $admin) or die(mysql_error()); 
$total_files = mysql_num_rows($files);
if ($total_files > 0) { 
$files_counter = 1;
?>
Allegati: 
<?php 
do { 
if (!empty($row_files['filename'])) {?>
<a href="http://www.millebytes.com/crm_files/<?php echo $row_files['filename'] ?>" target=\"_blank\"><?php echo $files_counter ?></a>
<?php $files_counter = ++$files_counter; }
} while ($row_files = mysqli_fetch_assoc($files)); 
} else { echo "nessun allegato inserito" ; } ?>
</td><td>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
<input type="file" name="allegato" style="width:60%" />
<input type="hidden" value="<?php echo $crm_id ?>" name="crm_id" />
<input type="hidden" name="MAX_FILE_SIZE" value="40000">
<input type="hidden" value="allega" name="azione" />
<input type="submit" value="ALLEGA" style="width:30%" />
</form>
</td></tr>
</table>

<?php if ($total_messaggi > 0) { 
do { 

$stringa=$row_messaggi['date_msg'];
list($dat, $or) = split(' ', $stringa);
list($gg,$mm,$yy) = split('-', $dat);
list($hh,$min,$sc) = split(':', $or);
$nh=$hh-0;
$timestamp = mktime($nh, $min, $sc, $mm, $gg, $yy);
$nuova_data = date("d/M/Y H:i", $timestamp);

?>
<div id="bluebox"><div class="title">DI: <?php if ($row_messaggi['author_id'] == "1") {	echo "<span style=\"color:blue; font-weight:bold;\">$first_name $second_name</span>" ;} else { echo "Customer Care Club Millebytes"; }?> - DEL: <?php echo $nuova_data ?></div>
<p align="left"><?php echo $row_messaggi['text'] ?>
</p>
<p align="right"> 
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="return confermaCancella()">
<input type="hidden" name="msg_id" value="<?php echo $row_messaggi['msg_id'] ?>" />
<input type="hidden" name="crm_id" value="<?php echo $row_messaggi['crm_id'] ?>" />
<input type="hidden" name="user_id" value="<?php echo $user_id ?>" />
<input type="hidden" name="azione" value="cancella" />
<input type="submit" value="ELIMINA" style="color:#F00; width:30%" />
</form>
</p></div>
   <?php } while ($row_messaggi = mysqli_fetch_assoc($messaggi));
} 
else { ?>
<div id="bluebox">Non ci sono messaggi</div>
<?php } ?>
</div>
<?php } else {?>
Richiesta non trovata
</div>
<?php } ?>
<?php 
if (!isset($coldx)) {
require_once('inc_col_dx.php');
}
require_once('inc_footer.php'); 
?>