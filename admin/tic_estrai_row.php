<?php

	echo "<tr>";
	echo "<td class='insez'>".$nm."&deg;</td>";
	echo "<td class='insez'><a href=\"user.php?user_id=".$row['user']."\" style=\"color:#00C; text-decoration:underline \" target='_blank'>".$row['user']."</a></td>";
	echo "<td class='insez'>".htmlspecialchars($row['name'])."</td>";
	echo "<td class='insez'>".htmlspecialchars($row['name2'])."</td>";
	echo "<td class='insez'>".htmlspecialchars($row['email'])."</td>";
	echo "<td class='insez' style='color:red; font-weight:bold;'>".htmlspecialchars($row['code'])."</td>";
		echo "<td class='insez'>".htmlspecialchars($row['address'])."<br/>".htmlspecialchars($row['city'])." (".convert_array($province_id,$row['proid']).")<br/>".htmlspecialchars($row['cap'])."</td>";
	echo "</tr>";
?>
