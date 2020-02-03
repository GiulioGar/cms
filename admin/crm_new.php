<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 

$titolo = 'Gestione CRM';
$sitowebdiriferimento = 'www.millebytes.com'; 
$areapagina = "crm";
$coldx = "no";
@$azione = $_REQUEST['azione'];

if ($azione == "inserisci") {
	
	$email = trim($_REQUEST['email']);
			$query_verifica = "SELECT user_id, email FROM t_user_info WHERE email = '$email'";
			$verifica = mysqli_query($query_verifica, $admin) or die(mysql_error());
			$row_verifica = mysqli_fetch_assoc($verifica);
			$total_verifica = mysql_num_rows($verifica);
	if	($total_verifica > 0) {
	$date_update = date("d-m-Y H:i:s");
	$user_id = $row_verifica['user_id'];
	$insertSQL = sprintf("INSERT INTO t_crm (user_id, object_id, date_update, status_id) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($user_id, "text"),
                       GetSQLValueString($_POST['object_id'], "int"),
					   GetSQLValueString($date_update, "text"),
                       GetSQLValueString($_POST['status_id'], "int"));
			  mysqli_select_db($database_admin, $admin);
			  $Result1 = mysqli_query($insertSQL, $admin) or die(mysql_error());
			
			$query_crm = "SELECT * FROM t_crm WHERE user_id='$user_id' AND date_update='$date_update' ORDER BY str_to_date(date_update,'%d-%m-%Y') DESC";
			$crm = mysqli_query($query_crm, $admin) or die(mysql_error());
			$row_crm = mysqli_fetch_assoc($crm);
			$crm_id = $row_crm['crm_id'];
			$caratteri = array(chr(149),chr(133),chr(96),chr (145),chr(146),chr(147),chr(148),chr(150),"\n"); 
			$cambio = array(chr(42),"...",chr(39),chr(39),chr(39),chr(34), chr(34),chr(45),"<br />");
			$text = str_replace( $caratteri, $cambio, trim($_REQUEST['requiredtext'])); 
			$insertSQL = sprintf("INSERT INTO t_crm_messages (crm_id, date_msg, author_id, text) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($crm_id, "int"),
                       GetSQLValueString(date("d-m-Y H:i:s"), "text"),
                       GetSQLValueString($_POST['author_id'], "int"),
                       GetSQLValueString($text, "text"));

				  mysqli_select_db($database_admin, $admin);
				  $Result1 = mysqli_query($insertSQL, $admin) or die(mysql_error());
			header("Location: crm_richiesta.php?crm_id=$crm_id");
	} else { $erroreverifica = 1 ;}
  
}

mysqli_select_db($database_admin, $admin);
$query_status = "SELECT * FROM t_crm_status";
$status = mysqli_query($query_status, $admin) or die(mysql_error());
$row_status = mysqli_fetch_assoc($status);
$totalRows_status = mysql_num_rows($status);

mysqli_select_db($database_admin, $admin);
$query_object = "SELECT * FROM t_crm_objects";
$object = mysqli_query($query_object, $admin) or die(mysql_error());
$row_object = mysqli_fetch_assoc($object);
$totalRows_object = mysql_num_rows($object);

require_once('inc_taghead.php');

require_once('inc_tagbody.php'); 
?>
<div id="bluebox">
<?php if (@$erroreverifica == 1) {echo "<div class=\"title\">EMAIL NON PRESENTE</div>";} ?>

  <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" name="form1" id="form1" onsubmit="return campirichiesti(this)">
    <table align="center">
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Email Utente:</td>
        <td><input type="text" name="email" value="<?php echo @$_REQUEST['email'] ?>" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Oggetto:</td>
        <td><select name="object_id">
          <?php 
do {  
if (@$_REQUEST['object_id'] == $row_object['object_id']) {$selected = "\" selected=\"selected"; } else { $selected = "" ;} ?>
          <option value="<?php echo $row_object['object_id'].$selected ?>" ><?php echo $row_object['description']?></option>
          <?php $selected = "";
} while ($row_object = mysqli_fetch_assoc($object));
?>
        </select></td>
      </tr>
      
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Stato:</td>
        <td><select name="status_id">
          <?php 
do {  
?>
          <option value="<?php echo $row_status['status_id']?>" ><?php echo $row_status['description']?></option>
          <?php
} while ($row_status = mysqli_fetch_assoc($status));
?>
        </select></td>
      </tr>
      <tr><td align="right">Autore messaggio:</td><td>
      <select name="author_id">
      <option value="2">Customer Care</option>
      <option value="1">Richiesta ricevuta in email</option>
      </select></td></tr><td colspan="2">
<textarea name="requiredtext" cols="150" rows="10" style="width:90%"></textarea>
</td>
 </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">&nbsp;</td>
        <td><input type="submit" value="INSERISCI TICKET" /></td>
      </tr>
    </table>
    <input type="hidden" name="azione" value="inserisci" />
  </form>
</div>

<?php 
if (!isset($coldx)) {
require_once('inc_col_dx.php');
}
require_once('inc_footer.php'); 
?>