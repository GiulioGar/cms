
<?php
$data=date("Y-m-d");
$contaField=0;

$query_ricerche = "SELECT * FROM t_panel_control where stato=0 order by stato,giorni_rimanenti ASC,id DESC";
$tot_attive = mysqli_query($admin,$query_ricerche) ;


	
$query_conta = "SELECT COUNT(sur_id) as tot  FROM t_panel_control where stato=0";
$surOp = mysqli_query($admin,$query_conta) ;
$opSur = mysqli_fetch_assoc($surOp);


echo "<table class='table table-bordered'>";
echo "<thead class='thead-light'>";
echo "<tr style='font-weight:bold'>";	
echo "<th scope='col'>ID</th>";
echo "<th scope='col'>Info</th>";
echo "<th scope='col'>Andamento</th>";
echo "<th scope='col'>Tempistica</th>";
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
echo "<td style='font-size:16px;'><a href='controlloField.php?prj=".$row['prj']."&sid=".$row['sur_id']."'> <i class='far fa-folder-open'></i> ".$row['sur_id']."</a><br></td>";
echo "<td style='font-size:14px;'>".$row['description']."</td>";
echo "<td> 
<div class='progress'> 
<div class='progress-bar progress-bar-striped progress-bar-animated bg-success' role='progressbar' aria-valuenow=".$progress." aria-valuemin='0' aria-valuemax='100' style='width:0%'>".$progress."%</div>
</div></td>";
echo"<td class='crono2'>
<div class='crono' id='countdown".$row['sur_id']."'></div>
</td>";

echo "<td>".$panel."</td>";
echo "<td style='color:".$colSat."'>".$stato."</td>";
echo "</tr>";

$contaField++;

$time=strtotime($row['end_field']);
$meseSc=date('F', $time);
$ggSc=date('j', $time);
$ySc=date('Y', $time);


$originalDate=($row['end_field']);
$newDate = date("d-m-Y", strtotime($originalDate));
?>

<script>
	$( document ).ready(function() {
	// set the date we're counting down to
var target_date = new Date('<?php echo $meseSc; ?>, <?php echo $ggSc; ?>, <?php echo $ySc; ?>').getTime();
 
 // variables for time units
 var days, hours, minutes, seconds;
  
 // get tag element
 var countdown = document.getElementById('countdown<?php echo $row['sur_id'];?>');
  
 // update the tag with id "countdown" every 1 second
 setInterval(function () {
  
	 // find the amount of "seconds" between now and target
	 var current_date = new Date().getTime();
	 var seconds_left = (target_date - current_date) / 1000;
	 let qtext;
  
	 // do some time calculations
	 days = parseInt(seconds_left / 86400);
	 seconds_left = seconds_left % 86400;
	  
	 hours = parseInt(seconds_left / 3600);
	 seconds_left = seconds_left % 3600;
	  
	 minutes = parseInt(seconds_left / 60);
	 seconds = parseInt(seconds_left % 60);


	  
	 // format countdown string + set tag value
	 

	 if(days<=0 && hours<=0)
	 {
		countdown.innerHTML = '<div style="height:35px; vertical-align:middle;" class="alert alert-danger timing" role="alert"> <?php echo $newDate;?> <i class="far fa-stop-circle"></i> </div>';  
	 }

	 else if (days==0 )
	 {
		countdown.innerHTML = '<div style="height:35px; vertical-align:middle;" class="alert alert-warning timing" role="alert"> Ulitmo giorno <i class="fas fa-exclamation-circle"></i> </div>';  
	 }

	 else 
	 {
	   if(days==1) { qtext="giorno" }		 
	   else  { qtext="giorni" }		 
		countdown.innerHTML = '<div style="height:35px; vertical-align:middle;" class="alert alert-success" style="color:#515151; font-weight:bold;" role="alert"> '+ days+ ' '+qtext+' ' + hours + ':00 <i class="fas fa-hourglass-half"></i></div>';
	 }
	 
	
	 
  
 }, 1000);

});
</script>

<?php
}


echo "</tbody></table>";






?>