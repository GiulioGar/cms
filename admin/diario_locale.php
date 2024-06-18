<div class="row ">
<div class="col-md-12 col-sm-12">
<div class="card body">



<ul class="nav nav-pills nav-justified" id="mytab" style="margin-bottom:15px;" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="inviti-tab3" data-toggle="tab" href="#inviti3" role="tab" aria-controls="inviti3" aria-selected="true"> <i class="fa fa-user"></i> Interviste</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="registra-tab3" data-toggle="tab" href="#registra3" role="tab" aria-controls="registra3" aria-selected="false"><i class="fas fa-chart-line"></i> IR</a>
  </li>
</ul>


<!-- Tab panes -->
<div class="tab-content">

<div class="tab-pane active" id="inviti3" role="tabpanel" aria-labelledby="inviti-tab3"> 

<?php if ($contaPan>1) { ?>  <canvas id="lineaContatti"></canvas> <BR/><BR/> <?php } ?>
<?php if ($panel_in==1 || $panel_in==2) { ?>  <canvas id="lineaContattiMB"></canvas><BR/><BR/> <?php } ?>
<?php if ($panel_esterno>0) { ?>  <canvas id="lineaContattiE"></canvas><BR/><BR/> <?php } ?>
</div>

<div class="tab-pane" id="registra3" role="tabpanel" aria-labelledby="registra-tab3">

<?php if ($contaPan>1) { ?>  <canvas id="lineaIr"></canvas> <BR/><BR/> <?php } ?>
<?php if ($panel_in==1 || $panel_in==2) { ?>  <canvas id="lineaIrMB"></canvas> <BR/><BR/> <?php } ?>
<?php if ($panel_esterno>0) { ?>  <canvas id="lineaIrE"></canvas> <BR/><BR/> <?php } ?>

</div>


</div>



</div>
</div>
</div>




<?php

// FIELD GENERALE

