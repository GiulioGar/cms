<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 

$sitowebdiriferimento = 'www.millebytes.com';
$titolo = 'Gestione CRM';
$areapagina = "crm";
$coldx = "no";

if (empty($_REQUEST['orderby'])) {
$orderby = "str_to_date(date_update,'%d-%m-%Y')"; 
} else { 
	if ($_REQUEST['orderby'] == "date_update") {
	$orderby = "str_to_date(date_update,'%d-%m-%Y')"; }
	else {
	$orderby = $_REQUEST['orderby'];}
}

$orderord = "DESC";
if (!empty($_REQUEST['orderord'])) {
$orderord = $_REQUEST['orderord']; }

$searchfor = $_REQUEST['searchfor'];
$searchtxt = mysql_real_escape_string($_REQUEST['searchtxt']);
$limit = $_REQUEST['limit'];

if ($searchfor == "text") {
	$searchfor = "r.crm_id = '$searchtxt' OR user_id LIKE '%$searchtxt%' OR date_update LIKE '%$searchtxt%' OR text LIKE '%$searchtxt%' OR s.description LIKE '%$searchtxt%'";
}
else
{
	switch ($searchfor) { 
		case "user_id":
		$searchfor = "r.user_id = '$searchtxt'";
		break;
		case "crm_id":
		$searchfor = "r.crm_id = '$searchtxt'";
		break;
		

	}
}

if (!empty($searchtxt)) {
mysqli_select_db($database_admin, $admin);
$query_sql = "SELECT r.crm_id as crm_id, r.user_id as user_id, r.date_update as date_update, o.description as object_id, m.text as text, s.description as status_id FROM t_crm as r, t_crm_status as s, t_crm_objects as o, t_crm_messages as m WHERE r.crm_id = m.crm_id AND r.object_id = o.object_id AND r.status_id = s.status_id AND ($searchfor) ORDER BY ".$orderby." ".$orderord;
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
    <form action="ticket_new.php" method="post">
    <input type="submit" value="CREA NUOVO TICKET" style="width:100%" />
    </form>
    </td>
	<td width="2%">&nbsp;</td>
	<td>
    	<div class="title">Cerca Ticket</div><form method="get" action="crm_search.php">
        <table align="center"><tr>
            
            <td>ID<input type="radio" value="crm_id" name="searchfor" /></td>
            <td>User id<input type="radio" name="searchfor" value="user_id" /></td>
            <td>Testo<input type="radio" checked="checked" name="searchfor" value="text" style="width:100%" /></td>
        </tr><tr>
            <td>Mostra Risultati: <select name="limit">
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
<td><a href="?orderby=crm_id&orderord=<?php echo $orderord; ?>&searchfor=<?php echo $_REQUEST['searchfor']; ?>&searchtxt=<?php echo $_REQUEST['searchtxt']; ?>&limit=<?php echo $_REQUEST['limit']; ?>">ID</a></td>
<td><a href="?orderby=user_id&orderord=<?php echo $orderord; ?>&searchfor=<?php echo $_REQUEST['searchfor']; ?>&searchtxt=<?php echo $_REQUEST['searchtxt']; ?>&limit=<?php echo $_REQUEST['limit']; ?>">Utente</a></td>
<td><a href="?orderby=object_id&orderord=<?php echo $orderord; ?>&searchfor=<?php echo $_REQUEST['searchfor']; ?>&searchtxt=<?php echo $_REQUEST['searchtxt']; ?>&limit=<?php echo $_REQUEST['limit']; ?>">Oggetto</a></td>
<td><a href="?orderby=status_id&orderord=<?php echo $orderord; ?>&searchfor=<?php echo $_REQUEST['searchfor']; ?>&searchtxt=<?php echo $_REQUEST['searchtxt']; ?>&limit=<?php echo $_REQUEST['limit']; ?>">Stato</a></td>
<td><a href="?orderby=data_update&orderord=<?php echo $orderord ;?>&searchfor=<?php echo $_REQUEST['searchfor']; ?>&searchtxt=<?php echo $_REQUEST['searchtxt']; ?>&limit=<?php echo $_REQUEST['limit']; ?>">Data</a></td>
<td>&nbsp;</td></tr>
<?php 
do {
$numris = ++$numris;
if ($numris >= 1) {include('crm_search_row.php'); } ?>

<?php } while ($sql_row = mysqli_fetch_assoc($sql)); ?>
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