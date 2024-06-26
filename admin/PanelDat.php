
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
	<h6 class="m-0 font-weight-bold text-secondary"> GENERE </h6></span>
 </div>

<div style="min-height:240px;" class="card-body">      
<canvas width="100%" id="pie-chart"></canvas>
</div>

</div>
</div>

<div class="col-xl-4">
<div class="card shadow mb-6">

   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-secondary"> FASCE D'ETA' </h6></span>
 </div>

<div style="min-height:240px;"  class="card-body">      
<canvas  id="bar-chart-horizontal" ></canvas>

</div>

</div>
</div>

<div class="col-xl-4">
<div class="card shadow mb-6">

   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-secondary"> AREE </h6></span>
 </div>

<div style="min-height:240px;" class="card-body">    
	  
<canvas id="pie-chart2" ></canvas>

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
	<h6 class="m-0 font-weight-bold text-secondary"> ANDAMENTO IR </h6></span>
 </div>

<div style="min-height:240px;" class="card-body">      
<canvas width="100%" id="linered"></canvas>
</div>

</div>
</div>

<div class="col-xl-6">
<div class="card shadow mb-6">

   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-secondary"> REGISTRATI </h6></span>
 </div>

<div style="min-height:240px;" class="card-body">      
<canvas width="100%" id="barnew"></canvas>
</div>

</div>
</div>
		
</div>
<!--Fine seconda riga -->	
		
<!--Inizio terza riga -->	
<div class="row">	

<div class="col-xl-12">
<div class="card shadow mb-12">

   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-secondary"> UTENTI ATTIVI </h6></span>
 </div>

<div style="min-height:240px;" class="card-body">      
<canvas width="100%" id="attivi"></canvas>
</div>

</div>
</div>

		
</div>
<!--Fine seconda riga -->	



<div class="panel-footer">
                  
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
      labels: ["<?php echo $pastYear4; ?>","<?php echo $pastYear3; ?>","<?php echo $pastYear2; ?>", "<?php echo $pastYear1; ?>", "<?php echo $actualYear; ?>"],
      datasets: [{
        label: "% risposta ",
        borderColor:["#c9ffd5", "#36a2eb" , "#cc65fe", "#FFD789","#E60000"],
            pointBorderColor: ["#c9ffd5", "#36a2eb" , "#cc65fe", "#FFD789","#E60000"],
            pointBackgroundColor: ["#c9ffd5", "#36a2eb" , "#cc65fe", "#FFD789","#E60000"],
            pointHoverBackgroundColor: ["#c9ffd5", "#36a2eb" , "#cc65fe", "#FFD789","#E60000"],
            pointHoverBorderColor: ["#c9ffd5", "#36a2eb" , "#cc65fe", "#FFD789","#E60000"],
            pointBorderWidth: 6,
            pointHoverRadius: 6,
            pointHoverBorderWidth: 1,
            pointRadius: 3,
            fill: false,
            borderWidth: 2,
		fill:false,
        backgroundColor: ["#c9ffd5", "#36a2eb" , "#cc65fe", "#FFD789","#E60000"],
        data: [<?php echo sprintf("%01.2f", $medRed16); ?>,<?php echo sprintf("%01.2f", $medRed17); ?>,<?php echo sprintf("%01.2f", $medRed18); ?>,<?php echo sprintf("%01.2f", $medRed19); ?>,<?php echo sprintf("%01.2f", $medRed20); ?>]
      }]
    },
    options: {
        legend: {
            position: "bottom"
        },
        scales: {
            yAxes: [{
                ticks: {
                    fontColor: "rgba(0,0,0,0.5)",
                    fontStyle: "bold",
                    beginAtZero: true,
                    maxTicksLimit: 8,
                    padding: 20
                },
                gridLines: {
                    drawTicks: false,
                    display: false
                }}],
            xAxes: [{
                gridLines: {
                    zeroLineColor: "transparent"},
                ticks: {
                    padding: 20,
                    fontColor: "rgba(0,0,0,0.5)",
                    fontStyle: "bold"
                }
            }]
        }
    }
});
	
 // chart attivi   
new Chart(document.getElementById("attivi"), {
    type: 'line',
    data: {
      labels: ["<?php echo $pastYear4; ?>","<?php echo $pastYear3; ?>","<?php echo $pastYear2; ?>", "<?php echo $pastYear1; ?>", "<?php echo $actualYear; ?>"],
      datasets: [{
        label: "utenti attivi ",
        borderColor:["#c9ffd5", "#36a2eb" , "#cc65fe", "#FFD789","#E60000"],
            pointBorderColor: ["#c9ffd5", "#36a2eb" , "#cc65fe", "#FFD789","#E60000"],
            pointBackgroundColor: ["#c9ffd5", "#36a2eb" , "#cc65fe", "#FFD789","#E60000"],
            pointHoverBackgroundColor: ["#c9ffd5", "#36a2eb" , "#cc65fe", "#FFD789","#E60000"],
            pointHoverBorderColor: ["#c9ffd5", "#36a2eb" , "#cc65fe", "#FFD789","#E60000"],
            pointBorderWidth: 5,
            pointHoverRadius: 5,
            pointHoverBorderWidth: 1,
            pointRadius: 5,
            fill: false,
            borderWidth: 2,
		fill:false,
        backgroundColor: ["#c9ffd5", "#36a2eb" , "#cc65fe", "#FFD789","#E60000"],
        data: [<?php echo sprintf("%01.2f", $arrAttivi[0]); ?>,<?php echo sprintf("%01.2f", $arrAttivi[1]); ?>,<?php echo sprintf("%01.2f", $arrAttivi[2]); ?>,<?php echo sprintf("%01.2f", $arrAttivi[3]); ?>,<?php echo sprintf("%01.2f", $arrAttivi[4]); ?>]
      }]
    },
    options: {
        legend: {
            position: "bottom"
        },
        scales: {
            yAxes: [{
                ticks: {
                    fontColor: "rgba(0,0,0,0.5)",
                    fontStyle: "bold",
                    beginAtZero: true,
                    maxTicksLimit: 8,
                    stepSize:100,
                    padding: 10
                },
                gridLines: {
                    drawTicks: true,
                    display: true
                }}],
            xAxes: [{
                gridLines: {
                    zeroLineColor: "transparent"},
                ticks: {
                    padding: 5,
                    fontColor: "rgba(0,0,0,0.5)",
                    fontStyle: "bold"
                }
            }]
        }
    }
});
	

//chart registrati
new Chart(document.getElementById("barnew"), {
    type: 'bar',
    data: {
      labels: ["<?php echo $pastYear4; ?>","<?php echo $pastYear3; ?>","<?php echo $pastYear2; ?>", "<?php echo $pastYear1; ?>", "<?php echo $actualYear; ?>"],
      datasets: [
        {
          label: "Utenti ",
          fill:true,
          backgroundColor: ["#c9ffd5", "#36a2eb" , "#cc65fe", "#FFD789","#E60000"],
          data: [<?php echo $totReg16['tot']; ?>,<?php echo $totReg17['tot']; ?>,<?php echo $totReg18['tot']; ?>,<?php echo $totReg19['tot']; ?>,<?php echo $totReg20['tot']; ?>]
        }
      ]
    },
    options: {
      legend: { display: false },
      title: {
        display: true,
        text: 'Utenti Registrati'
      },
      scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }],
            xAxes: [{
                ticks: {
                    maxRotation: 180
                }
            }]
        }
    }
});


}
</script>	

