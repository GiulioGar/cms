<?php
	echo "<tr><td align=\"center\">".$user['user_id']."</td>";
	echo "<td align=\"left\">".$user['password']."</td>";
	echo "<td align=\"left\">".$user['data_nascita']."</td>";
	echo "<td align=\"center\">".$user['telefono_fisso']."</td>";
	echo "<td align=\"center\">".$user['cellulare']."</td>";
	echo "<td align=\"center\">".$user['last_update']."</td>";
	echo "<td><form action=\"user.php\" method=\"get\">";
	echo "<input type=\"hidden\" name=\"user_id\" value=\"".$user['user_id']."\" />";
	echo "<input type=\"submit\" value=\"VAI\" style=\"width:100%\" />";
	echo "</form></td>";
	echo "</tr>";
?>