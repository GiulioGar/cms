<?php
require_once('../Connections/admin.php'); 
require_once('inc_auth.php'); 

require_once('inc_taghead.php');
require_once('inc_tagbody.php'); 

// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

$mesecorrente=date('m');
$annocorrente=date('Y');

@$modCosti = $_REQUEST['modCosti'];
$eti2=$_REQUEST['eti2'];
$eti3=$_REQUEST['eti3'];
$eti4=$_REQUEST['eti4'];
$eti5=$_REQUEST['eti5'];
$eti6=$_REQUEST['eti6'];
$eti7=$_REQUEST['eti7'];
$etiR=$_REQUEST['etiR'];

$jsonString = file_get_contents('referal.json');
$data = json_decode($jsonString, true);

// MODIFICA JSON

// Itera attraverso ogni elemento dell'array referal
foreach ($data['referal'] as $referal) {
  // Aggiungi la spesa corrente alla somma totale
  $sumSpesa += (int)$referal['spesa'];
}

$difSpesa=15000-$sumSpesa;

if ($modCosti=="Modifica")
{
  if (!empty($eti2)) { $data['referal'][0]["spesa"]=$eti2; }
  if (!empty($eti3)) { $data['referal'][1]["spesa"]=$eti3; }
  if (!empty($eti4)) { $data['referal'][2]["spesa"]=$eti4; }
  if (!empty($eti5)) { $data['referal'][3]["spesa"]=$eti5; }
  if (!empty($eti6)) { $data['referal'][4]["spesa"]=$eti6; }
  if (!empty($etiA)) { $data['referal'][6]["spesa"]=$etiA; }
  if (!empty($etiR)) { $data['referal'][5]["spesa"]=$etiR; }


?>

<script>
$.ajaxSetup({
  cache:false
});

</script>
<?php
}

$newJsonString = json_encode($data);
file_put_contents('referal.json', $newJsonString);


// Inizializza gli array per le spese e le percentuali
$num_ref = [];
$num_ref_a = [];
$perc_ref = [];
$csv_data = [];
$details_data = [];

// Inizializza le variabili per la somma totale delle referenze
$total_num_ref = 0;
$total_num_ref_a = 0;

// Definisci l'anno corrente
$annocorrente = date("Y");

// Funzione per eseguire una query e ottenere il numero di righe
function get_num_rows($admin, $query) {
    $result = mysqli_query($admin, $query);
    if ($result) {
        return mysqli_num_rows($result);
    } else {
        echo "Error executing query: " . mysqli_error($admin) . "\n";
        return 0;
    }
}

// Funzione per ottenere i dettagli delle azioni
function get_action_details($admin, $query) {
    $result = mysqli_query($admin, $query);
    $details = [
        'NactA' => 0,
        'NactB' => 0,
        'NactC' => 0,
        'NactD' => 0,
        'NactE' => 0,
        'perc_NactA' => 0,
        'perc_NactB' => 0,
        'perc_NactC' => 0,
        'perc_NactD' => 0,
        'perc_NactE' => 0
    ];

    while ($row = mysqli_fetch_assoc($result)) {
        if ($row['actions'] == 0) {
            $details['NactA'] += $row['nref'];
        } elseif ($row['actions'] >= 1 && $row['actions'] <= 2) {
            $details['NactB'] += $row['nref'];
        } elseif ($row['actions'] >= 3 && $row['actions'] <= 5) {
            $details['NactC'] += $row['nref'];
        } elseif ($row['actions'] >= 6 && $row['actions'] <= 9) {
            $details['NactD'] += $row['nref'];
        } else {
            $details['NactE'] += $row['nref'];
        }
    }
    return $details;
}

// Funzione per creare il CSV
function create_csv($admin, $query) {
    $result = mysqli_query($admin, $query);
    $csv = "uid;email;firstName;type;points\n";
    while ($row = mysqli_fetch_assoc($result)) {
        $uid = $row['user_id'];
        $mail = $row['email'];
        $nome = $row['first_name'];
        $punti = 500;
        $type = "Bonus di Benvenuto";
        $csv .= "$uid;$mail;$nome;$type;$punti\n";
    }
    return $csv;
}