$daysArr=array();
$days2Arr=array();
$WdaysArr=array();
$completeArr=array();
$screenoutArr=array();
$fullArr=array();
$sospeseArr=array();
$contattiArr=array();
$redArr=array();


                    if (isset($diario) && is_array($diario)) {
                        asort($diario);
                    } else {
                        // Gestione del caso in cui $diario non è definito o non è un array
                        $diario = [];
                        // Puoi decidere di loggare un messaggio di errore o gestire questo caso come preferisci
                    }


							foreach ( $diario as $chiave => $valore) 
							{ 
							if ($diario_complete[$chiave]==""){$diario_complete[$chiave]=0;}
							if ($diario_filtrati[$chiave]==""){$diario_filtrati[$chiave]=0;}
							if ($diario_quotafull[$chiave]==""){$diario_quotafull[$chiave]=0;}
							if ($diario_incomplete[$chiave]==""){$diario_incomplete[$chiave]=0;}

							if (($diario_complete[$chiave] + $diario_filtrati[$chiave]) != 0) {
                                $redemption_field_giornaliero = ($diario_complete[$chiave] / ($diario_complete[$chiave] + $diario_filtrati[$chiave])) * 100;
                            } else {
                                // Gestione del caso di divisione per zero
                                $redemption_field_giornaliero = 0; // O qualsiasi altro valore di default appropriato
                            }
							$redemption_field_giornaliero=number_format($redemption_field_giornaliero, 2);
							$sumDiaComp=$sumDiaComp+$diario_complete[$chiave];
							$sumDiaFilt=$sumDiaFilt+$diario_filtrati[$chiave];
							$sumDiaQf=$sumDiaQf+$diario_quotafull[$chiave];
							$sumDiaInc=$sumDiaInc+$diario_incomplete[$chiave];
							$sumDiaCont=$diario_complete[$chiave]+$diario_filtrati[$chiave]+$diario_quotafull[$chiave]+$diario_incomplete[$chiave];
							if ($diario_complete[$chiave]==0) { $redemption_field_giornaliero="N.D.";}
                            else { $redemption_field_giornaliero=$redemption_field_giornaliero; }

                            $pieces = explode("-", $chiave);
                            $giorno1=$pieces[0];
                            $mese1=$pieces[1];
                            $anno1=$pieces[2];

                           $wday= giornoSettimana($mese1,$giorno1,$anno1);
                        

                            array_push($WdaysArr,$wday);
                            array_push($daysArr,$chiave);
                            if ($redemption_field_giornaliero !="N.D.") {array_push($days2Arr,$chiave); } 
                            array_push($completeArr,$diario_complete[$chiave]);
                            array_push($screenoutArr,$diario_filtrati[$chiave]);
                            array_push($fullArr,$diario_quotafull[$chiave]);
                            array_push($sospeseArr,$diario_incomplete[$chiave]);
                            array_push($contattiArr,$sumDiaCont);
                            if($redemption_field_giornaliero !="N.D.") { array_push($redArr,$redemption_field_giornaliero);}
                            
                            }


 //FIELD MILLEBYTES

 $daysArrMB=array();
 $days2ArrMB=array();
 $WdaysArrMB=array();
 $completeArrMB=array();
 $screenoutArrMB=array();
 $fullArrMB=array();
 $sospeseArrMB=array();
 $contattiArrMB=array();
 $redArrMB=array();

 asort($diario);
 $abilitati_totali_sample=0;
 $contatti_totali_sample=0;
 foreach ( $diario as $chiave => $valore) 
 { 


 $giorno_due_cifre=substr($chiave,0,2);
 $query_user_abilitati_dp = "SELECT count(*) as total FROM t_abilitatipanel where ((sid='".$sid."') AND (uid NOT LIKE 'IDEX%')AND (data_abilitazione LIKE '".$giorno_due_cifre."%'))";
 $tot_user_abilitati_dp = mysqli_query($admin,$query_user_abilitati_dp);
 $tot_use_abilitati_dp = mysqli_fetch_assoc($tot_user_abilitati_dp);
 $abilitati_totali_sample=$abilitati_totali_sample+$tot_use_abilitati_dp['total'];

 if ($diario_complete_panel[$chiave]==""){$diario_complete_panel[$chiave]=0;}
 if ($diario_filtrati_panel[$chiave]==""){$diario_filtrati_panel[$chiave]=0;}
 if ($diario_quotafull_panel[$chiave]==""){$diario_quotafull_panel[$chiave]=0;}
 if ($diario_incomplete_panel[$chiave]==""){$diario_incomplete_panel[$chiave]=0;}
 $contatti_totali_sample=$contatti_totali_sample+$diario_complete_panel[$chiave]+$diario_filtrati_panel[$chiave]+$diario_quotafull_panel[$chiave]+$diario_incomplete_panel[$chiave];
 if ($abilitati_totali_sample != 0) {
    $red_panel_sample = ($contatti_totali_sample / $abilitati_totali_sample) * 100;
} else {
    // Gestione del caso di divisione per zero
    $red_panel_sample = 0; // O qualsiasi altro valore di default appropriato
}
 $red_panel_sample=number_format($red_panel_sample, 2);

 if (($diario_complete_panel[$chiave] + $diario_filtrati_panel[$chiave]) != 0) {
    $redemption_field_giornalieroMb = ($diario_complete_panel[$chiave] / ($diario_complete_panel[$chiave] + $diario_filtrati_panel[$chiave])) * 100;
} else {
    // Gestione del caso di divisione per zero
    $redemption_field_giornalieroMb = 0; // O qualsiasi altro valore di default appropriato
}
 $redemption_field_giornalieroMb=number_format($redemption_field_giornalieroMb, 2);

 $sumPanDiaComp=$sumPanDiaComp+$diario_complete_panel[$chiave];
 $sumPanDiaFilt=$sumPanDiaFilt+$diario_filtrati_panel[$chiave];
 $sumPanDiaQf=$sumPanDiaQf+$diario_quotafull_panel[$chiave];
 $sumPanDiaInc=$sumPanDiaInc+$diario_incomplete_panel[$chiave];
 $sumPanDiaCont=$diario_complete_panel[$chiave]+$diario_filtrati_panel[$chiave]+$diario_quotafull_panel[$chiave]+$diario_incomplete_panel[$chiave];
 if ($diario_complete_panel[$chiave]==0) { $redemption_field_giornalieroMb="N.D.";}
 else { $redemption_field_giornalieroMb=$redemption_field_giornalieroMb; }

 $pieces2 = explode("-", $chiave);
 $giorno1B=$pieces2[0];
 $mese1B=$pieces2[1];
 $anno1B=$pieces2[2];

$wdayB= giornoSettimana($mese1B,$giorno1B,$anno1B);
 
 array_push($WdaysArrMB,$wdayB);
 array_push($daysArrMB,$chiave);
 if($redemption_field_giornalieroMb !="N.D.") {  array_push($days2ArrMB,$chiave); }
 array_push($completeArrMB,$diario_complete_panel[$chiave]);
 array_push($screenoutArrMB,$diario_filtrati_panel[$chiave]);
 array_push($fullArrMB,$diario_quotafull_panel[$chiave]);
 array_push($sospeseArrMB,$diario_incomplete_panel[$chiave]);
 array_push($contattiArrMB,$sumPanDiaCont);
 if($redemption_field_giornalieroMb !="N.D.") { array_push($redArrMB,$redemption_field_giornalieroMb); }

}


