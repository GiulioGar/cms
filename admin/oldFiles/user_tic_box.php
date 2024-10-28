<?php 
mysqli_select_db($database_admin, $admin);
$query_tic = "SELECT * FROM t_virtual_tickets as t  WHERE t.user_id = '$user_id' ORDER BY t.id DESC ";
$tic = mysqli_query($query_tic, $admin) or die(mysql_error());
$row_tic = mysqli_fetch_assoc($tic);
$total_tic = mysql_num_rows($tic);
?>
<div class="sez2">
<div class="title"><?php echo $total_tic ?> TICKET</div>
<?php if ( $total_tic > 0) { ?>
<table class="insez" width="88%"><tr>
<td class="insez">ID</td>
<td class="insez">Codice</td>
<td class="insez">Comprato</td>       
<td class="insez">Status</td>
</tr>
<?php do {
	include('tic_buy_row_user.php');
} while ($row_tic = mysqli_fetch_assoc($tic));

?> 


<form action="user.php?&user_id=<?php echo $user_id; ?>" method="post">
<tr><td colspan="4" class='insez'><input type="submit" name="azione" value="INVALIDA" style="width:95%" /></td></tr>
</form>

<form action="assegna_ticket.php?&user_id=<?php echo $user_id; ?>" method="post">
<tr><td colspan="4" class='insez'><input type="submit" name="azione" value="ASSEGNA TICKET" style="width:95%" /></td></tr>
</form>


</table>
<?php } 


else {?>
Nessun ticket acquistato
<?php } ?>
</div>