// Itera su ogni referenza dal file JSON per eseguire le query e calcolare le percentuali
foreach ($data['referal'] as $referal) {
    $ref = $referal['ref'];
    $spesa = $referal['spesa'];

    $query_num_ref = "SELECT * FROM t_user_info WHERE reg_date LIKE '%$annocorrente%' AND provenienza='$ref'";
    $query_num_ref_a = "SELECT * FROM t_user_info WHERE reg_date LIKE '%$annocorrente%' AND provenienza='$ref' AND actions>0";
    $query_actions = "SELECT actions, COUNT(*) as nref FROM t_user_info WHERE reg_date LIKE '%$annocorrente%' AND provenienza='$ref' GROUP BY actions";

    $num_ref[$ref] = get_num_rows($admin, $query_num_ref);
    $num_ref_a[$ref] = get_num_rows($admin, $query_num_ref_a);
    $details_data[$ref] = get_action_details($admin, $query_actions);

    $details_data[$ref]['perc_NactA'] = $num_ref[$ref] > 0 ? ceil($details_data[$ref]['NactA'] / $num_ref[$ref] * 100) : 0;
    $details_data[$ref]['perc_NactB'] = $num_ref[$ref] > 0 ? ceil($details_data[$ref]['NactB'] / $num_ref[$ref] * 100) : 0;
    $details_data[$ref]['perc_NactC'] = $num_ref[$ref] > 0 ? ceil($details_data[$ref]['NactC'] / $num_ref[$ref] * 100) : 0;
    $details_data[$ref]['perc_NactD'] = $num_ref[$ref] > 0 ? ceil($details_data[$ref]['NactD'] / $num_ref[$ref] * 100) : 0;
    $details_data[$ref]['perc_NactE'] = $num_ref[$ref] > 0 ? ceil($details_data[$ref]['NactE'] / $num_ref[$ref] * 100) : 0;

    $csv_data[$ref] = create_csv($admin, $query_num_ref);

    $total_num_ref += $num_ref[$ref];
    $total_num_ref_a += $num_ref_a[$ref];
}

//% attivi
$mediaAct=($total_num_ref_a/$total_num_ref)*100;
$mediaAct=round($mediaAct, 2);

 //cpi Medio
 $mediaCpi=$sumSpesa/$total_num_ref;
 $mediaCpi=round($mediaCpi, 2);

 $mediaCpiA=$sumSpesa/$total_num_ref_a;
 $mediaCpiA=round($mediaCpiA, 2);

?>

<script>
let num_ref = <?php echo json_encode($num_ref); ?>;
let num_ref_a = <?php echo json_encode($num_ref_a); ?>;
let perc_ref = <?php echo json_encode($perc_ref); ?>;
let details_data = <?php echo json_encode($details_data); ?>;
let csv_data = <?php echo json_encode($csv_data); ?>;
let total_num_ref = <?php echo $total_num_ref; ?>;
let total_num_ref_a = <?php echo $total_num_ref_a; ?>;
</script>


<div class="content-wrapper">
<div class="container">

<div class="row">

<div class="col-xl-12 col-lg-5 datisync"> 
<div class="card shadow mb-12 ">

   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<div col-xs-6>
</div>
 
 


  <div class="col col-xs-6 text-right">
      <?php 
      require_once('modifica_ref.php');
      ?>
	</div>
 </div>

<div class="card-body">  

<div class="row">

<div class="col-md-12">

<table  class="table">
  <thead class="table-primary">
    <tr>
      <th scope="col">Budget</th>
      <th scope="col">Speso</th>
      <th scope="col">Resto</th>
      <th scope="col">&nbsp;</th>
      <th scope="col">Isritti</th>
      <th scope="col">CPI Medio</th>
      <th scope="col">Attivi</th>
      <th scope="col">%</th>
      <th scope="col">CPA Medio</th>
    </tr>
  </thead>
  <tbody class="">
<tr>
<td><b>15.000€</b></td>
<td><b><?php echo $sumSpesa ?>€ </b></td>
<td><b><?php echo $difSpesa ?>€</b></td>
<td>&nbsp;</td>
<td><b><?php echo $total_num_ref ?></b></td>
<td><b><?php echo $mediaCpi ?>€</b></td>
<td><b><?php echo $total_num_ref_a ?></b></td>
<td><b><?php echo $mediaAct ?>%</b></td>
<td><b><?php echo $mediaCpiA ?>€</b></td>
</tr>
   
  </tbody>
</table>

<!-- TABELLA DATI  DA  ENGAGE-->

<table  class="table table-striped">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Referente</th>
      <th scope="col">Registrati</th>
      <th scope="col">Attivi</th>
      <th scope="col">%</th>
      <th scope="col">CPI TOT</th>
      <th scope="col">CPI REALE</th>
      <th scope="col">Costo</th>
      <th scope="col">Download</th>
    </tr>
  </thead>
  <tbody class="reference"></tbody>

   
  </tbody>
</table>

</div>




</div>

</div>




</div>
</div>

</div>

 <!-- DETTAGLI CAMPANGE -->
 <div class="row">

