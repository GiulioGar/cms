<?php 
$mydate=$row_tic['buy'];
$comp=date("d-m-Y",strtotime($mydate));


echo "<tr style=\"background-color:#".reqTikColor($row_tic['valid'])."\">";
echo "<td class='insez'><a href=\"user.php?user_id=".$row_tic['user']."\" target='_blank' style=\"color:#00C; text-decoration:underline\" >".$row_tic['user']."</a></td>";
echo "<td class='insez'>".$row_tic['email']."</td>";
echo "<td class='insez'><b>".$row_tic['tot']."</b></td>";
echo "</tr>";

?>