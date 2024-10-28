<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 

$sitowebdiriferimento = 'www.millebytes.com';
$titolo = 'Gestione Utenti';
$areapagina = "iscritti";
$coldx = "no";

if (empty($_REQUEST['orderby'])) {
	$orderby = "str_to_date(last_update,'%d/%m/%Y')"; 
} else { 
	switch ($_REQUEST['orderby']) {
	case "last_update": 
	$orderby = "str_to_date(last_update,'%d/%m/%Y')"; 
	break;
	
	default:
	$orderby = $_REQUEST['orderby'];}
}


$orderord = "DESC";
if (!empty($_REQUEST['orderord'])) {
$orderord = $_REQUEST['orderord']; }


$searchfor = $_REQUEST['searchfor'];
$searchtxt = mysql_real_escape_string($_REQUEST['searchtxt']);
$limit = $_REQUEST['limit'];

if ($searchfor == "text") {
	$searchfor = "first_name LIKE '%$searchtxt%' OR second_name LIKE '%$searchtxt%' OR home_phone LIKE '%$searchtxt%' OR mobile_phone LIKE '%$searchtxt%' OR email LIKE '%$searchtxt%' OR t.user_id = '$searchtxt'";
}
else
{
	switch ($searchfor) { 
		case "user_id":
		$searchfor = "t.$searchfor = '$searchtxt'";
		break;
		case "second_name":
		$searchfor = "first_name LIKE '%$searchtxt%' OR second_name LIKE '%$searchtxt%'";
		break;
		case "email":
		$searchfor = "$searchfor LIKE '%$searchtxt%'";
		break;
	}
}

if (!empty($searchtxt)) {
mysqli_select_db($database_admin, $admin);
$query_sql = "SELECT t.user_id as user_id, t.first_name as first_name, t.second_name as second_name, s.last_update as last_update, s.score as score, s.user_id as suser_id FROM t_user_info as t, t_user_stats as s WHERE t.user_id = s.user_id AND ($searchfor) ORDER BY $orderby $orderord LIMIT $limit";
$sql = mysqli_query($query_sql, $admin) or die(mysql_error());
$counter = mysql_num_rows($sql);
}
else {
	$counter = 0;
}
if ($orderord == "DESC") {
	$orderord = "ASC"; }
else {
	$orderord = "DESC"; }

require_once('inc_taghead.php');

require_once('inc_tagbody.php'); 
?>
<table width="90%" align="center">
<tr><td>
<div id="bluebox">

    <table width="100%"><tr>
    <td width="30%">
    <form action="user_new.php" method="post">
    <input type="submit" value="CREA NUOVO ISCRITTO" style="width:100%" />
    </form>
    </td>
	<td width="2%">&nbsp;</td>
	<td>
    	<div class="title">Cerca Iscritto</div><form method="get" action="search_user.php">
        <table align="center"><tr>
            
            <td>ID<input type="radio" value="user_id" name="searchfor" /></td>
            <td>Nome/Cognome<input type="radio" name="searchfor" value="second_name" /></td>
            <td>Email<input type="radio" name="searchfor" value="email" /></label></td>
            <td>Testo<input type="radio" checked="checked" name="searchfor" value="text" style="width:100%" /></td>
        </tr><tr>
            <td colspan="2">Mostra Risultati: <select name="limit">
            <option value="10">10 per pagina</option>
            <option value="50">50 per pagina</option>
            <option value="100" selected="selected">100 per pagina</option>
            <option value="500">500 per pagina</option>
            <option value="1000">tutti</option>
            </select></td>
            <td><input type="text" name="searchtxt" /></td>
            <td><input type="submit" value="CERCA" class="mini" /></td>
        </tr></table></form>
    </td></tr>
    </table>

</div>
</td></tr></table>

<table width="95%" align="center"><tr><td>
<?php if ($counter > 0) { 
$sql = mysqli_query($query_sql, $admin) or die(mysql_error());
$numris = -1; ?>
<div id="bluebox"><div class="title">Trovati <?php echo $counter ?> risultati per "<?php echo stripslashes($searchtxt) ?>":</div>
  <table width="98%" border="1" align="center">
    <tr>
    <td align="center" width="5%"><a href="?orderby=user_id&orderord=<?php echo $orderord; ?>&searchfor=<?php echo $searchfor; ?>&searchtxt=<?php echo $_REQUEST['searchtxt']; ?>&limit=<?php echo $_REQUEST['limit']; ?>">USER ID</a></td>
    <td align="center"><a href="?orderby=first_name&orderord=<?php echo $orderord; ?>&searchfor=<?php echo $_REQUEST['searchfor']; ?>&searchtxt=<?php echo $_REQUEST['searchtxt']; ?>&limit=<?php echo $_REQUEST['limit']; ?>">NOME</a></td>
    <td align="center"><a href="?orderby=second_name&orderord=<?php echo $orderord; ?>&searchfor=<?php echo $_REQUEST['searchfor']; ?>&searchtxt=<?php echo $_REQUEST['searchtxt']; ?>&limit=<?php echo $_REQUEST['limit']; ?>">COGNOME</a></td>
    <td align="center" width="3%"><a href="?orderby=score&orderord=<?php echo $orderord; ?>&searchfor=<?php echo $_REQUEST['searchfor']; ?>&searchtxt=<?php echo $_REQUEST['searchtxt']; ?>&limit=<?php echo $_REQUEST['limit']; ?>">PUNTI</a></td>
    <td align="center" width="5%"><a href="?orderby=last_update&orderord=<?php echo $orderord; ?>&searchfor=<?php echo $_REQUEST['searchfor']; ?>&searchtxt=<?php echo $_REQUEST['searchtxt']; ?>&limit=<?php echo $_REQUEST['limit']; ?>">ULTIMA ATTIVIT&Agrave;</a></td>
    <td>&nbsp;</td></tr>
<?php 
do {
$numris = ++$numris;
if ($numris >= 1) {include('search_user_row.php'); } ?>

<?php } while ($user = mysqli_fetch_assoc($sql)); ?>
  </table></div>
<?php } else { 
	if (!empty($searchtxt)) {?>
    <div id="bluebox"><div class="title">Nessun risultato per "<?php echo stripslashes($searchtxt) ?>"</div></div>
    <?php }
}?>

</td></tr></table>
<?php 
if (!isset($coldx)) {
require_once('inc_col_dx.php');
}
require_once('inc_footer.php'); 
?>