<div class="col-xl-12 col-lg-5 datisync"> 
<div class="card shadow mb-12 ">

   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
	<div col-xs-6><h6 class="m-0 font-weight-bold text-primary"> DETTAGLI - CAMPAGNE <?php echo $annocorrente ?> &nbsp; <span style="float:right"> <i class="fas fa-info-circle"></i></span> </h6></div>
  <div class="col col-xs-6 text-right">
	<?php require_once('modifica_ref.php'); ?>
	</div>
 </div>

<div class="card-body">  

<div class="row details"> </div>

</div>
</div>
</div>


</div>

</div>

<script>
$(document).ready(function() {
    function addrows() {
        $.getJSON('referal.json', function(data) {
            $.each(data.referal, function(key, val) {
                let ref = val.ref;

                // Reset info variables to ensure they are correctly set for each reference
                let info1 = 0;
                let info2 = 0;
                let info3 = 0;
                let info5 = 0;
                let info6 = 0;
                let info7 = 0;
                let csv = "N.D.";

                // Assign the correct values from the JavaScript variables
                if (num_ref.hasOwnProperty(ref)) {
                    info1 = num_ref[ref];
                }
                if (num_ref_a.hasOwnProperty(ref)) {
                    info2 = num_ref_a[ref];
                }
                if (perc_ref.hasOwnProperty(ref)) {
                    info3 = perc_ref[ref];
                }
                if (csv_data.hasOwnProperty(ref)) {
                    csv = csv_data[ref];
                }
                if (info1 > 0) {
                    info5 = (val.spesa / info1).toFixed(2);
                }
                if (info2 > 0) {
                    info6 = (val.spesa / info2).toFixed(2);
                }
                info7 = val.spesa;

                console.log(`Adding row for ${ref}: info1=${info1}, info2=${info2}`);

                $("tbody.reference").append(`
                    <tr>
                        <th scope="row">${val.id} - ${val.title}</th>
                        <td>${info1}</td>
                        <td>${info2}</td>
                        <td>${info3}</td>
                        <td>${info5}€</td>
                        <td>${info6}€</td>
                        <td>${info7}€</td>
                        <td>
                            <form action="csv.php" method="post" target="_blank">
                                <input type="hidden" name="csv" value="${csv}" />
                                <input type="hidden" name="filename" value="bonus${val.title}" />
                                <input type="hidden" name="filetype" value="campione" />
                                <input style="width:40px; height:30px" class="form-control" type="image" value="submit" src="img/csv.png" />
                            </form>
                        </td>
                    </tr>
                `);
            });
        });
    }

    function addDetails() {
        $.getJSON('referal.json', function(data) {
            $.each(data.referal, function(key, val) {
                let ref = val.ref;
                let details = details_data[ref];
                let info4 = `
                    <tr style="background-color:#f9aeae">
                        <td>Nessuna(0)</td>
                        <td>${details.NactA}</td>
                        <td><b>${details.perc_NactA}%</b></td>
                    </tr>
                    <tr style="background-color:#ffde7c">
                        <td>Bassa(1-2)</td>
                        <td>${details.NactB}</td>
                        <td><b>${details.perc_NactB}%</b></td>
                    </tr>
                    <tr style="background-color:#ffff7c">
                        <td>Media(3-5)</td>
                        <td>${details.NactC}</td>
                        <td><b>${details.perc_NactC}%</b></td>
                    </tr>
                    <tr style="background-color:#cfff7c">
                        <td>Buona(6-9)</td>
                        <td>${details.NactD}</td>
                        <td><b>${details.perc_NactD}%</b></td>
                    </tr>
                    <tr style="background-color:#9DCE6B">
                        <td>Ottima(+9)</td>
                        <td>${details.NactE}</td>
                        <td><b>${details.perc_NactE}%</b></td>
                    </tr>
                `;

                console.log(`Adding details for ${val.title}`);

                $("div.details").append(`
                    <div class="col-xl-3 col-lg-5 datisync">
                        <div class="card shadow mb-12">
                            <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                                <h6 class="m-0 font-weight-bold text-primary">${val.title} ${new Date().getFullYear()} &nbsp; <span style="float:right"><i class="${val.icon}"></i></span></h6>
                            </div>
                            <div class="card-body">
                                <table class="table">
                                    <thead class="thead-light">
                                        <tr>
                                            <th scope="col">Attività</th>
                                            <th scope="col">Utenti</th>
                                            <th scope="col">%</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ${info4}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                `);
            });
        });
    }

    console.log(`Total num_ref: ${total_num_ref}`);
    console.log(`Total num_ref_a: ${total_num_ref_a}`);

    addrows();
    addDetails();
});
</script>




<?php 

require_once('inc_footer.php');

?>