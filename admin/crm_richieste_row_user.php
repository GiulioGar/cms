<?php
	echo "<tr style=\"background-color:#".reqColor($row_crm['status_id'])."\">";
	echo "<td class='insez'>".$row_crm['crm_id']."</td>";
	echo "<td class='insez'>".htmlspecialchars($row_crm['object_id'])."</td>";
	echo "<td class='insez'>".htmlspecialchars($row_crm['status_id'])."</td>";
	echo "<td class='insez'>".htmlspecialchars($row_crm['date_update'])."</td>";
	echo "<td class='insez'><form action=\"crm_richiesta.php\" method=\"get\">";
	echo "<input type=\"hidden\" name=\"crm_id\" value=\"".$row_crm['crm_id']."\" />";
	echo "<input type=\"submit\" value=\"VAI\" style=\"width:95%\"/></form></td>";
	echo "</tr>";
?>
