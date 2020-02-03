<?php

$stringa=$row_crm['date_update'];
list($dat, $or) = split(' ', $stringa);
list($gg,$mm,$yy) = split('-', $dat);
list($hh,$min,$sc) = split(':', $or);
$nh=$hh-0;
$timestamp = mktime($nh, $min, $sc, $mm, $gg, $yy);
$nuova_data = date("d/M/Y H:i", $timestamp);

	echo "<tr style=\"background-color:#".reqColor($row_crm['status_id'])."\">";
	echo "<td>".$row_crm['crm_id']."</td>";
	echo "<td><a href=\"user.php?user_id=".$row_crm['user_id']."\" style=\"color:#00C; text-decoration:underline\">".$row_crm['user_id']."</a></td>";
	echo "<td>".htmlspecialchars($row_crm['object_id'])."</td>";
	echo "<td>".htmlspecialchars($row_crm['status_id'])."</td>";
	echo "<td>".$nuova_data."</td>";
	echo "<td><form action=\"crm_richiesta.php\" method=\"get\">";
	echo "<input type=\"hidden\" name=\"crm_id\" value=\"".$row_crm['crm_id']."\" />";
	echo "<input type=\"submit\" value=\"VAI\" style=\"width:95%\"/></form></td>";
	echo "</tr>";
?>
