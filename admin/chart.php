

<div class="row">

<div class="col-xl-6 col-lg-5">
<div class="card shadow mb-6">

   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> GENERE </h6></span>
 </div>

<div class="card-body">      
<canvas id="pie-chart"></canvas>
</div>

</div>
</div>

<div class="col-xl-6 col-lg-5">
<div class="card shadow mb-6">

   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> FASCE D'ETA' </h6></span>
 </div>

<div class="card-body">      
<canvas id="bar-chart-horizontal" ></canvas>

</div>

</div>
</div>

<!-- close row  -->
</div>




<div class="row">

<div class="col-xl-6 col-lg-5">
<div class="card shadow mb-6">

   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> GENERE </h6></span>
 </div>

<div class="card-body">      
<canvas id="pie-chart"></canvas>
</div>

</div>
</div>

<div class="col-xl-6 col-lg-5">
<div class="card shadow mb-6">

   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<h6 class="m-0 font-weight-bold text-primary"> FASCE D'ETA' </h6></span>
 </div>

<div class="card-body">      
<canvas id="bar-chart-horizontal" ></canvas>

</div>

</div>
</div>

<!-- close row  -->
</div>


<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

<script>

 // chart sesso   
new Chart(document.getElementById("pie-chart"), {
    type: 'pie',
    data: {
      labels: ["Uomini", "Donne"],
      datasets: [{
        label: "Population (millions)",
        backgroundColor: ["#3e95cd", "#e8c3b9"],
        data: [<?php echo $tm_use['total']; ?>,<?php echo $tf_use['total']; ?>]
      }]
    },
    options: {
        animation:{
        animateRotate: true,
        render: false,
    },

    }
});

//chart età
new Chart(document.getElementById("bar-chart-horizontal"), {
    type: 'horizontalBar',
    data: {
      labels: ["Under 18 anni", "18-24 anni", "25-34 anni","35-44 anni", "45-54 anni", "55-64 anni","65 e +"],
      datasets: [
        {
          label: "Utenti",
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



</script>    