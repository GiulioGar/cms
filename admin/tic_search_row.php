<?php
$volt=$volt+1;

echo "<tr style=\"background-color:#".reqTikColor($user['valid'])."\">";
echo "<td class='insez'><a href=\"user.php?user_id=".$user['user']."\" style=\"color:#00C; text-decoration:underline\" >".$user['user']."</a></td>";
echo "<td class='insez'>".$user['email']."</td>";
echo "<td class='insez'>".$user['id_tic']."</td>";
echo "<td class='insez'>".htmlspecialchars($user['code'])."</td>";
echo "<td class='insez'>".$user['buy']."</td>";
echo "<td class='insez'>".reqTikView($user['valid'])."</td>";
echo"<form action=\"admin_ticket.php?searchtxt=". $searchtxt."&dettagli=search\" method=\"post\">";
echo "<input type=\"hidden\" name=\"id\" value=\"".$user['id_tic']."\" />";
echo "<input type=\"hidden\" name=\"searchtxt\" value=\"".$searchtxt."\" />";
echo "<input type=\"hidden\" name=\"valid\" value=\"0\" />";
echo "<input type=\"hidden\" name=\"azione\" value=\"invalid_row\" />";
echo "<td class='insez'><input type=\"submit\" name=\"click\" value=\"ANNULLA\" style=\"width:95%\"/></td>";
echo"</form>";
?>