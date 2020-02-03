<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 

$titolo = 'Desktop Gestionale';
$sitowebdiriferimento = 'www.millebytes.com'; 
$coldx= 'no';
$areapagina = "iscritti";

$azione = $_REQUEST['azione'];
	if ($azione == "inserisci") {
		if ($_POST['requiredemail'] != $_POST['requiredemailconf']) {$errore = $errore. "Le email non coincidono\n";}
		if ($_POST['requiredpwd'] != $_POST['requiredpwdconf']) {$errore = $errore. "Le password non coincidono\n";}
		if (isEmail($_POST['requiredemail'])) {$email = $_POST['requiredemail'];} else {$errore = "Email non valida\n";}
		if (!ControlloData($_POST['requiredbirth_date'])) {$errore = "Data di nascita non valida\n";}
}
	if (($azione == "inserisci") && (empty($errore))) {
		
		mysqli_select_db($database_admin, $admin);
			$verifyq = "SELECT user_id FROM t_user_info WHERE email = '$email'";
			$verify = mysqli_query($verifyq, $admin) or die(mysql_error());
			$verify_total = mysql_num_rows($verify);
			$row_sql = mysqli_fetch_assoc($verify);
			$user_id = $row_sql['user_id'];
	if ($verify_total < 1) {
			require_once('inc_usergen.php');
		
		 $insertSQL = sprintf("INSERT INTO t_user_info (user_id, reg_date, first_name, second_name, gender, birth_date, work_id, instr_level_id, address, code, city, province_id, country_id, mar_status_id, home_phone, mobile_phone, email, pwd, datapriv_agreement) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($user_id_new, "text"),
                       GetSQLValueString(date("d/m/Y H:i"), "text"),
                       GetSQLValueString($_POST['requiredfirst_name'], "text"),
                       GetSQLValueString($_POST['requiredsecond_name'], "text"),
                       GetSQLValueString($_POST['gender'], "int"),
                       GetSQLValueString($_POST['requiredbirth_date'], "text"),
                       GetSQLValueString($_POST['work_id'], "int"),
                       GetSQLValueString($_POST['instr_level_id'], "int"),
                       GetSQLValueString($_POST['requiredaddress'], "text"),
                       GetSQLValueString($_POST['requiredcode'], "text"),
                       GetSQLValueString($_POST['requiredcity'], "text"),
                       GetSQLValueString($_POST['province_id'], "int"),
                       GetSQLValueString($_POST['country_id'], "int"),
                       GetSQLValueString($_POST['mar_status_id'], "int"),
                       GetSQLValueString($_POST['home_phone'], "text"),
                       GetSQLValueString($_POST['mobile_phone'], "text"),
                       GetSQLValueString($_POST['requiredemail'], "text"),
                       GetSQLValueString($_POST['requiredpwd'], "text"),
                       GetSQLValueString($_POST['datapriv_agreement'], "int"));

  mysqli_select_db($database_admin, $admin);
  $Result1 = mysqli_query($insertSQL, $admin) or die(mysql_error());
  $insertSQL = sprintf("INSERT INTO t_user_stats (user_id, score, year_surveys, last_update) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($user_id_new, "text"),
                       GetSQLValueString('0', "int"),
                       GetSQLValueString('0', "int"),
                       GetSQLValueString('0', "text"),
                       GetSQLValueString('0', "double"));

  mysqli_select_db($database_admin, $admin);
  $Result1 = mysqli_query($insertSQL, $admin) or die(mysql_error());
	header("Location: user.php?user_id=$user_id_new&azione=m_stats");
			} else { $errore = "Indirizzo email gi&agrave; presente ed associato all'utente: <a href=\"user.php?user_id=".$user_id."\">".$user_id."</a>"; }
	}


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
alert("ATTENZIONE!!! \n TUTTI I CAMPI SONO OBBLIGATORI\n ECCETTO I NUMERI DI TELEFONO")
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
<div id="bluebox"><div class="intestazione">CREA NUOVO UTENTE</div>
<form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" onsubmit="return campirichiesti2(this)">
<input type="hidden" name="datapriv_agreement" value="1" />
    <table width="95%" align="center">
