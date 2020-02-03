<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 

$titolo = 'Gestione CRM';
$sitowebdiriferimento = 'www.millebytes.com'; 
$areapagina = "crm";
$coldx= 'no';

@$requiredquestion = fissaTesto($_POST['requiredquestion']);
@$requiredanswer = fissaTesto($_POST['requiredanswer']);
@$status_id = $_POST['status_id'];
@$azione = $_POST['azione'];

switch ($azione) {
	case "aggiungi":
  $insertSQL = sprintf("INSERT INTO t_crm_faq (question, answer, status_id) VALUES (%s, %s, %s)",
                       GetSQLValueString($requiredquestion, "text"),
                       GetSQLValueString($requiredanswer, "text"),
                       GetSQLValueString($status_id, "int"));

  mysqli_select_db($database_admin, $admin);
  $Result1 = mysqli_query($insertSQL, $admin) or die(mysql_error());
  $requiredquestion = "";
  $requiredanswer = "";
  $status_id = "";
  break;
  case "cancella":
  $deleteSQL = sprintf("DELETE FROM t_crm_faq WHERE faq_id=%s",
                       GetSQLValueString($_POST['faq_id'], "int"));

  mysqli_select_db($database_admin, $admin);
  $Result1 = mysqli_query($deleteSQL, $admin) or die(mysql_error());
  break;
  case "aggiorna":
  $updateSQL = sprintf("UPDATE t_crm_faq SET status_id=%s WHERE faq_id=%s",
						GetSQLValueString($_POST['status_id'], "int"),
						GetSQLValueString($_POST['faq_id'], "int"));

  mysqli_select_db($database_admin, $admin);
  $Result1 = mysqli_query($updateSQL, $admin) or die(mysql_error());
  $requiredquestion = "";
  $requiredanswer = "";
  $status_id = "";
  break;
}

mysqli_select_db($database_admin, $admin);
$query_status = "SELECT * FROM t_crm_option_status";
$status = mysqli_query($query_status, $admin) or die(mysql_error());
$row_status = mysqli_fetch_assoc($status);
$totalRows_status = mysql_num_rows($status);

$query_faq = "SELECT * FROM t_crm_faq";
$faq = mysqli_query($query_faq, $admin) or die(mysql_error());
$row_faq = mysqli_fetch_assoc($faq);
$totalRows_faq = mysql_num_rows($faq);

require_once('inc_taghead.php');

require_once('inc_tagbody.php'); 
?>
<table width="70%" align="center"><tr><td>
<div id="bluebox"><div class="title">Nuova FAQ</div>
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="return campirichiesti(this)">
  <input type="hidden" name="azione" value="aggiungi" />
    <table align="center" width="100%">
      <tr>
        <td>Domanda:</td>
        <td><input type="text" name="requiredquestion" value="<?php echo $requiredquestion?>" style="width:100%" maxlength="195"/></td>
      </tr>
      <tr>
        <td>Risposta:</td>
        <td><textarea name="requiredanswer" style="width:100%" rows="5"><?php echo $requiredanswer?></textarea></td>
      </tr>
      <tr>
        <td>Pubblicazione:</td>
        <td align="left"><select name="status_id">
          <?php 
do {  
if ($_REQUEST['status_id'] == $row_status['status_id']){$selected="selected=\"selected\"";} else {$selected = "";}
?>
          <option value="<?php echo $row_status['status_id']?>" <?php echo $selected ?>><?php echo $row_status['description']?></option>
          <?php
} while ($row_status = mysqli_fetch_assoc($status));
?>
        </select></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td><input type="submit" value="AGGIUNGI" style="width:100%" /></td>
      </tr>
    </table>
  </form></div>
  </td></tr></table>
<?php if ($totalRows_faq>0){ ?>
<table width="95%" align="center"><tr><td>
<div class="title">FAQ Inserite</div>
<?php do { ?>
<div id="bluebox">
<table width="100%"><tr>
	<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
	<input type="hidden" name="azione" value="aggiorna" />
	<input type="hidden" name="faq_id" value="<?php echo $row_faq['faq_id'] ?>" />
<td align="left"><strong><?php echo $row_faq['question'] ?></strong></td>
<td width="10%"><select name="status_id">
 <?php 
$status = mysqli_query($query_status, $admin) or die(mysql_error());
$row_status = mysqli_fetch_assoc($status);
$totalRows_status = mysql_num_rows($status);
do {  
if ($row_faq['status_id'] == $row_status['status_id']){$selected="selected=\"selected\"";} else {$selected = "";}
?>
          <option value="<?php echo $row_status['status_id']?>" <?php echo $selected ?>><?php echo $row_status['description']?></option>
          <?php
} while ($row_status = mysqli_fetch_assoc($status));
?>
        </select></td>
        <td width="10%"><input type="submit" value="AGGIORNA STATO" style="width:100%" />
        </td></form></tr>
<tr><td colspan="2" align="left"><?php echo $row_faq['answer'] ?></td>
<td valign="bottom"><form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
<input type="hidden" name="azione" value="cancella" />
<input type="hidden" name="faq_id" value="<?php echo $row_faq['faq_id'] ?>" />
<input type="submit" value="cancella" style="width:100%" /></form></td>
</tr></table></div>
<?php } while ($row_faq = mysqli_fetch_assoc($faq)); ?>
</td></tr></table>
<?php 
}
if (!isset($coldx)) {
require_once('inc_col_dx.php');
}
require_once('inc_footer.php'); 
?>
