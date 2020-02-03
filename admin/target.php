<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 
	  
	  
	  mysqli_select_db($database_admin, $admin);
	  $query_ric = "SELECT * FROM ElencoTag";
	  $tot_targ = mysqli_query($query_ric, $admin) or die(mysql_error());
	

	
		
	  ?>
	  
<form name="modulo" action="elabora_form.php" method="post">
<table>
	
	<tr>
		<td>Target:</td>
		<td>
			<select name="articolo">
			<?php
			while ($row = mysqli_fetch_assoc($tot_targ))
			{
			?>
		    <option value="art1"><?php echo $row['tag'];?></option>
			<?php
			}
			?>
				
			</select>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center"><input type="submit" value="Invia email"></td>
	</tr>
</table>
</form>