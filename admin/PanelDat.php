
<?php
require_once('func_panelDat.php');
require_once('function_conta_aree.php');
?>

<!--Attività -->

<div class="row">

<!--Panel redemption-->	
<div class="col-xl-4">
<div class="card shadow mb-6">

   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> GENERE </h6></span>
 </div>

<div style="min-height:240px;" class="card-body">      
<canvas width="100%" id="pie-chart"></canvas>
</div>

</div>
</div>

<div class="col-xl-4">
<div class="card shadow mb-6">

   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> FASCE D'ETA' </h6></span>
 </div>

<div style="min-height:240px;"  class="card-body">      
<canvas  id="bar-chart-horizontal" ></canvas>

</div>

</div>
</div>

<div class="col-xl-4">
<div class="card shadow mb-6">

   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> AREE </h6></span>
 </div>

<div style="min-height:240px;" class="card-body">    
	  
<canvas id="pie-chart2" ></canvas>

</div>

</div>
</div>





</div>




	

</div>
<!--Fine prima riga -->

<!--Inizio nuova riga -->	
<div class="row">	

<div class="col-xl-6">
<div class="card shadow mb-6">

   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> ANDAMENTO IR </h6></span>
 </div>

<div style="min-height:240px;" class="card-body">      
<canvas width="100%" id="linered"></canvas>
</div>

</div>
</div>

<div class="col-xl-6">
<div class="card shadow mb-6">

   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> REGISTRATI </h6></span>
 </div>

<div style="min-height:240px;" class="card-body">      
<canvas width="100%" id="barnew"></canvas>
</div>

</div>
</div>
		
</div>
<!--Fine seconda riga -->	
		
<!--Inizio nuova riga -->	
<div class="row">		
		
	<div class="col-xl-4 col-lg-5  shadow-sm p-3 mb-5 bg-white rounded">
	<div class="card card-default">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-warning">Info Ricerche</h6> 
						<span style="font-size: 28px; color: #94d872;">
						<i class="fas fa-info-circle"></i>
											</span> 
                            
                        </div>
	
		<div class="card-body">
				<table class="table table-striped table-bordered" style="font-size:12px">

					<thead class="thead-light">
					<tr>
						 <th scope="col">&nbsp;</th>
						 <th scope="col">2020</th>
						 <th scope="col">2019</th>
						 <th scope="col">2018</th>
					</tr>
					</thead>
				<tbody>
				<tr><td>Ricerche:</td><td><b><?php echo $totSur16['tot']; ?></b></td><td><b><?php echo $totSur['tot']; ?></b></td><td><b><?php echo $totSur17['tot']; ?></b></td></tr>
				<tr><td>Interne</td> <td><b><?php echo $contaInt16; ?></b></td><td><b><?php echo $contaInt; ?></b></td><td><b><?php echo $contaInt17; ?></b></td> </tr>
				<tr><td>Esterne:</td><td><b><?php echo $contaExt16; ?></b></td><td><b><?php echo $contaExt; ?></b></td><td><b><?php echo $contaExt17; ?></b></td> </tr>
				<tr><td>Compl. Int.</td><td><b><?php echo $compInt16;  ?></b></td> <td><b><?php echo $compInt;  ?></b></td><td><b><?php echo $compInt17;  ?></b></td> </tr>
				<tr><td>Compl. Est.</td><td><b><?php echo $compExt16;  ?></b></td> <td><b><?php echo $compExt;  ?></b></td><td><b><?php echo $compExt17;  ?></b></td> </tr>
				<tr><td>Compl. Int. Ita</td><td><b><?php echo $italiainterne2016." (".$percentualeinterne2016."%)";  ?></b></td><td><b><?php echo $italiainterne2018." (".$percentualeinterne2018."%)";  ?></b></td><td><b><?php echo $italiainterne2017." (".$percentualeinterne2017."%)";  ?></b></td>  </tr>
				<tr><td>Compl. Est Ita</td><td><b><?php echo $italiaesterne2016." (".$percentualeesterne2016."%)";  ?></b></td><td><b><?php echo $italiaesterne2018." (".$percentualeesterne2018."%)";  ?></b></td> <td><b><?php echo $italiaesterne2017." (".$percentualeesterne2017."%)";  ?></b></td> </tr>	
				<tr><td>Contatti</td><td><b><?php echo $contact16; ?></b></td> <td><b><?php echo $contact; ?></b></td> <td><b><?php echo $contact17; ?></b></td> </tr>
				<tr><td>Sospese</td><td><b><?php  echo $incomplete16;  ?></b></td> <td><b><?php  echo $incomplete;  ?></b></td> <td><b><?php  echo $incomplete17;  ?></b></td> </tr>
				<tr><td>Inviti</td><td><b><?php   echo $abili16; ?></b></td><td><b><?php   echo $abili; ?></b></td>   <td><b><?php   echo $abili17; ?></b></td> </tr>
				</tbody>
				</table>
			</div>
			
			
