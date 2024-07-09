<?php
require_once('../Connections/admin.php'); 
require_once('inc_auth.php'); 

require_once('inc_taghead.php');
require_once('inc_tagbody.php'); 

// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);

$mesecorrente = date('m');
$annocorrente = date('Y');

@$modCosti = $_REQUEST['modCosti'];

// Dynamically create variables for all 'eti' parameters
foreach ($_REQUEST as $key => $value) {
  if (strpos($key, 'eti') === 0) {
    ${$key} = $value;
  }
}

$jsonString = file_get_contents('referal.json');
$data = json_decode($jsonString, true);

// MODIFICA JSON

// Itera attraverso ogni elemento dell'array referal
$sumSpesa = 0;
foreach ($data['referal'] as $referal) {
  // Aggiungi la spesa corrente alla somma totale
  $sumSpesa += (int)$referal['spesa'];
}

$difSpesa = 15000 - $sumSpesa;

if ($modCosti == "Modifica") 
{
  foreach ($data['referal'] as $key => $referal) {
    $id = $referal['id'];
    $spesaVar = 'eti' . $id;

    if (!empty($$spesaVar)) {
      $data['referal'][$key]['spesa'] = $$spesaVar;
    }
  }

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

$num_ref = [];
$num_ref_a = [];
$perc_ref = [];
$csv_data = [];
$details_data = [];

$total_num_ref = 0;
$total_num_ref_a = 0;

$annocorrente = date("Y");

function get_num_rows($admin, $query) {
    $result = mysqli_query($admin, $query);
    if ($result) {
        return mysqli_num_rows($result);
    } else {
        echo "Error executing query: " . mysqli_error($admin) . "\n";
        return 0;
    }
}

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

// Crea una lista di tutte le provenienze da escludere
$provenienze_escluse = array_column($data['referal'], 'ref');
$provenienze_escluse = implode("','", $provenienze_escluse);

foreach ($data['referal'] as $referal) {
    $ref = $referal['ref'];
    $spesa = $referal['spesa'];

    if ($ref == 'ref2') {
        $query_num_ref = "SELECT * FROM t_user_info WHERE reg_date LIKE '%$annocorrente%' AND (provenienza='ref2' OR provenienza='website' OR provenienza='app')";
        $query_num_ref_a = "SELECT * FROM t_user_info WHERE reg_date LIKE '%$annocorrente%' AND (provenienza='ref2' OR provenienza='website' OR provenienza='app') AND actions>0";
        $query_actions = "SELECT actions, COUNT(*) as nref FROM t_user_info WHERE reg_date LIKE '%$annocorrente%' AND (provenienza='ref2' OR provenienza='website' OR provenienza='app') GROUP BY actions";
    } elseif ($ref == 'refAmici') {
        $query_num_ref = "SELECT * FROM t_user_info WHERE reg_date LIKE '%$annocorrente%' AND provenienza NOT IN ('$provenienze_escluse')";
        $query_num_ref_a = "SELECT * FROM t_user_info WHERE reg_date LIKE '%$annocorrente%' AND provenienza NOT IN ('$provenienze_escluse') AND actions>0";
        $query_actions = "SELECT actions, COUNT(*) as nref FROM t_user_info WHERE reg_date LIKE '%$annocorrente%' AND provenienza NOT IN ('$provenienze_escluse') GROUP BY actions";
    } else {
        $query_num_ref = "SELECT * FROM t_user_info WHERE reg_date LIKE '%$annocorrente%' AND provenienza='$ref'";
        $query_num_ref_a = "SELECT * FROM t_user_info WHERE reg_date LIKE '%$annocorrente%' AND provenienza='$ref' AND actions>0";
        $query_actions = "SELECT actions, COUNT(*) as nref FROM t_user_info WHERE reg_date LIKE '%$annocorrente%' AND provenienza='$ref' GROUP BY actions";
    }

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
$mediaAct = ($total_num_ref_a / $total_num_ref) * 100;
$mediaAct = round($mediaAct, 2);

$cpi_medio = $sumSpesa / $total_num_ref;
$cpi_medio = round($cpi_medio, 2);

$cpi_medio_attivi = $sumSpesa / $total_num_ref_a;
$cpi_medio_attivi = round($cpi_medio_attivi, 2);

?>

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

<table class="table">
  <thead class="table-primary">
    <tr>
      <th scope="col">Budget</th>
      <th scope="col">Speso</th>
      <th scope="col">Resto</th>
      <th scope="col">&nbsp;</th>
      <th scope="col">Iscritti</th>
      <th scope="col">CPI Medio</th>
      <th scope="col">Attivi</th>
      <th scope="col">%</th>
      <th scope="col">CPA Medio</th>
    </tr>
  </thead>
  <tbody>
<tr>
<td><b>15.000€</b></td>
<td><b><?php echo $sumSpesa ?>€ </b></td>
<td><b><?php echo $difSpesa ?>€</b></td>
<td>&nbsp;</td>
<td><b><?php echo $total_num_ref ?></b></td>
<td><b><?php echo $cpi_medio ?>€</b></td>
<td><b><?php echo $total_num_ref_a ?></b></td>
<td><b><?php echo $mediaAct ?>%</b></td>
<td><b><?php echo $cpi_medio_attivi ?>€</b></td>
</tr>
   
  </tbody>
</table>

<!-- TABELLA DATI  DA  ENGAGE-->

<table class="table table-striped">
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
  <tbody class="reference">
    <?php
    foreach ($data['referal'] as $referal) {
        $ref = $referal['ref'];
        $costo = $referal['spesa'];
        $num_reg = isset($num_ref[$ref]) ? $num_ref[$ref] : 0;
        $num_act = isset($num_ref_a[$ref]) ? $num_ref_a[$ref] : 0;
        $perc = $num_reg > 0 ? round(($num_act / $num_reg) * 100, 2) : 0;
        $cpi_tot = $num_reg > 0 ? round($costo / $num_reg, 2) : 0;
        $cpi_reale = $num_act > 0 ? round($costo / $num_act, 2) : 0;
       
        
        echo "<tr>
                <td><b>{$referal['title']}</b></td>
                <td>{$num_reg}</td>
                <td>{$num_act}</td>
                <td>{$perc}%</td>
                <td>{$cpi_tot}€</td>
                <td>{$cpi_reale}€</td>
                <td>{$costo}€</td>
                <td><form action='csv.php' method='post' target='_blank'>
                  <input type='hidden' name='csv' value='" . htmlspecialchars($csv_data[$ref]) . "' />
                  <input type='hidden' name='filename' value='bonus_{$ref}' />
                  <input type='hidden' name='filetype' value='campione' />
                  <input style='width:40px; height:30px' class='form-control' type='image' value='submit' src='img/csv.png' />
                </form></td>
              </tr>";
    }
    ?>
  </tbody>
</table>

</div>

</div>

</div>

</div>
</div>

</div>

 <!-- DETTAGLI CAMPAGNE -->
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

<div class="row details"> 

  <?php

foreach ($data['referal'] as $referal) {
    $ref = $referal['ref'];
    $title = $referal['title'];
    $icon = $referal['icon'];

    $NactA = 0;
    $NactB = 0;
    $NactC = 0;
    $NactD = 0;
    $NactE = 0;
    $perc_NactA = 0;
    $perc_NactB = 0;
    $perc_NactC = 0;
    $perc_NactD = 0;
    $perc_NactE = 0;

    // Query per ottenere i dati in base al riferimento
    $query_azioni = "SELECT actions, COUNT(*) as nref FROM t_user_info WHERE reg_date LIKE '%$annocorrente%' AND provenienza='$ref' GROUP BY actions";
    if ($ref == 'ref2') {
      $query_azioni = "SELECT actions, COUNT(*) as nref FROM t_user_info WHERE reg_date LIKE '%$annocorrente%' AND (provenienza='ref2' OR provenienza='website' OR provenienza='app') GROUP BY actions";
    } elseif ($ref == 'refAmici') {
      $provenienze_escluse = array_column($data['referal'], 'ref');
      $provenienze_escluse = implode("','", $provenienze_escluse);
      $query_azioni = "SELECT actions, COUNT(*) as nref FROM t_user_info WHERE reg_date LIKE '%$annocorrente%' AND provenienza NOT IN ('$provenienze_escluse') GROUP BY actions";
    }

    $result_azioni = mysqli_query($admin, $query_azioni);
    if ($result_azioni) {
      while ($row = mysqli_fetch_assoc($result_azioni)) {
        if ($row["actions"] == 0) {
          $NactA += $row["nref"];
          $perc_NactA = ceil($NactA / $num_ref[$ref] * 100);
        } elseif ($row["actions"] >= 1 && $row["actions"] <= 2) {
          $NactB += $row["nref"];
          $perc_NactB = ceil($NactB / $num_ref[$ref] * 100);
        } elseif ($row["actions"] >= 3 && $row["actions"] <= 5) {
          $NactC += $row["nref"];
          $perc_NactC = ceil($NactC / $num_ref[$ref] * 100);
        } elseif ($row["actions"] >= 6 && $row["actions"] <= 9) {
          $NactD += $row["nref"];
          $perc_NactD = ceil($NactD / $num_ref[$ref] * 100);
        } else {
          $NactE += $row["nref"];
          $perc_NactE = ceil($NactE / $num_ref[$ref] * 100);
        }
      }
    }

    echo '
    <div class="col-xl-3 col-lg-5 datisync">
      <div class="card shadow mb-12 ">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary"> ' . $title . ' ' . $annocorrente . ' &nbsp; <span style="float:right"> <i class="' . $icon . '"></i></span> </h6>
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
              <tr style="background-color:#f9aeae">
                <td>Nessuna(0)</td>
                <td>' . $NactA . '</td>
                <td><b>' . $perc_NactA . '%</b></td>
              </tr>
              <tr style="background-color:#ffde7c">
                <td>Bassa(1-2)</td>
                <td>' . $NactB . '</td>
                <td><b>' . $perc_NactB . '%</b></td>
              </tr>
              <tr style="background-color:#ffff7c">
                <td>Media(3-5)</td>
                <td>' . $NactC . '</td>
                <td><b>' . $perc_NactC . '%</b></td>
              </tr>
              <tr style="background-color:#cfff7c">
                <td>Buona(6-9)</td>
                <td>' . $NactD . '</td>
                <td><b>' . $perc_NactD . '%</b></td>
              </tr>
              <tr style="background-color:#9DCE6B">
                <td>Ottima(+9)</td>
                <td>' . $NactE . '</td>
                <td><b>' . $perc_NactE . '%</b></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>';
  }
  ?>



</div>

</div>
</div>
</div>

</div>

</div>

<script>
     $.ajaxSetup({
  cache:false
});
</script>

<?php 

require_once('inc_footer.php');

?>