//FIELD ESTERNO

$daysArrE=array();
$days2ArrE=array();
$WdaysArrE=array();
$completeArrE=array();
$screenoutArrE=array();
$fullArrE=array();
$sospeseArrE=array();
$contattiArrE=array();
$redArrE=array();

asort($diario);


									foreach ( $diario as $chiave => $valore) 
									{ 
									if ($diario_complete_ssi[$chiave]==""){$diario_complete_ssi[$chiave]=0;}
									if ($diario_filtrati_ssi[$chiave]==""){$diario_filtrati_ssi[$chiave]=0;}
									if ($diario_quotafull_ssi[$chiave]==""){$diario_quotafull_ssi[$chiave]=0;}
									if ($diario_incomplete_ssi[$chiave]==""){$diario_incomplete_ssi[$chiave]=0;}

									// Verifica che il denominatore non sia zero
                                    if (($diario_complete_ssi[$chiave] + $diario_filtrati_ssi[$chiave]) != 0) {
                                        $redemption_field_giornalieroEx = ($diario_complete_ssi[$chiave] / ($diario_complete_ssi[$chiave] + $diario_filtrati_ssi[$chiave])) * 100;
                                    } else {
                                        // Gestione del caso di divisione per zero
                                        $redemption_field_giornalieroEx = 0; // O qualsiasi altro valore di default appropriato
                                    }
									$redemption_field_giornalieroEx=number_format($redemption_field_giornalieroEx, 2);

									$sumExtDiaComp=$sumExtDiaComp+$diario_complete_ssi[$chiave];
									$sumExtDiaFilt=$sumExtDiaFilt+$diario_filtrati_ssi[$chiave];
									$sumExtDiaQf=$sumExtDiaQf+$diario_quotafull_ssi[$chiave];
									$sumExtDiaInc=$sumExtDiaInc+$diario_incomplete_ssi[$chiave];
                                    $sumExtDiaCont=$diario_complete_ssi[$chiave]+$diario_filtrati_ssi[$chiave]+$diario_quotafull_ssi[$chiave]+$diario_incomplete_ssi[$chiave];
                                    

                                    $pieces3 = explode("-", $chiave);
                                    $giorno1C=$pieces3[0];
                                    $mese1C=$pieces3[1];
                                    $anno1C=$pieces3[2];

                                    $wdayC= giornoSettimana($mese1C,$giorno1C,$anno1C);

                                    if (!isset($WdaysArrMC) || !is_array($WdaysArrMC)) { $WdaysArrMC = []; }
                                    
                                    array_push($WdaysArrMC,$wdayC);
                                    array_push($daysArrE,$chiave);
                                    if ($redemption_field_giornalieroEx !="nan")  { array_push($days2ArrE,$chiave);}

                                    if (!isset($day2sArrE) || !is_array($day2sArrE)) { $day2sArrE = []; }
                                    array_push($day2sArrE,$chiave);
                                    array_push($completeArrE,$diario_complete_ssi[$chiave]);
                                    array_push($screenoutArrE,$diario_filtrati_ssi[$chiave]);
                                    array_push($fullArrE,$diario_quotafull_ssi[$chiave]);
                                    array_push($sospeseArrE,$diario_incomplete_ssi[$chiave]);
                                    array_push($contattiArrE,$sumExtDiaCont);
                                    if ($redemption_field_giornalieroEx !="nan")  { array_push($redArrE,$redemption_field_giornalieroEx); }


                                    }
