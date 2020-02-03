<?php
	echo "<tr>";
	echo "<td>".$sql_row['crm_id']."</td>";
	echo "<td><a href=\"user.php?user_id=".$sql_row['user_id']."\" style=\"color:#00C; text-decoration:underline\">".$sql_row['user_id']."</a></td>";
	echo "<td>".htmlspecialchars($sql_row['object_id'])."</td>";
	echo "<td>".htmlspecialchars($sql_row['status_id'])."</td>";
	echo "<td>".htmlspecialchars($sql_row['date_update'])."</td>";
	echo "<td><form action=\"crm_richiesta.php\" method=\"get\">";
	echo "<input type=\"hidden\" name=\"crm_id\" value=\"".$sql_row['crm_id']."\" />";
	echo "<input type=\"submit\" value=\"VAI\" style=\"width:95%\"/></form></td>";
	echo "</tr>";
?>
