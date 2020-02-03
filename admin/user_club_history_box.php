<style>
table.ric td {border:1px solid #AFB5BC;}
</style>


<?php 
mysqli_select_db($admin,$database_admin);
$query_story = "SELECT * FROM millebytesdb.t_user_history WHERE  user_id='$user_id' ORDER BY event_date DESC";
$story = mysqli_query($admin,$query_story) or die(mysql_error());
$full_total_story = mysqli_num_rows($story);

?>
<?php if ($full_total_story > 0) {?>
<table align="center"  class="ric" style="border:1px solid #AFB5BC; background:#EDEDED; width:90%" >
    <tr>
    <td  align="center" width="30%"><b>GIORNO</b></td>
    <td  align="center" width="60%"><b>EVENTO</b></td>
    <td  align="center" width="10%"><b>LIVELLO</b></td>
    </tr>
	
	<?php 
		while ($row = mysqli_fetch_assoc($story))
		{
			if ($row['event_info']=="User has been canceled") { $event="CANCELLAZIONE";}
			if (strstr($row['event_info'],"Buono")) { $event="RICHIESTA PREMIO";}
			if ($row['event_info']=="Interview complete") { $event="RICERCA COMPLETATA"; }
			if ($row['event_info']=="New user has been created") { $event="NUOVO CONCORSO";}
			if ($row['event_info']=="bonus") { $event="BONUS";}
			
			

			
			echo "<tr><td>".$row['event_date']."</td><td>".$event."</td><td>".$row['new_level']."</td></tr>";
		}	
	?>
</table>
<?php } 
else {?>
Nessuna attivit&agrave; registrata
<?php } ?>