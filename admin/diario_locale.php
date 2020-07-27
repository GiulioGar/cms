

<div class="row ">

<canvas id="lineaContatti" ></canvas>

</div>




<?php

$daysArr=array();
$WdaysArr=array();
$completeArr=array();
$screenoutArr=array();
$fullArr=array();
$sospeseArr=array();
$contattiArr=array();

							asort($diario);


							foreach ( $diario as $chiave => $valore) 
							{ 
							if ($diario_complete[$chiave]==""){$diario_complete[$chiave]=0;}
							if ($diario_filtrati[$chiave]==""){$diario_filtrati[$chiave]=0;}
							if ($diario_quotafull[$chiave]==""){$diario_quotafull[$chiave]=0;}
							if ($diario_incomplete[$chiave]==""){$diario_incomplete[$chiave]=0;}

							$redemption_field_giornaliero=($diario_complete[$chiave]/($diario_complete[$chiave]+$diario_filtrati[$chiave]))*100;
							$redemption_field_giornaliero=number_format($redemption_field_giornaliero, 2);
							$sumDiaComp=$sumDiaComp+$diario_complete[$chiave];
							$sumDiaFilt=$sumDiaFilt+$diario_filtrati[$chiave];
							$sumDiaQf=$sumDiaQf+$diario_quotafull[$chiave];
							$sumDiaInc=$sumDiaInc+$diario_incomplete[$chiave];
							$sumDiaCont=$diario_complete[$chiave]+$diario_filtrati[$chiave]+$diario_quotafull[$chiave]+$diario_incomplete[$chiave];
							if ($diario_complete[$chiave]==0) { $redemption_field_giornaliero="N.D.";}
                            else { $redemption_field_giornaliero=$redemption_field_giornaliero."%"; }

                            $pieces = explode("-", $chiave);
                            $giorno1=$pieces[0];
                            $mese1=$pieces[1];
                            $anno1=$pieces[2];

                           $wday= giornoSettimana($mese1,$giorno1,$anno1);
                        

                            array_push($WdaysArr,$wday);
                            array_push($daysArr,$chiave);
                            array_push($completeArr,$diario_complete[$chiave]);
                            array_push($screenoutArr,$diario_filtrati[$chiave]);
                            array_push($fullArr,$diario_quotafull[$chiave]);
                            array_push($sospeseArr,$diario_incomplete[$chiave]);
                            array_push($contattiArr,$sumDiaCont);

                         

                            
                            
                            }
?>
<script>

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

    }
});

</script>