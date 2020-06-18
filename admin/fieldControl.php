
<?php
$data=date("Y-m-d");
$contaField=0;

mysqli_select_db($admin,$database_admin);
$query_ricerche = "SELECT * FROM t_panel_control where stato=0 order by stato,giorni_rimanenti ASC,id DESC";
$tot_attive = mysqli_query($admin,$query_ricerche) or die(mysql_error());

mysqli_select_db($admin,$database_admin);
$query_ricerche = "SELECT * FROM t_panel_control where stato=1 and panel=1 order by id DESC ";
$tot_inattive = mysqli_query($admin,$query_ricerche) or die(mysql_error());

	
$query_conta = "SELECT COUNT(sur_id) as tot  FROM t_panel_control where stato=0";
$surOp = mysqli_query($admin,$query_conta) or die(mysql_error());
$opSur = mysqli_fetch_assoc($surOp);


echo "<table class='table table-bordered'>";
echo "<thead class='thead-light'>";
echo "<tr style='font-weight:bold'>";	
echo "<th scope='col'>ID</th>";
echo "<th scope='col'>Info</th>";
echo "<th scope='col'>Andamento</th>";
echo "<th scope='col'>Panel</th>";
echo "<th scope='col'>Stato</th>";

echo "</tr></thead>";


while ($row = mysqli_fetch_assoc($tot_attive))
{

if ($row['stato']==0){$stato="Aperta";  $colSat="#007F21";}
if ($row['stato']==1){$stato="Chiusa";  $colSat="#FF0400";}
if ($row['panel']==1){$panel="Millebytes";}
if ($row['panel']==0){$panel="Esterno";}
if ($row['panel']==2){$panel="Target";}
$obj=$row['complete']-$row['goal'];

$obiet=round($row['goal']); 

$progress=$row['complete']/$obiet*100;

$progress=round($progress); 

if ($progress>=100) {$progress=100;}


echo "<tbody><tr>";
echo "<td><a href='conta_locale.php?prj=".$row['prj']."&sid=".$row['sur_id']."'>".$row['sur_id']."</a><br></td>";
echo "<td>".$row['description']."</td>";
echo "<td> 
<div class='progress'> 
<div class='progress-bar progress-bar-striped progress-bar-animated bg-success' role='progressbar' aria-valuenow=".$progress." aria-valuemin='0' aria-valuemax='100' style='width:0%'>".$progress."%</div>
</div></td>";
echo "<td>".$panel."</td>";
echo "<td style='color:".$colSat."'>".$stato."</td>";
echo "</tr>";

$contaField++;

}


echo "</tbody></table>";






?>