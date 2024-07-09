<?php
require_once('../Connections/admin.php'); 
require_once('inc_auth.php'); 

$data=date("Y-m-d");

// Imposta il valore di default dell'anno
$default_anno = date("Y");

// Ottieni l'anno dalla richiesta AJAX
$cerca_anno_originale = isset($_REQUEST['Canno']) ? $_REQUEST['Canno'] : '';
$cerca_anno = $cerca_anno_originale;

if ($cerca_anno == "") {
    $cerca_anno = $default_anno;
} else {
    $cerca_anno = $cerca_anno;
}
					
echo "<table id='tabField' style='font-size:11px; text-align:center' class='table table-striped table-hover'>
<thead>
<th colspan='10' style='font-size:18px; color:red; text-align:left'>
    Anno: 
    <select class='Canno'>
        ";
            $currentYear = date("Y");
            for ($i = $currentYear; $i >= $currentYear - 5; $i--) {
                echo "<option value='$i'" . ($i == $cerca_anno ? " selected" : "") . ">$i</option>";
            }
        echo "
    </select>

</th>
<th style='vertical-align:middle' colspan='7'>
    <div class='alert alert-secondary mess2' role='alert' style='display:none'> Caricamento in corso... </div>
</th>
<tr class='intesta'>
<td style='font-weight:bold'>Mese</td>
<td style='font-weight:bold'>Ricerche</td>
<td style='font-weight:bold'>Panel %</td>
<td style='font-weight:bold'>Complete</td>
<td style='font-weight:bold'>Costi</td>
<td style='font-weight:bold'>Tot.Iscritti</td>
<td style='font-weight:bold'>Attivi</td>
<td style='font-weight:bold'>% Attivi</td>
<td style='font-weight:bold'>Registrati</td>
<td style='font-weight:bold'>Premi richiesti</td>
</tr>
</thead>
<tbody>";

$arrNum = array("01","02","03","04","05","06","07","08","09","10","11","12");
$arrMes = array("Gennaio", "Febbraio","Marzo","Aprile","Maggio","Giugno","Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre");

$cic = 0;
foreach ($arrNum as $value) {
    /*statistiche ricerche */
    $query_ricerche = "SELECT * FROM millebytesdb.t_panel_control WHERE panel=1 AND end_field LIKE '$cerca_anno-$value%'";
    $tot_ricerche = mysqli_query($admin, $query_ricerche);

    $contaRic = 0;
    $completeM = 0;
    $panelM = 0;
    $costiM = 0;
    $mese = $arrMes[$cic];

    while ($row = mysqli_fetch_assoc($tot_ricerche)) {
        $contaRic++;
        $completeM += $row['complete_int'];
        $panelM += $row['red_panel'];
        $costiM += $row['costo'];
    }
    if ($contaRic > 0)  $panelM = $panelM / $contaRic;

    /*statistiche premi */
    $query_premi = "SELECT COUNT(user_id) as total FROM millebytesdb.t_user_history WHERE event_type='withdraw' AND event_date LIKE '$cerca_anno-$value%'";
    $tot_premi = mysqli_query($admin, $query_premi);
    $tot_premi_ass = mysqli_fetch_assoc($tot_premi);
	//echo $query_premi."<br/>";

    /*nuovi registrati */
    $query_reg = "SELECT COUNT(user_id) as totalreg FROM millebytesdb.t_user_info WHERE reg_date LIKE '$cerca_anno-$value%'";
    $query_copia_reg_sample = mysqli_query($admin, $query_reg);
    $query_copia_reg_sample_t = mysqli_fetch_assoc($query_copia_reg_sample);

    /*totali*/
    $query_user = "SELECT COUNT(*) as totalIsc FROM t_user_info WHERE active='1' AND reg_date <= '$cerca_anno-$value'";
    $tot_user = mysqli_query($admin, $query_user);
    $tot_use = mysqli_fetch_assoc($tot_user);

    /*attività */
    $query_user = "SELECT COUNT(DISTINCT story.user_id) as totalAtt FROM millebytesdb.t_user_history AS story, t_user_info AS info WHERE info.active='1' AND story.user_id=info.user_id AND story.event_date LIKE '$cerca_anno-$value%' AND story.event_type <>'subscribe' ORDER BY story.event_date";
    $tot_att = mysqli_query($admin, $query_user);
    $tot_act = mysqli_fetch_assoc($tot_att);
    $percAtt = 0;
    if ($tot_use['totalIsc'] > 0) {
        $percAtt = $tot_act['totalAtt'] / $tot_use['totalIsc'] * 100;
    }

    /* stampa la tabella */
    echo "<tr class='rowSur'>";
    echo "<td>$mese</td>";
    echo "<td>$contaRic</td>";
    echo "<td>" . substr($panelM, 0, 4) . "%</td>";
    echo "<td>$completeM</td>";
    echo "<td>$costiM&euro;</td>";
    echo "<td>" . $tot_use['totalIsc'] . "</td>";
    echo "<td>" . $tot_act['totalAtt'] . "</td>";
    echo "<td>" . substr($percAtt, 0, 4) . "%</td>";
    echo "<td>" . $query_copia_reg_sample_t['totalreg'] . "</td>";
    echo "<td>" . $tot_premi_ass['total'] . "</td>";
    echo "</tr>";

    $cic++;
}

echo "</tbody></table>";