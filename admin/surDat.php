<?php
require_once('func_panelDat.php');
require_once('function_conta_aree.php');
?>

<!--Inizio nuova riga -->	
<div class="row">		
		
	<div class="col-xl-6 shadow-sm p-3 mb-5 bg-white rounded">
	<div class="card card-default">
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-secondary">RICERCHE EFFETTUATE</h6> 
						<span style="font-size: 28px; color: #94d872;">
						<i class="fas fa-info-circle"></i>
											</span> 
                            
                        </div>
	
		<div class="card-body">
        <canvas width="100%" id="barSur"></canvas>
			</div>
			
			
</div>
	

	
</div>
	



<div class="col-xl-6  shadow-sm p-3 mb-5 bg-white rounded">

 <div class="card card-default">
 <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-secondary">RICERCHE PER PAESE</h6> 
						<span style="font-size: 28px; color: #94d872;">
						<i class="fas fa-globe"></i>
											</span> 
                            
</div>
<div class="card-body">
				
<canvas width="100%" id="barPaesi"></canvas>      

</div>
			

</div>
</div>




 </div>

 <div class="row">

 <div class="col-xl-6  shadow-sm p-3 mb-5 bg-white rounded">

 <div class="card card-default">
 <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h6 class="m-0 font-weight-bold text-secondary">RICERCHE PER CLIENTE</h6> 
						<span style="font-size: 28px; color: #94d872;">
						<i class="fas fa-globe"></i>
											</span> 
                            
</div>
<div class="card-body">
				
<canvas width="100%" height="200px" id="barClienti"></canvas>   

</div>
			

</div>
</div>

 </div>



<div class="panel-footer">
                         
</div>


<script>

//chart ricerche
new Chart(document.getElementById("barSur"), {
    type: 'bar',
    data: {
      labels: ["2020", "2019"],
      datasets: [
        {
          label:  ["Totali"],
          backgroundColor: ["#ffd789","#ffd789"],
          data: [<?php echo $totSur['tot']; ?>,<?php echo $totSur16['tot']; ?>]
        },

        {
          label:  ["Interne"],
          backgroundColor: ["#ceefbd","#ceefbd"],
          data: [<?php echo $contaInt; ?>,<?php echo $contaInt16; ?>]
        },

        {
          label:  ["Esterne"],
          backgroundColor: ["#7fbee2", "#7fbee2"],
          data: [<?php echo $contaExt; ?>,<?php echo $contaExt16; ?>]
        },
        {
          label:  ["Da Lista"],
          backgroundColor: ["#BF8BD6", "#BF8BD6"],
          data: [<?php echo $contaTar; ?>,<?php echo $contaTar16; ?>]
        }

      ]
    },
    options: {
      legend: { display: true },
      title: {
        display: true,
        text: 'Ricerche online'
      }
    }
});


//chart ricerche per paese
new Chart(document.getElementById("barPaesi"), {
    type: 'horizontalBar',
    data: {
      labels: ["Italia", "UK", "Germania", "Francia", "Spagna", "Resto del mondo"],
      datasets: [
        {
          label:  ["<?php echo $actualYear; ?>"],
          backgroundColor: ["#ceefbd","#ceefbd","#ceefbd","#ceefbd","#ceefbd","#ceefbd"],
          data: [<?php echo $italia_c2018['complete_ext']; ?>,<?php echo $uk_c2018['complete_ext']; ?>,<?php echo $germania_c2018['complete_ext']; ?>,<?php echo $francia_c2018['complete_ext']; ?>,<?php echo $spagna_c2018['complete_ext']; ?>,<?php echo $altro_c2018['complete_ext']; ?>]
        },
        {
          label:  ["<?php echo $pastYear1; ?>"],
          backgroundColor: ["#ffd789","#ffd789","#ffd789","#ffd789","#ffd789","#ffd789"],
          data: [<?php echo $italia_c2016['complete_ext']; ?>,<?php echo $uk_c2016['complete_ext']; ?>,<?php echo $germania_c2016['complete_ext']; ?>,<?php echo $francia_c2016['complete_ext']; ?>,<?php echo $spagna_c2016['complete_ext']; ?>,<?php echo $altro_c2016['complete_ext']; ?>]
        },

      ]
    },
    options: {
      legend: { display: true },
      title: {
        display: true,
        text: 'Interviste acquistate per paese'
      }
    }
});





<?php
      $conta=0;
      $label="";
      $data19="";
      $color19="";
      $data20="";
      $color20="";
      $sumPrj;

    while ($row = mysqli_fetch_assoc($lista_clienti))
			{
        
          $sumPrj=$row['conta2018']+$row['conta2019']+$row['conta2020'];

          if($sumPrj>0)
          {
          $conta++;

          $label=$label."'";
          $label=$label.$row['cliente'];
          $data18=$data18.$row['conta2018'];
          $color18=$color18."'#d6987c'";
          $data19=$data19.$row['conta2019'];
          $color19=$color19."'#dbd07f'";
          $data20=$data20.$row['conta2020'];
          $color20=$color20."'#9DCE6B'";
          $label=$label=$label."'";
    
          if($numClient != $conta) 
          {
            $label=$label.",";  
            $data18=$data18.",";  
            $data19=$data19.",";  
            $data20=$data20.",";
            $color18=$color18.",";
            $color19=$color19.",";
            $color20=$color20.",";
          }
        
        } 
     
		
      }

    
      ?>


//chart ricerche per cliente
new Chart(document.getElementById("barClienti"), {
    type: 'horizontalBar',
    data: {
      labels: [

       <?php echo $label; ?>

      ],
      datasets: [
        {
          label:  ["2020"],
          backgroundColor: [<?php echo $color20; ?>],
          data: 
          [
            <?php echo $data20; ?>
          ]
        },
        {
          label:  ["2019"],
          backgroundColor: [<?php echo $color19; ?>],
          data: 
          [
             <?php echo $data19; ?> 

          ]
        },

        {
          label:  ["2018"],
          backgroundColor: [<?php echo $color18; ?>],
          data: 
          [
             <?php echo $data18; ?> 

          ]
        },

      ]
    },
    options: {
      responsive: true,
      legend: { display: true },
      scales: {
        xAxes: [{
            gridLines: {
                color: "rgb(178, 178, 178)",
            }
        }],
        yAxes: [{
            gridLines: {
                color: "rgb(178, 178, 178)",
            }   
        }]
    },
      title: {
        display: true,
        text: 'Numero di ricerche CAWI per cliente'
      }
    }
});

</script>

