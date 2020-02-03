
<script src="js/jquery-1.9.1.min.js"></script>
<script src="js/jquery.PrintArea.js"></script>



<?php 

if (empty($azione)) { 

mysqli_select_db($database_admin, $admin);

$query_con = "SELECT * FROM t_concorso as t  WHERE t.status_v=1";
$con = mysqli_query($query_con, $admin) or die(mysql_error());
$ccs=$row_con['id']-1;

$query_last="SELECT v.user_id as user,u.user_id, u.email as email, v.code as code, v.concorso FROM t_user_win as v, t_user_info as u WHERE v.concorso=$ccs AND u.user_id=v.user_id and v.end_date>'2013' ORDER BY premio ASC LIMIT 5";
mysqli_select_db($database_admin, $admin);
$res2 = mysqli_query($query_last, $admin) or die(mysql_error());
$tot_win = mysql_num_rows($res2);

?>


<div class="sez2">

<table width="100%">
<tr>
<td width="45%">
<div class="title">NUOVA ESTRAZIONE</div>

<form action="admin_ticket.php" method="get">
<input type="hidden" name="azione" value="estrai" />
Premi da sorteggiare:<input name="np" size="2" type="input" value="5" />
<input type="submit" value="VAI" style="width:10%"/>
</form>
</td>

<td align="center" width="55%">

<div class="title">ULTIMA ESTRAZIONE</div>
<table align="center" class="insez">


<?php 
if ($tot_win>0)
{
?>

<table align="center" class="insez">
<tr>
<td class="insez">&nbsp;</td>
<td class="insez">Id utente</td>
<td class="insez">Email</td>       
<td class="insez">Codice Ticket</td>
</tr>


<?php
$um=0;

while($row=mysqli_fetch_assoc($res2))
		{
		$um++;
		
		echo "<tr>";
		echo "<td class='insez'>".$um."&deg;</td>";
		echo "<td class='insez'><a href=\"user.php?user_id=".$row['user']."\" style=\"color:#00C; text-decoration:underline \" target='_blank'>".$row['user']."</a></td>";
		echo "<td class='insez'>".htmlspecialchars($row['email'])."</td>";
		echo "<td class='insez' style='color:red; font-weight:bold;'>".htmlspecialchars($row['code'])."</td>";
		echo "</tr>";
		
		}

}


else 
{
echo "<table>";
echo "<tr>";
echo "<td width='100%' boreder='0' align='center'>&nbsp;</td>";
echo "</tr>";
}


?>



</table>

</td>

</tr>
</table>

</div>

<?php } 

else {

$query_rand = "SELECT u.user_id as user , u.email as email, u.first_name as name, u.province_id as proid, u.address as address, u.city as city,u.code as cap, u.second_name as name2,
 t.code as code, t.received_on as buy, t.id as id_tic, t.user_id as usertic, t.valid  FROM t_virtual_tickets as t, t_concorso as c, t_user_info as u 
 WHERE LENGTH(address)>10 AND c.status_v=1 AND t.received_on <= c.end_date AND t.received_on >= c.start_date AND u.user_id=t.user_id AND t.valid='1' ORDER BY RAND() LIMIT 0,$np";
mysqli_select_db($database_admin, $admin);
$res = mysqli_query($query_rand, $admin) or die(mysql_error());
?>

<div align="left" class="sez2">

<div id="stamp">
<div class="title"> VINCITORI CONCORSO</div>
<table cellpadding="3" class="insez">

    <tr>
<td class="insez">&nbsp;</td>
<td class="insez">Id utente</td>
<td class="insez">Nome</td>
<td class="insez">Cognome</td>
<td class="insez">Email</td>       
<td class="insez">Codice Ticket</td>
<td class="insez">Indirizzo</td>
    </tr>

<?php
$nm=0;

mysqli_select_db($database_admin, $admin);

while($row=mysqli_fetch_assoc($res))
{
$nm++;

include('tic_estrai_row.php');

$us=$row['user'];
$cd=$row['code'];
$cc=$row_con['id'];
$yr=date_format($data_finale, 'Y');

$insertSQL = "INSERT INTO t_user_win (user_id,code,concorso,end_date,premio) VALUES ('$us','$cd','$cc','$yr','$nm')";
$query=@mysqli_query($insertSQL) or die (mysql_error());

$upSQL = "UPDATE t_virtual_tickets SET valid=3 WHERE code='$cd'";
$query2=@mysqli_query($upSQL) or die (mysql_error());
}


?>


</table>



</div>

<div><a href="#" class="print" rel="stamp"><img src="img/print.gif"/></a></div>


</div>





<div align="left" style="margin-bottom:5px;">
<form action="admin_ticket.php" method="get">
<input type="hidden" name="nm" value="<?php echo $nm; ?>" />
<input type="submit" name="sub_azione" value="conferma" style="width:10%"/>
<input type="submit" name="sub_azione" value="ripeti" style="width:10%"/>

</form>



<?php

}
?>


</div>


<script type="text/javascript">

$(function() {


 $('.print').click(function() {


 var container = $(this).attr('rel');


 $('#' + container).printArea();


 return false;

 });

});

</script>