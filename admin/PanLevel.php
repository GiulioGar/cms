<div style="margin-bottom:10px;" class="title">INFO LIVELLI</div>
<div style="margin-left:10px;">

<table width="40%" class='tabdat'>
        <tr><th colspan="3" align="center">STATO LIVELLI</th></tr>
		<tr class='intesta'> <th>Livello </th><th>Utenti</th><th>&nbsp;</th></tr>

<?php	  
mysqli_select_db($database_admin, $admin);


$pre=0;

for ($i = 1; $i < 41; $i++) 
	{
	if ($i==5 || $i==10 || $i==15 || $i==20 || $i==30 || $i==40)
		{		
	
		$query_m2 = "SELECT count(*) as total FROM field_data_field_user_level WHERE field_user_level_value>$pre AND field_user_level_value<=$i";
		$m2_close = mysqli_query($query_m2, $admin) or die(mysql_error());
		$tot_lev = mysqli_fetch_assoc($m2_close);
		
		$totLev=$tot_lev['total'];
		
		if($i==5) {$fin="0-5";}
		if($i==10) {$fin="6-10";}
		if($i==15) {$fin="11-15";}
		if($i==20) {$fin="16-20";}
		if($i==30) {$fin="21-30";}
		if($i==40) {$fin="31-40";}

				?>
				<form action="infoLevel.php" target="_blank" method="get">
				<input type="hidden" name="livello" value="<?php echo $i;?>" />
				<input type="hidden" name="prelivello" value="<?php echo $pre;?>" />
				
				
<?php	
				echo "<tr><td>".$fin."</td><td>".$totLev."</td><td><input type='submit' value='vedi'></td></tr></form>";
				$pre=$i;
				
			}
		
		}
		
		
?>
  </table>


</div>	