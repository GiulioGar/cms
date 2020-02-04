
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
echo "<th scope='col'>Giorni</th>";
echo "<th scope='col'>Compl.</th>";
echo "<th scope='col'>Durata</th>";
echo "<th scope='col'>N° Interv.</th>";
echo "<th scope='col'>Obiet.</th>";
echo "<th scope='col'>Cont.</th>";
echo "<th scope='col'>% Pan.</th>";
echo "<th scope='col'>% Ric.</th>";
echo "<th scope='col'>Abil.</th>";
echo "<th scope='col'>Sesso</th>";
echo "<th scope='col'>Età</th>";
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
if ($row['sex_target']==1){$sex="M";}
if ($row['sex_target']==2){$sex="F";}
if ($row['sex_target']==3){$sex="M-F";}
$today=substr($data,0,10);
$sur_date=substr($row['sur_date'],0,10);
$end_date=substr($row['end_field'],0,10);
if($end_date <> "") {$daysField=delta_tempo($today, $row['end_field'], "g"); $dayClass="inField";}
else { $daysField="n.d.";}
if ($daysField<=0) {$daysField=0;}
if ($daysField==0 && $end_date< $today ) {$daysField=delta_tempo($row['sur_date'] ,$row['end_field'], "g");  $dayClass="cloField";}
if ($daysField==0 && $end_date==$today ) {$daysField="Ultimo"; $dayClass="last";}
$obj=$row['complete']-$row['goal'];

//Definisco stile obiettivo//
if ($obj<0) {$stObj='red';}
else {$stObj='#02680F';}

echo "<tbody><tr>";
echo "<td><a href='conta_locale.php?prj=".$row['prj']."&sid=".$row['sur_id']."'>".$row['sur_id']."</a><br></td>";
echo "<td>".$row['description']."</td>";
echo "<td><span class='".$dayClass."'>".$daysField."<span></td>";
echo "<td>".$row['complete']."</td>";
echo "<td>".$row['durata']." min.</td>";
echo "<td>".$row['goal']."</td>";
echo "<td style='color:".$stObj."'>".$obj."</td>";
echo "<td>".$row['contatti']."</td>";
if ($row['panel']==1) { echo "<td>".$row['red_panel']."%</td>"; }
else { echo "<td>N.D.</td>"; }
echo "<td>".$row['red_surv']."%</td>";
if ($row['panel']==1) { echo "<td>".$row['abilitati']."</td>"; }
else { echo "<td>N.D.</td>"; }
echo "<td>".$sex."</td>";
echo "<td>".$row['age1_target']."-".$row['age2_target']."</td>";
echo "<td>".$panel."</td>";
echo "<td style='color:".$colSat."'>".$stato."</td>";
echo "</tr>";

$contaField++;

}

if ($contaField<6)
{

	while ($row = mysqli_fetch_assoc($tot_inattive))
	{

	if ($contaField<6)
	{
if ($row['stato']==0){$stato="Aperta";  $colSat="#007F21";}
if ($row['stato']==1){$stato="Chiusa";  $colSat="#FF0400";}
if ($row['panel']==1){$panel="Millebytes";}
if ($row['panel']==0){$panel="Esterno";}
if ($row['panel']==2){$panel="Target";}
if ($row['sex_target']==1){$sex="M";}
if ($row['sex_target']==2){$sex="F";}
if ($row['sex_target']==3){$sex="M-F";}
$today=substr($data,0,10);
$sur_date=substr($row['sur_date'],0,10);
$end_date=substr($row['end_field'],0,10);
if($end_date <> "") {$daysField=delta_tempo($today, $row['end_field'], "g"); $dayClass="inField";}
else { $daysField="n.d.";}
if ($daysField<=0) {$daysField=0;}
if ($daysField==0 && $end_date< $today ) {$daysField=delta_tempo($row['sur_date'] ,$row['end_field'], "g");  $dayClass="cloField";}
if ($daysField==0 && $end_date==$today ) {$daysField="Ultimo"; $dayClass="last";}
$obj=$row['complete']-$row['goal'];

//Definisco stile obiettivo//
if ($obj<0) {$stObj='red';}
else {$stObj='#02680F';}

echo "<tr style='background:#FCE8E8'>";
echo "<td><a href='conta_locale.php?prj=".$row['prj']."&sid=".$row['sur_id']."'>".$row['sur_id']."</a><br></td>";
echo "<td>".$row['description']."</td>";
echo "<td><span class='".$dayClass."'>".$daysField."<span></td>";
echo "<td>".$row['complete']."</td>";
echo "<td>".$row['durata']." min.</td>";
echo "<td>".$row['goal']."</td>";
echo "<td style='color:".$stObj."'>".$obj."</td>";
echo "<td>".$row['contatti']."</td>";
if ($row['panel']==1) { echo "<td>".$row['red_panel']."%</td>"; }
else { echo "<td>N.D.</td>"; }
echo "<td>".$row['red_surv']."%</td>";
if ($row['panel']==1) { echo "<td>".$row['abilitati']."</td>"; }
else { echo "<td>N.D.</td>"; }
echo "<td>".$sex."</td>";
echo "<td>".$row['age1_target']."-".$row['age2_target']."</td>";
echo "<td>".$panel."</td>";
echo "<td style='color:".$colSat."'>".$stato."</td>";
echo "</tr>";

	$contaField++;
	}

	}

}

echo "</tbody></table>";






?>