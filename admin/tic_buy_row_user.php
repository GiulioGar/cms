<?php 
$mydate=$row_tic['received_on'];
$comp=date("d-m-Y H:m",strtotime($mydate));

if (@$modifica == "1" && @$azione == "m_tic") 
        { 
echo "<tr style=\"background-color:#".reqTikColor($row_tic['valid'])."\">";
echo "<td class='insez'>".$row_tic['id']."</td>";
echo "<td class='insez'>".htmlspecialchars($row_tic['code'])."</td>";
echo "<td class='insez'>".$comp."</td>";
?>
<td  class='insez'>
<form action="user.php" method="post">
<select name="valid">
<option value="<?php echo $row_tic['valid']; ?>" selected="selected"><?php echo reqTikView($row_tic['valid'])?></option>
<option  value=0>Invalido</option>
<option value=1>Valido</option>
</select>
<input type="hidden" name="id" value="<?php echo $row_tic['id']; ?>" />
</td>

<td align="right">
		<input type="hidden" name="azione" value="t_modificato" />
        <input type="hidden" name="user_id" value="<?php echo $row_user['user_id']; ?>" />
        <input type="submit" value="MODIFICA" style="width:100%" />
        </form>
</td> 


<?php 
echo "</tr>";

}

else 
{
echo "<tr style=\"background-color:#".reqTikColor($row_tic['valid'])."\">";
echo "<td class='insez'>".$row_tic['id']."</td>";
echo "<td class='insez'>".htmlspecialchars($row_tic['code'])."</td>";
echo "<td class='insez'>".$comp."</td>";
echo "<td class='insez'>".reqTikView($row_tic['valid'])."</td>";
?>

<td align="right">
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="get">
        <input type="hidden" name="azione" value="m_tic" />
        <input type="hidden" name="user_id" value="<?php echo $row_user['user_id']; ?>" />
        <input type="submit" value="MODIFICA" style="width:100%" />
        </form>
</td> 


<?php 

echo "</tr>";

}

?>