</div>
	

	
</div>
	

<!--Calcolo redemption-->	
<div class="col-xl-4 col-lg-5  shadow-sm p-3 mb-5 bg-white rounded">
<div class="card card-default">
<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-info">Calcolo Interviste</h6> 
						<span style="font-size: 28px; color: #94d872;">
						<i class="fas fa-calculator"></i>
											</span> 
                            
</div>
	<?php 

		$ageComp=$medRed2/100*$age_use['total'];
		$ageComp=$ageComp/100*$ir;
		$mComp=$medRed2/100*$age_useMen['total'];
		$mComp=$mComp/100*$ir;
		$fComp=$medRed2/100*$age_useGirl['total'];
	 	$fComp=$fComp/100*$ir;
	?>
	<div class="card-body">
	<form action="homegest.php" method="get">
	<table class="table table-striped table-bordered" style="font-size:12px">
				<tr><td scope="col">IR</td><td><input class="form-control" name="ir" size="2" type="input" value="<?php echo $ir; ?>" /></td></tr>
				<tr><td scope="col">Totali:</td><td><?php echo  sprintf("%01.0f",$ageComp); ?></td></tr>
				<tr><td scope="col">Uomini:</td><td><?php echo sprintf("%01.0f",$mComp); ?></td></tr>
				<tr><td scope="col">Donne:</td><td><?php echo sprintf("%01.0f",$fComp); ?></td></tr>
				<tr>
				<td><input class="form-control" name="ag1" size="2" type="input" value="<?php echo $ag1; ?>" /> - <input class="form-control" name="ag2" size="2" type="input" value="<?php echo $ag2; ?>" /> anni</td>
				<td style="vertical-align:middle"><?php echo sprintf("%01.0f",$ageComp); ?></td>
				</tr>
				<input type="hidden" name="azione" value="calc" />
				<tr>
					<td colspan="2">
						<input class="btn btn-success" type="submit" value="CALCOLA" style="width:80%"/>
					</td>
				</table>
	</form>			
	</div>
	
			
</div>
</div>


<div class="col-xl-4 col-lg-5  shadow-sm p-3 mb-5 bg-white rounded">

 <div class="card card-default">
 <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-muted">Ricerche Esterne</h6> 
						<span style="font-size: 28px; color: #94d872;">
						<i class="fas fa-globe"></i>
											</span> 
                            
</div>
                 <div class="card-body">
				<table class="table table-striped table-bordered" style="font-size:12px">
				<thead class="thead-light">
				<tr>
					<th scope="col" >Paese</th>
					<th scope="col" >N. Ric. 20</th>
					<th scope="col" >Casi 20</th>
					<th scope="col" >N. Ric. 19</th>
					<th scope="col" >Casi 19</th>
				</tr>
				</thead>
				<tbody>
				<tr><td>Italia</td><td><?php echo $italia2018['total']; ?></td><td><?php echo $italia_c2018['complete_ext']; ?></td><td><?php echo $italia2017['total']; ?></td><td><?php echo $italia_c2017['complete_ext']; ?></td></tr>
				<tr><td>UK</td><td><?php echo $uk2018['total']; ?></td><td><?php echo $uk_c2018['complete_ext']; ?></td><td><?php echo $uk2017['total']; ?></td><td><?php echo $uk_c2017['complete_ext']; ?></td></tr>
			    <tr><td>Germania</td><td><?php echo $germania2018['total']; ?></td><td><?php echo $germania_c2018['complete_ext']; ?></td><td><?php echo $germania2017['total']; ?></td><td><?php echo $germania_c2017['complete_ext']; ?></td></tr>
				<tr><td>Francia</td><td><?php echo $francia2018['total']; ?></td><td><?php echo $francia_c2018['complete_ext']; ?></td><td><?php echo $francia2017['total']; ?></td><td><?php echo $francia_c2017['complete_ext']; ?></td></tr>
				<tr><td>Spagna</td><td><?php echo $spagna2018['total']; ?></td><td><?php echo $spagna_c2018['complete_ext']; ?></td><td><?php echo $spagna2017['total']; ?></td><td><?php echo $spagna_c2017['complete_ext']; ?></td></tr>
				<tr><td>Altro</td><td><?php echo $altro2018['total']; ?></td><td><?php echo $altro_c2018['complete_ext']; ?></td><td><?php echo $altro2017['total']; ?></td><td><?php echo $altro_c2017['complete_ext']; ?></td></tr>
				</tbody>
				</table>
				</div>
			

</div>
</div>




 </div>
 <!-- /. ROW  -->
<div class="row">
		
<div class="col-xl-4 col-lg-5  shadow-sm p-3 mb-5 bg-white rounded">
<div class="card card-default">
<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-danger">Livelli Utenti</h6> 
						<span style="font-size: 28px; color: #94d872;">
						<i class="fas fa-level-up-alt"></i>
											</span> 
                            
</div>

