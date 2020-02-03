<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 

$sitowebdiriferimento = 'www.millebytes.com';
$titolo = 'Gestione Utenti';
$areapagina = "iscritti";
$coldx = "no";
 
@$s_gender = $_REQUEST['gender'];
@$s_work_id = $_REQUEST['work_id'];
@$s_instr_level_id = $_REQUEST['instr_level_id'];
@$s_mar_status_id = $_REQUEST['mar_status_id'];
@$s_province_id = $_REQUEST['province_id'];
@$filtropunti = $_REQUEST['filtropunti']; 
@$score = $_REQUEST['score'];
@$reg_date_from = $_REQUEST['reg_date_from'];
@$reg_date_to = $_REQUEST['reg_date_to'];
if (empty($reg_date_to)){$reg_date_to = date("d/m/Y");}
@$reg_date_fromstamp = convert_time($reg_date_from);
@$reg_date_tostamp = convert_time($reg_date_to);
@$last_update = $_REQUEST['last_update'];
@$last_updatestamp = convert_time($last_update);
@$filtroatt = $_REQUEST['filtroatt'];
@$year_surveys = $_REQUEST['year_surveys'];
@$filtrosurveys = $_REQUEST['filtrosurveys'];
@$orderbysel = $_REQUEST['orderbysel'];
@$azione = $_REQUEST['azione'];
if (!empty($s_gender)) { @$searchfor.=" AND (i.gender='$s_gender')"; }
if (!empty($s_work_id)) { @$searchfor.=" AND (i.work_id='$s_work_id')"; }
if (!empty($s_instr_level_id)) { @$searchfor.=" AND (i.instr_level_id='$_instr_level_id')"; }
if (!empty($s_mar_status_id)) { @$searchfor.=" AND (i.mar_status_id='$_mar_status_id')"; }
if (!empty($s_province_id)) { @$searchfor.=" AND (i.province_id='$s_province_id')"; }
//if (!empty($s_country)) { $searchfor.=" AND (i.country='$country')"; }
//if (!empty($score)) { @$searchfor.=" AND (s.score $filtropunti $score)"; }
if (!empty($year_surveys)) { @$searchfor.=" AND (s.year_surveys $filtrosurveys $year_surveys)"; }
if (!empty($last_update)) { @$searchfor.=" AND (STR_TO_DATE(s.last_update, '%d/%m/%Y') $filtroatt '$last_updatestamp')"; }
if (!empty($reg_date_from)) { @$searchfor.=" AND (STR_TO_DATE(i.reg_date, '%Y-%m-%d %H:%i:%s') between '".$reg_date_fromstamp."' AND '".$reg_date_tostamp."')"; }
if (empty($s_gender) && empty($s_work_id) && empty($s_instr_level_id) && empty($s_mar_status_id) && empty($s_province_id) && empty($s_country_id) && empty($score) && empty($year_surveys) && empty($last_update) && empty($reg_date_from)) { $searchfor = "fail" ;} 
switch ($orderbysel) {


		case "user_id":
		$orderby = "ORDER BY i.user_id";
		break;
		
		case "reg_date":
		$orderby = "ORDER BY str_to_date(i.reg_date,'%Y-%m-%d %H:%i:%s') DESC";
		break;
		
		case "last_update":
		default:
		$orderby = "ORDER BY str_to_date(s.last_update,'%d/%m/%Y') DESC";
		break;

}


if ( $azione ==  "ricerca" && $searchfor != "fail" ) {
mysqli_select_db($database_admin, $admin);
$query_full = "SELECT i.user_id as user_id, i.first_name as first_name, i.second_name as second_name, i.gender as gender_id, i.birth_date as birth_date, i.work_id as work_id, i.instr_level_id as instr_level_id, i.province_id as province_id, i.mar_status_id as mar_status_id, i.email as email,  s.year_surveys as year_surveys, s.last_update as last_update, i.reg_date as reg_date FROM t_user_info as i, t_user_stats as s WHERE i.user_id = s.user_id $searchfor $orderby";
$sql = mysqli_query($query_full, $admin) or die(mysql_error());
$counter = mysql_num_rows($sql);
$col = mysql_num_fields($sql);
$csvsql = mysqli_query($query_full, $admin) or die(mysql_error());
$tot_campi = mysql_num_fields($csvsql); 
for($i = 0; $i < $tot_campi; $i++ ) { 
    @$csv .= '"'.mysql_field_name($csvsql,$i).'";'; 
} 
     
$csv .= "\n"; 
         
while($row = mysql_fetch_row($csvsql)){ 
             
    foreach($row as $value) { 
             
        $csv .= '"'.$value.'";'; 
    } 
             
    $csv .= "\n"; 
} 

}
require_once('inc_taghead.php');

require_once('inc_tagbody.php'); 
?>
<form action="<?php $_SERVER['PHP_SELF']?>" method="get">
<table width="80%" align="center">
<tr><td colspan="2" align="center"><span class="title">RICERCA AVANZATA ISCRITTI</span></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<tr><td width="30%">
<div id="bluebox">
<table width="100%" align="left">
<tr><td width="30%">
Sesso:</td>
<td>
<select name="gender" style="width:95%"><?php echo select_options($gender,$s_gender) ?></select>
</td></tr>
<tr><td>
Occupazione:</td>
<td>
<select name="work_id" style="width:95%"><?php echo select_options($work_id,$s_work_id) ?></select>
</td></tr>
<tr><td>
Istruzione:</td>
<td>
<select name="instr_level_id" style="width:95%"><?php echo select_options($instr_level_id,$s_instr_level_id) ?></select>
</td></tr>
<tr><td>
S. Civile:</td>
<td>
<select name="mar_status_id" style="width:95%"><?php echo select_options($mar_status_id,$s_mar_status_id) ?></select>
</td></tr>
<tr><td>
Provincia:</td>
<td>
<select name="province_id" style="width:95%"><?php echo select_options($province_id,$s_province_id) ?></select>
</td></tr>
<?php /*?><tr><td>
Nazione:</td>
<td>
<select name="country_id" style="width:95%">
<option value="">-</option>
<?php echo select_options($country_id,$s_country_id) ?>
</select>
</td></tr><?php */?>
</table>