?>

<script>

////// GENERALE ////////

// chart status field   
new Chart(document.getElementById("lineaContatti"), {
    type: 'line',
    
    data: {
      labels: [<?php foreach ($daysArr as $index => $value){ echo "['".substr($daysArr[$index],0,5)."','".$WdaysArr[$index]."'],"; } ?>],
      
      datasets: 
      [
    {
        label: "complete",
		fill:false,
        backgroundColor: ["#a6d8a6"],
        borderColor: ["#a6d8a6"],
        data: [<?php foreach ($completeArr as $comp){ echo "'".$comp."',"; } ?>]
    },
    {
        label: "screen out",
		fill:false,
        backgroundColor: ["#fcabab"],
        borderColor: ["#fcabab"],
        data: [<?php foreach ($screenoutArr as $screen){ echo "'".$screen."',"; } ?>]
    },
    {
        label: "quota full",
		fill:false,
        backgroundColor: ["#ffffd8"],
        borderColor: ["#ffffd8"],
        data: [<?php foreach ($fullArr as $full){ echo "'".$full."',"; } ?>]
    },
    {
        label: "sospese",
		fill:false,
        backgroundColor: ["#fce9c7"],
        borderColor: ["#fce9c7"],
        data: [<?php foreach ($sospeseArr as $sosp){ echo "'".$sosp."',"; } ?>]
    },

    {
        label: "contatti",
		fill:false,
        backgroundColor: ["#87b7ff"],
        borderColor: ["#87b7ff"],
        data: [<?php foreach ($contattiArr as $concat){ echo "'".$concat."',"; } ?>]
    },

      ]
    },
    options: {
        animation:{
        animateRotate: true,
        render: false,
    },

    title: {
            display: true,
            fontSize:16,
            text: 'Field Generale'
        }

    }
});


// chart status field   
new Chart(document.getElementById("lineaIr"), {
    type: 'line',
    
    data: {
      labels: [<?php foreach ($days2Arr as $index => $value){ echo "['".substr($days2Arr[$index],0,5)."','".$WdaysArr[$index]."'],"; } ?>],
      
      datasets: 
      [
    {
        label: "IR Ricerca",
		fill:false,
        backgroundColor: ["#a6d8a6"],
        borderColor: ["#a6d8a6"],
        data: [<?php foreach ($redArr as $red){ echo "'".$red."',"; } ?>]
    }

      ]
    },
    options: {
        animation:{
        animateRotate: true,
        render: false,
    },

    title: {
            display: true,
            fontSize:16,
            text: 'Field Generale'
        }

    }
});

</script>

<script>
//MILLEBYTE

// chart status field   
new Chart(document.getElementById("lineaContattiMB"), {
    type: 'line',

    data: {
      labels: [<?php foreach ($daysArrMB as $index2 => $value2){ echo "['".substr($daysArrMB[$index2],0,5)."','".$WdaysArrMB[$index2]."'],"; } ?>],
      
      datasets: 
      [
    {
        label: "complete",
		fill:false,
        backgroundColor: ["#a6d8a6"],
        borderColor: ["#a6d8a6"],
        data: [<?php foreach ($completeArrMB as $compMB){ echo "'".$compMB."',"; } ?>]
    },
    {
        label: "screen out",
		fill:false,
        backgroundColor: ["#fcabab"],
        borderColor: ["#fcabab"],
        data: [<?php foreach ($screenoutArrMB as $screenMB){ echo "'".$screenMB."',"; } ?>]
    },
    {
        label: "quota full",
		fill:false,
        backgroundColor: ["#ffffd8"],
        borderColor: ["#ffffd8"],
        data: [<?php foreach ($fullArrMB as $fullMB){ echo "'".$fullMB."',"; } ?>]
    },
    {
        label: "sospese",
		fill:false,
        backgroundColor: ["#fce9c7"],
        borderColor: ["#fce9c7"],
        data: [<?php foreach ($sospeseArrMB as $sospMB){ echo "'".$sospMB."',"; } ?>]
    },

    {
        label: "contatti",
		fill:false,
        backgroundColor: ["#87b7ff"],
        borderColor: ["#87b7ff"],
        data: [<?php foreach ($contattiArrMB as $concatMB){ echo "'".$concatMB."',"; } ?>]
    },

      ]
    },
    options: {
        animation:{
        animateRotate: true,
        render: false,
    },

    title: {
            display: true,
            fontSize:16,
            text: 'Panel Interactive'
        }

    }
});