<div class="card-body">
<table class="table table-striped table-bordered" style="font-size:12px">
<tr>
<thead class="thead-light">
	 <th>Livello </th>
	 <th>Utenti</th>
	 <th>&nbsp;</th>
</thead>
	</tr>
<?php	  


$pre=0;

for ($i = 1; $i < 41; $i++) 
	{
	if ($i==5 || $i==10 || $i==15 || $i==20 || $i==30 || $i==40)
		{		
	
		$query_m2 = "SELECT count(*) as total FROM field_data_field_user_level WHERE field_user_level_value>$pre AND field_user_level_value<=$i";
		$m2_close = mysqli_query($admin,$query_m2) or die(mysql_error());
		$tot_lev = mysqli_fetch_assoc($m2_close);
		
		$totLev=$tot_lev['total'];
		
		if($i==5) {$fin="0-5";}
		if($i==10) {$fin="6-10";}
		if($i==15) {$fin="11-15";}
		if($i==20) {$fin="16-20";}
		if($i==30) {$fin="21-30";}
		if($i==40) {$fin="31-40";}

				?>
				<form action="infoLevel.php" target="_blank" method="get">
				<input type="hidden" name="livello" value="<?php echo $i;?>" />
				<input type="hidden" name="prelivello" value="<?php echo $pre;?>" />
				<tbody>
				
<?php	
				echo "<tr><td>".$fin."</td><td>".$totLev."</td><td><input type='submit' value='vedi'></td></tr></form>";
				$pre=$i;
				
			}
		
		}
		
		
?>
				</tbody>
</table>
</div>	



<div class="panel-footer">
                         
                        </div>
                    </div>
</div>


 <!-- /. FINE ROW  -->
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

<script>
window.onload = function() 
{

// chart sesso   
new Chart(document.getElementById("pie-chart"), {
    type: 'pie',
    data: {
      labels: ["Uomini", "Donne"],
      datasets: [{
        label: "Utenti ",
        backgroundColor: ["#3e95cd", "#e8c3b9"],
        data: [<?php echo $totMen; ?>,<?php echo $tot_useGirl['total']; ?>]
      }]
    },
    options: {
		animation:{
        animateRotate: true,
        render: false,
    },
		responsive: true,
   		 maintainAspectRatio: false

    }

});

//chart età

var ctx = document.getElementById("bar-chart-horizontal");
ctx.height = 200;

new Chart(document.getElementById("bar-chart-horizontal"), {

    type: 'horizontalBar',
    data: {
      labels: ["Under 18 anni", "18-24 anni", "25-34 anni","35-44 anni", "45-54 anni", "55-64 anni","65 e +"],
      datasets: [
        {
          label: "Utenti ",
          backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9","#c45850","red","green"],
          data: [<?php echo $t17_use['total']; ?>,<?php echo $t18_use['total']; ?>,<?php echo $t25_use['total']; ?>,<?php echo $t35_use['total']; ?>,<?php echo $t45_use['total']; ?>,<?php echo $t55_use['total']; ?>,<?php echo $t65_use['total']; ?>]
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Fasce di età rappresentative'
      }
    }
});


// chart aree   
ctx = document.getElementById("pie-chart2");
ctx.height = 200;

new Chart(document.getElementById("pie-chart2"), {
    type: 'doughnut',
    data: {
      labels: ["NO", "NE","CE","SUD"],
      datasets: [{
        label: "Utenti ",
        backgroundColor: ["#3e95cd", "#8e5ea2","#3cba9f","#e8c3b9"],
        data: [<?php echo $tNo; ?>,<?php echo $tNe; ?>,<?php echo $tCe; ?>,<?php echo $tSu; ?>]
      }]
    },
    options: {
        animation:{
        animateRotate: true,
        render: false,
    },

	legend: 
		{
            labels: {
                // This more specific font property overrides the global property
				boxWidth:30,
				fontSize:11
            }
        }

    }
});


 // chart redemption   
new Chart(document.getElementById("linered"), {
    type: 'line',
    data: {
      labels: ["2018", "2019", "2020"],
      datasets: [{
        label: "% risposta ",
		fill:false,
        backgroundColor: ["#c9ffd5", "#36a2eb" , "#cc65fe"],
        data: [<?php echo sprintf("%01.2f", $medRed18); ?>,<?php echo sprintf("%01.2f", $medRed19); ?>,<?php echo sprintf("%01.2f", $medRed20); ?>]
      }]
    },
    options: {
        animation:{
        animateRotate: true,
        render: false,
    },

    }
});
	
 

//chart registrati
new Chart(document.getElementById("barnew"), {
    type: 'bar',
    data: {
      labels: ["2018", "2019", "2020"],
      datasets: [
        {
          label: "Utenti ",
          backgroundColor: ["#a7cde2", "#bf8bd6","#3cba9f"],
          data: [<?php echo $totReg18['tot']; ?>,<?php echo $totReg19['tot']; ?>,<?php echo $totReg20['tot']; ?>]
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Utenti Registrati'
      }
    }
});


}
</script>	

