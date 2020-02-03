<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 
$titolo = 'Gestione CRM';
$sitowebdiriferimento = 'www.millebytes.com'; 
$areapagina = "crm";
$coldx = "no";

if (empty($_REQUEST['orderby'])) {
$orderby = "str_to_date(date_update,'%d-%m-%Y %H:%i:%s')"; 
} else { 
	if ($_REQUEST['orderby'] == "date_update") {
	$orderby = "str_to_date(date_update,'%d-%m-%Y %H:%i:%s')"; }
	else {
	$orderby = $_REQUEST['orderby'];}
}

$orderord = "DESC";
if (!empty($_REQUEST['orderord'])) {
$orderord = $_REQUEST['orderord']; }

mysqli_select_db($database_admin, $admin);
$query_crm = "SELECT r.crm_id as crm_id, r.user_id as user_id, r.date_update as date_update, o.description as object_id,  s.description as status_id FROM t_crm as r, t_crm_status as s, t_crm_objects as o WHERE r.status_id = s.status_id AND r.object_id = o.object_id AND r.status_id = '3' ORDER BY ".$orderby." ".$orderord;
$crm = mysqli_query($query_crm, $admin) or die(mysql_error());
$row_crm = mysqli_fetch_assoc($crm);
$total_crm = mysql_num_rows($crm);

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
    <form action="crm_new.php" method="post">
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


<div id="bluebox">
<div class="title">RICHIESTE IN ATTESA</div>
<?php if ( $total_crm > 0) {?>
<table width="95%" border="1" align="center"><tr>
<td><a href="?orderby=crm_id&orderord=<?php echo $orderord; ?>">ID</a></td><td><a href="?orderby=user_id&orderord=<?php echo $orderord; ?>">Utente</a></td><td><a href="?orderby=object_id&orderord=<?php echo $orderord; ?>">Oggetto</a></td><td><a href="?orderby=status_id&orderord=<?php echo $orderord; ?>">Stato</a></td><td><a href="?orderby=date_update&orderord=<?php echo $orderord ;?>">Data</a></td><td>&nbsp;</td></tr>
<?php do {
	require('crm_richieste_row.php');
} while ($row_crm = mysqli_fetch_assoc($crm));
?>
</table>
<?php } 
else {?>
Nessuna richiesta in attesa
<?php } ?>
</div>
 

<?php 
if (!isset($coldx)) {
require_once('inc_col_dx.php');
}
require_once('inc_footer.php'); 
?>