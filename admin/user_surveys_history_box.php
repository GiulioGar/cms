<style>
table.ric td {border:1px solid #AFB5BC;}
</style>


<?php 
mysqli_select_db($admin,$database_admin);
$query_crm = "SELECT * FROM millebytesdb.t_respint WHERE uid ='$user_id' ORDER BY sid DESC";
$crm = mysqli_query($admin,$query_crm) or die(mysqli_error());
$full_total_crm = mysqli_num_rows($crm);


?>
<?php if ($full_total_crm > 0) {?>
<table align="center"  class="ric" style="border:1px solid #AFB5BC; background:#EDEDED; width:90%" >
    <tr>
    <td  align="center" width="40%"><b>RICERCA</b></td>
    <td  align="center" width="30%"><b>PROGETTO</b></td>
    <td  align="center" width="30%"><b>STATUS</b></td>
    </tr>
	
	<?php 
		while ($row = mysqli_fetch_assoc($crm))
		{
			if ($row['status']==0) { $sta="INVITO";}
			if ($row['status']==1) { $sta="NON COMPLETATA";}
			if ($row['status']==3) { $sta="<b><span style='color:#3E935F'>COMPLETATA</span></b>";}
			if ($row['status']==4) { $sta="FILTRATA";}
			if ($row['status']==5) { $sta="QUOTA CHIUSA";}
			
			echo "<tr><td>".$row['sid']."</td><td>".$row['prj_name']."</td><td>".$sta."</td></tr>";
		}	
	?>
</table>
<?php } 
else {?>
Nessuna attivit&agrave; registrata
<?php } ?>
