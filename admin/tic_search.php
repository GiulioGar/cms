<div class="sez2">
<div align="right" style="font-size:x-small"><a href="admin_ticket.php">X CHIUDI</a></div>
<?php

@$searchtxt = mysql_real_escape_string($_REQUEST['searchtxt']);


if (!empty($searchtxt)) {
mysqli_select_db($database_admin, $admin);
$query_sql = "SELECT u.user_id as user , u.email as email, t.code as code, t.received_on as buy, t.id as id_tic, t.user_id as usertic, t.valid  FROM t_virtual_tickets as t, t_concorso as c, t_user_info as u WHERE u.email LIKE '%$searchtxt%' AND c.status_v=1 AND t.received_on <= c.end_date AND u.user_id=t.user_id AND t.valid='1' ORDER BY t.id DESC";
$sql = mysqli_query($query_sql, $admin) or die(mysql_error());
$counter = mysql_num_rows($sql);
}
else {
	$counter = 0;
}
?>

<table class="insez"><tr><td>
<?php if ($counter > 0) { 
$sql = mysqli_query($query_sql, $admin) or die(mysql_error());
$numris = -1; ?>
<div ><div class="title">Trovati <?php echo $counter ?> risultati per "<?php echo stripslashes($searchtxt) ?>":</div>
  <table class="insez">
    <tr>
<td class="insez">User Id</td>
<td class="insez">E mail</td>
<td class="insez">Id ticket</td>
<td class="insez">Codice</td>
<td class="insez">Comprato</td>       
<td class="insez">Status</td>
    </tr>

<?php 

do {
$numris = ++$numris;
if ($numris >= 1) {include('tic_search_row.php'); } 
?>
<?php } while ($user = mysqli_fetch_assoc($sql)); ?>

<tr>
<td colpsan="6" >
<div align="left">
<form action="admin_ticket.php" method="post">
<input type="hidden" name="azione" value="invalid_all" />
<input type="hidden" name="searchtxt" value="<?php echo $searchtxt;?>" />
<input type="submit" value="ANNULLA TUTTI" style="width:100%"/>
</form>
</div>
</td>
</tr>

  </table></div>
<?php } 

else { 
	if (!empty($searchtxt)) {?>
 <div class="title">Trovati <?php echo $counter ?> risultati per "<?php echo stripslashes($searchtxt) ?>":</div>
<div >Nessun risultato per "<?php echo stripslashes($searchtxt) ?>"</div>
    <?php }
}

?>

</td></tr></table>
</div>