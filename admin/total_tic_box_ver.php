<?php 

mysqli_select_db($database_admin, $admin);
$query_tic = "SELECT u.user_id as user , u.email as email, t.code as code, t.received_on as buy, t.id as id_tic, t.user_id as usertic, t.valid, COUNT(t.user_id) as tot FROM t_virtual_tickets as t, t_concorso as c, t_user_info as u  WHERE c.status_v='1' AND t.received_on <= c.end_date AND t.received_on >= c.start_date AND u.user_id=t.user_id AND t.valid=1 GROUP BY t.user_id ORDER BY tot DESC";
$tic = mysqli_query($query_tic, $admin) or die(mysql_error());
$row_tic = mysqli_fetch_assoc($tic);
$total_tic = mysql_num_rows($tic);

?>

<div class="sez2">
<div align="right" style="font-size:x-small"><a href="admin_ticket.php">X CHIUDI</a></div>
<div class="title"> TICKET DA VERIFICARE: </div>
<?php if ( $total_tic > 0) { ?>
<table class="insez" width="88%"><tr>
<td class="insez">User Id</td>
<td class="insez">E mail</td>
<td class="insez">Ticket aquistati:</td>
</tr>
<?php 



do {
if($row_tic['tot'] >$ct)
{
	include('tic_buy_row_ver.php');
}

} 


while ($row_tic = mysqli_fetch_assoc($tic));


?>    
</table>

<?php }


else {?>
Non ci sono ticket da verificare!
<?php } ?>


</div>