// chart status field   
new Chart(document.getElementById("lineaIrMB"), {
    type: 'line',
    data: {
      labels: [<?php foreach ($days2ArrMB as $index => $value){ echo "['".substr($days2ArrMB[$index],0,5)."','".$WdaysArrMB[$index]."'],"; } ?>],
      
      datasets: 
      [
    {
        label: "IR Ricerca",
		fill:false,
        backgroundColor: ["#a6d8a6"],
        borderColor: ["#a6d8a6"],
        data: [<?php foreach ($redArrMB as $redMB){ echo "'".$redMB."',"; } ?>]
    }

      ]
    },
    options: {
        animation:{
        animateRotate: true,
        render: false,
    },

    title: {
            display: true,
            fontSize:16,    
            text: 'Panel Interactive'
        }

    }
});


</script>


<script>
//ESTERBE

// chart status field   
new Chart(document.getElementById("lineaContattiE"), {
    type: 'line',

    data: {
      labels: [<?php foreach ($daysArrE as $index2 => $value2){ echo "['".substr($daysArrE[$index2],0,5)."','".$WdaysArrE[$index2]."'],"; } ?>],
      
      datasets: 
      [
    {
        label: "complete",
		fill:false,
        backgroundColor: ["#a6d8a6"],
        borderColor: ["#a6d8a6"],
        data: [<?php foreach ($completeArrE as $compE){ echo "'".$compE."',"; } ?>]
    },
    {
        label: "screen out",
		fill:false,
        backgroundColor: ["#fcabab"],
        borderColor: ["#fcabab"],
        data: [<?php foreach ($screenoutArrE as $screenE){ echo "'".$screenE."',"; } ?>]
    },
    {
        label: "quota full",
		fill:false,
        backgroundColor: ["#ffffd8"],
        borderColor: ["#ffffd8"],
        data: [<?php foreach ($fullArrE as $fullE){ echo "'".$fullE."',"; } ?>]
    },
    {
        label: "sospese",
		fill:false,
        backgroundColor: ["#fce9c7"],
        borderColor: ["#fce9c7"],
        data: [<?php foreach ($sospeseArrE as $sospE){ echo "'".$sospE."',"; } ?>]
    },

    {
        label: "contatti",
		fill:false,
        backgroundColor: ["#87b7ff"],
        borderColor: ["#87b7ff"],
        data: [<?php foreach ($contattiArrE as $concatE){ echo "'".$concatE."',"; } ?>]
    },

      ]
    },
    options: {
        animation:{
        animateRotate: true,
        render: false,
    },

    title: {
            display: true,
            fontSize:16,
            text: 'Panel Esterni'
        }

    }
});


// chart status field   
new Chart(document.getElementById("lineaIrE"), {
    type: 'line',
    data: {
      labels: [<?php foreach ($days2ArrE as $index => $value){ echo "['".substr($days2ArrE[$index],0,5)."','".$WdaysArrE[$index]."'],"; } ?>],
      
      datasets: 
      [
    {
        label: "IR Ricerca",
		fill:false,
        backgroundColor: ["#a6d8a6"],
        borderColor: ["#a6d8a6"],
        data: [<?php foreach ($redArrE as $redE){ echo "'".$redE."',"; } ?>]
    }

      ]
    },
    options: {
        animation:{
        animateRotate: true,
        render: false,
    },

    title: {
            display: true,
            fontSize:16,    
            text: 'Panel Esterni'
        }

    }
});


</script>