<?php if (!empty($errore)){echo "<tr><td colspan=\"2\"><span style=\"color:red\">$errore</span>";} ?>
     <tr><td align="left">Nome: <input type="text" name="requiredfirst_name" value="<?php echo $_REQUEST['requiredfirst_name'] ?>" style="width:60%" /></td>
        <td align="left">Cognome: <input type="text" name="requiredsecond_name" value="<?php echo $_REQUEST['requiredsecond_name'] ?>" style="width:60%" /></td>
      </tr>
      <tr>
        <td align="left">Genere: <select name="gender" style="width:30%">
        <?php if ($_REQUEST['gender'] == "0") { $selected = 1; } else { $selected = ""; } ?>
        <option value="0" <?php if ($selected == "1") { echo "selected=\"selected\""; } ?>>M</option>
        <?php if ($_REQUEST['gender'] == "1") { $selected = 1; } else { $selected = ""; } ?>
        <option value="1"<?php if ($selected == "1") { echo "selected=\"selected\""; } ?>>F</option>
        </select>
        </td>
        <td align="left">Data di nascita (gg/mm/aaaa): 
          <input type="text" name="requiredbirth_date" value="<?php echo $_REQUEST['requiredbirth_date']?>" style="width:20%" /></td>
      </tr>
      <tr>
        <td align="left">Indirizzo: <input type="text" name="requiredaddress" value="<?php echo $_REQUEST['requiredaddress'] ?>" style="width:60%" /></td>
        <td align="left">Citt&agrave;: <input type="text" name="requiredcity" value="<?php echo $_REQUEST['requiredcity'] ?>" style="width:60%" /></td>
      </tr>
      <tr>
      <td align="left">Cap: <input type="text" name="requiredcode" value="<?php echo $_REQUEST['requiredcode'] ?>" style="width:10%" /></td>
      <td align="left">Provincia: <select name="province_id" style="width:60%" ><?php 
			$tabella = "t_province";
			$campoconversione = "province_id";
			$descrizione = "description";
			mysqli_select_db($database_admin, $admin);
			$conversion = "SELECT $descrizione, $campoconversione FROM $tabella";
			$conv = mysqli_query($conversion, $admin) or die(mysql_error()); 
			$txt = mysqli_fetch_assoc($conv);
			do {
			$valore = $txt['province_id'];
			?>
            <?php if ($_REQUEST['province_id'] == $valore) { $selected = 1; } else { $selected = ""; } ?>
			<option value="<?php echo $valore ?>"<?php if ($selected == "1") { echo "selected=\"selected\""; } ?>><?php echo htmlspecialchars($txt['description']) ?></option>
			<?php 
			} while ($txt = mysqli_fetch_assoc($conv)) ?>
			</select>
			</td>
			
      <tr>
       <td align="left">Nazione: <select name="country_id" style="width:60%"><?php 
			$tabella = "t_country";
			$campoconversione = "country_id";
			$descrizione = "description";
			mysqli_select_db($database_admin, $admin);
			$conversion = "SELECT $descrizione, $campoconversione FROM $tabella";
			$conv = mysqli_query($conversion, $admin) or die(mysql_error()); 
			$txt = mysqli_fetch_assoc($conv);
			do {
			$valore = $txt['country_id'];?>
            <?php if ($_REQUEST['country_id'] == $valore) { $selected = 1; } else { $selected = ""; } ?>
			<option value="<?php echo $valore ?>"<?php if ($selected == "1") { echo "selected=\"selected\""; } ?>><?php echo htmlspecialchars($txt['description']) ?></option>
			<?php 
			} while ($txt = mysqli_fetch_assoc($conv)) ?>
			</select>
			</td>
            <td align="left">Stato Civile: <select name="mar_status_id" style="width:60%">
		<?php 
			$tabella = "t_mar_status";
			$campoconversione = "mar_status_id";
			$descrizione = "description";
			mysqli_select_db($database_admin, $admin);
			$conversion = "SELECT $descrizione, $campoconversione FROM $tabella";
			$conv = mysqli_query($conversion, $admin) or die(mysql_error()); 
			$txt = mysqli_fetch_assoc($conv);
			do {
			$valore = $txt['mar_status_id'];?>
            <?php if ($_REQUEST['mar_status_id'] == $valore) { $selected = 1; } else { $selected = ""; } ?>
			<option value="<?php echo $valore ?>"<?php if ($selected == "1") { echo "selected=\"selected\""; } ?>><?php echo htmlspecialchars($txt['description']) ?></option>
			<?php } while ($txt = mysqli_fetch_assoc($conv)) ?>
			</select></td>
       </tr>
      <tr>
        <td align="left">Lavoro: <select name="work_id" style="width:60%">
			<?php
            $tabella = "t_work";
            $campoconversione = "work_id ";
            $descrizione = "description";
            mysqli_select_db($database_admin, $admin);
            $conversion = "SELECT $descrizione, $campoconversione FROM $tabella";
            $conv = mysqli_query($conversion, $admin) or die(mysql_error());
            $txt = mysqli_fetch_assoc($conv);
            do {
            $valore = $txt['work_id']; ?>
            <?php if ($_REQUEST['work_id'] == $valore) { $selected = 1; } else { $selected = ""; } ?>
            <option value="<?php echo $valore ?>"<?php if ($selected == "1") { echo "selected=\"selected\""; } ?>><?php echo htmlspecialchars($txt['description']) ?></option>
            <?php 
            } while ($txt = mysqli_fetch_assoc($conv)) ?>
            </select>
            </td>
        <td align="left">Istruzione: <select name="instr_level_id" style="width:60%">
		<?php 
			$tabella = "t_instr_level";
			$campoconversione = "instr_level_id";
			$descrizione = "description";
			mysqli_select_db($database_admin, $admin);
			$conversion = "SELECT $descrizione, $campoconversione FROM $tabella";
			$conv = mysqli_query($conversion, $admin) or die(mysql_error()); 
			$txt = mysqli_fetch_assoc($conv);
			do {
			$valore = $txt['instr_level_id'];?>
            <?php if ($_REQUEST['instr_level_id'] == $valore) { $selected = 1; } else { $selected = ""; } ?>
			<option value="<?php echo $valore ?>"<?php if ($selected == "1") { echo "selected=\"selected\""; } ?>><?php echo htmlspecialchars($txt['description']) ?></option>
			<?php } while ($txt = mysqli_fetch_assoc($conv)) ?>
			</select>
			</td>
      </tr>
          <tr>
        <td align="left">Tel: <input type="text" name="home_phone" value="<?php echo $_REQUEST['home_phone'] ?>" style="width:60%" /></td>
        <td align="left">Mobile: <input type="text" name="mobile_phone" value="<?php echo $_REQUEST['mobile_phone'] ?>" style="width:60%" /></td>
      </tr>
      <tr>
        <td align="left">Email: <input type="text" name="requiredemail" value="<?php echo $_REQUEST['requiredemail'] ?>" style="width:60%" /></td>
        <td align="left">Conferma Email: <input type="text" name="requiredemailconf" value="" style="width:60%" /></td>
      </tr>
      <tr>
        <td align="left">Password: <input type="text" name="requiredpwd" value="" style="width:60%" /></td>
        <td align="left">Conferma Password: <input type="text" name="requiredpwdconf" value="" style="width:60%" /></td>
      </tr>
      <tr>
        <td align="left">&nbsp;</td>
        <td><input type="submit" value="AGGIUNGI UTENTE" style="width:100%" /></td>
      </tr>
    </table>
    <input type="hidden" name="azione" value="inserisci" />
  </form>

</div>
<?php if (!isset($coldx)) {
require_once('inc_col_dx.php');
}
require_once('inc_footer.php'); 
?> 