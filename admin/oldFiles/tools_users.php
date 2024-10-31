<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 

$sitowebdiriferimento = 'www.millebytes.com';
$titolo = 'Strumenti Utenti';
$areapagina = "tools";
$coldx = "no";

if (!empty($_REQUEST['campoverifica'])) {
$campoverifica = $_REQUEST['campoverifica'];
mysqli_select_db($database_admin, $admin);
$query_verifica = "SELECT $campoverifica AS valore FROM t_user_info GROUP BY $campoverifica HAVING COUNT($campoverifica) >1 ";
$verifica = mysqli_query($query_verifica, $admin) or die(mysql_error());
$counter = mysql_num_rows($verifica);
$i = -1;
$campoverificatabella = "t.".$campoverifica;
$valori = "";
do {
	$i = ++$i;
	if (!empty($user_verifica['valore'])) {$valori .= "$campoverificatabella = '".$user_verifica['valore']."'";
	if ($i < $counter) {$valori .=" OR ";}}
}while ($user_verifica = mysqli_fetch_assoc($verifica));

$query_sql = "SELECT t.user_id as user_id, t.first_name as first_name, t.second_name as second_name, t.birth_date as data_nascita, t.pwd as password, t.home_phone as telefono_fisso, t.mobile_phone as cellulare, s.last_update as last_update, s.score as score FROM t_user_info as t, t_user_stats as s WHERE t.user_id = s.user_id AND ($valori) ORDER BY $campoverificatabella";
$sql = mysqli_query($query_sql, $admin) or die(mysql_error());
$counter = mysql_num_rows($sql);
}
else {
	$counter = 0;
}

require_once('inc_taghead.php');

require_once('inc_tagbody.php'); 
?>

<table width="90%" align="center">
<tr><td>
<div id="bluebox">

    <table width="100%" align="center"><tr>
    <td>
    	<div class="title">Cerca Utente Duplicato</div><form method="get" action="tools_users.php">
        <table align="center"><tr>
            <td>Campo da verificare</td>
            <td>
            <select name="campoverifica">
            <?php if ($campoverifica == "pwd"){$selected = "selected=\"selected\""; } else {$selected = "";} ?>
            <option value="pwd" <?php echo $selected ?>>password</option>
            <?php if ($campoverifica == "birth_date"){$selected = "selected=\"selected\""; } else {$selected = "";} ?>
            <option value="birth_date" <?php echo $selected ?>>data di nascita</option>
            <?php if ($campoverifica == "mobile_phone"){$selected = "selected=\"selected\""; } else {$selected = "";} ?>
            <option value="mobile_phone" <?php echo $selected ?>>Mobile</option>
            <?php if ($campoverifica == "home_phone"){$selected = "selected=\"selected\""; } else {$selected = "";} ?>
            <option value="home_phone" >Telefono Fisso</option>
            <?php if ($campoverifica == "email"){$selected = "selected=\"selected\""; } else {$selected = "";} ?>
            <option value="email" >Indirizzo Email</option>
            </select>
            </td>
            <td><input type="submit" value="CERCA" class="mini" /></td>
        </tr></table></form>
    </td></tr>
    </table>

</div>
</td></tr></table>

<table width="95%" align="center"><tr><td>
<?php if ($counter > 0) { 
$sql = mysqli_query($query_sql, $admin) or die(mysql_error());
$csvsql = mysqli_query($query_sql, $admin) or die(mysql_error());
$tot_campi = mysql_num_fields($csvsql); 
for($i = 0; $i < $tot_campi; $i++ ) { 
    $csv .= '"'.mysql_field_name($csvsql,$i).'";'; 
} 
     
$csv .= "\n"; 
while($row = mysql_fetch_row($csvsql)){ 
             
    foreach($row as $value) { 
             
        $csv .= '"'.$value.'";'; 
    } 
             
    $csv .= "\n"; 
} 

$numris = -1; ?>
<div id="bluebox"><div class="title">Trovati <?php echo $counter ?> utenti potenzialmente duplicati</div>
  <table width="98%" border="1" align="center">
    <tr>
    <td align="center" width="5%">USER ID</td>
    <td align="center">PASSWORD</td>
    <td align="center">DATA NASCITA</td>
    <td align="center" width="3%">TEL</td>
    <td align="center" width="3%">MOBILE</td>
    <td align="center" width="5%">ULTIMA ATTIVIT&Agrave;</td>
    <td>&nbsp;</td></tr>
<?php 
do {
$numris = ++$numris;
if ($numris >= 1) {include('tools_search_row.php'); } ?>

<?php } while ($user = mysqli_fetch_assoc($sql)); ?>
 <tr><td colspan="7" align="center">
  <form action="csv.php" method="post" target="_blank">
<input type="hidden" name="csv" value="<?php echo htmlspecialchars($csv) ?>" />
<input type="hidden" name="filename" value="duplicate_list" />
<input type="image" value="submit" src="img/CSV.gif" />
</form></td></tr>
  </table></div>
<?php } else { 
	if (!empty($searchtxt)) {?>
    <div id="bluebox"><div class="title">Nessun duplicato trovato"</div></div>
    <?php }
}?>

</td></tr></table>
<?php 
if (!isset($coldx)) {
require_once('inc_col_dx.php');
}
require_once('inc_footer.php'); 
?>