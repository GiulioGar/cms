<?php
	echo "<tr><td align=\"center\">".$user['user_id']."</td>";
	echo "<td align=\"left\">".htmlentities(ucfirst(strtolower($user['first_name'])))."</td>";
	echo "<td align=\"left\">".htmlentities(ucfirst(strtolower($user['second_name'])))."</td>";
	echo "<td align=\"center\">".$user['score']."</td>";
	echo "<td align=\"center\">".$user['last_update']."</td>";
	echo "<td><form action=\"user.php\" method=\"get\">";
	echo "<input type=\"hidden\" name=\"user_id\" value=\"".$user['user_id']."\" />";
	echo "<input type=\"submit\" value=\"VAI\" style=\"width:100%\" />";
	echo "</form></td>";
	echo "</tr>";
?>