</div>
</td> <td>
<div id="bluebox">

<table width="100%" align="left"><tr>
<td>Punti: <select name="filtropunti" style="width:auto">
<?php if ($filtropunti == ">"){$selected = "selected=\"selected\""; } else {$selected = "";} ?>
  <option value="&gt;"<?php echo $selected ?>>&gt;</option>
<?php if ($filtropunti == "="){$selected = "selected=\"selected\""; } else {$selected = "";} ?>
  <option value="=" <?php echo $selected ?>>=</option>
<?php if ($filtropunti == "<"){$selected = "selected=\"selected\""; } else {$selected = "";} ?>
  <option value="&lt;"<?php echo $selected ?>>&lt;</option>
</select></td>
<td><input type="text" name="score" value="<?php echo $score ?>" style="width:auto" /></td>
</tr><tr>
<td>Iscrizione: dal <input type="text" name="reg_date_from" value="<?php echo $reg_date_from ?>" size="7" /></td>
<td align="left">al <input type="text" name="reg_date_to" value="<?php echo $reg_date_to ?>" size="7" /></td>
</tr><tr>
<td>Attivit&agrave;: <select name="filtroatt" style="width:auto">
  <?php if ($filtroatt == ">"){$selected = "selected=\"selected\""; } else {$selected = "";} ?>
  <option value=">"<?php echo $selected ?>>DOPO</option>
<?php if ($filtroatt == "="){$selected = "selected=\"selected\""; } else {$selected = "";} ?>
  <option value="=" <?php echo $selected ?>>=</option>
<?php if ($filtroatt == "<"){$selected = "selected=\"selected\""; } else {$selected = "";} ?>
  <option value="<"<?php echo $selected ?>>PRIMA</option>
</select></td>
<td><input type="text" name="last_update" value="<?php echo $last_update ?>" style="width:auto" /></td>
</tr></table>
</div>
</td>

</tr>
<tr>
<td align="left" colspan="2">ORDINA PER: <select name="orderbysel" style="width:60%">
  <?php if ($orderbysel == "user_id"){$selected = "selected=\"selected\""; } else {$selected = "";} ?>
  <option value="user_id" <?php echo $selected ?>>USER ID</option>
  <?php if ($orderbysel == "last_update"){$selected = "selected=\"selected\""; } else {$selected = "";} ?>
  <option value="last_update" <?php echo $selected ?>>Attivit&agrave;</option>
  <?php if ($orderbysel == "score"){$selected = "selected=\"selected\""; } else {$selected = "";} ?>
  <option value="score" <?php echo $selected ?>>Punti</option>
  <?php if ($orderbysel == "year_surveys"){$selected = "selected=\"selected\""; } else {$selected = "";} ?>
  <option value="year_surveys" <?php echo $selected ?>>Sondaggi</option>
  <?php if ($orderbysel == "reg_date"){$selected = "selected=\"selected\""; } else {$selected = "";} ?>
  <option value="reg_date" <?php echo $selected ?>>Data Iscrizione</option> 
</select>
<input type="hidden" name="azione" value="ricerca"  /> </td>
</tr>
<tr><td></td><td><input type="submit" value="CERCA" style="width:100%" /></td></tr></table>

</form>

<table width="95%" align="center">
<tr><td>
<?php if (@$counter > 0) { 
$sql = mysqli_query($query_full, $admin) or die(mysql_error());
$numris = -1; ?>
<div id="bluebox"><div class="title">Trovati <?php echo $counter ?> risultati </div>
  <table width="98%" border="1" align="center">
    <tr>
    <td align="center" width="5%">USER ID</td>
    <td align="center">NOME</td>
    <td align="center">COGNOME</td>
    <td align="center" width="3%">PUNTI</td>
    <td align="center" width="5%">ULTIMA ATTIVIT&Agrave;</td>
    <td>&nbsp;</td></tr>
<?php 
do {
$numris = ++$numris;
if ($numris >= 1) {
	include('user_search_row.php'); } ?>

<?php } 

while ($user = mysqli_fetch_assoc($sql)); ?>
  <tr><td colspan="7" align="center">
  <form action="csv.php" method="post" target="_blank">
<input type="hidden" name="csv" value="<?php echo htmlspecialchars($csv) ?>" />
<input type="hidden" name="filename" value="user_list" />
<input type="image" value="submit" src="img/CSV.gif" />
</form>


</td></tr>
  </table></div>
<?php } 


else { 
	if (@$counter <= 0) {?>
    <div id="bluebox"><div class="title">Nessun risultato per la ricerca effettuata.
    </div></div>
    <?php }
}?>

</td></tr></table>
<?php 
if (!isset($coldx)) {
require_once('inc_col_dx.php');
}
require_once('inc_footer.php'); 
?>