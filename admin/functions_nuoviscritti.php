<?php 
require_once('../Connections/admin.php'); 
require_once('inc_auth.php');

$total_count=0;
$contaiscrittimese1=0;
$contaiscrittimese2=0;
$contaiscrittimese3=0;
$contaiscrittimese4=0;
$contaiscrittimese5=0;
$contaiscrittimese6=0;

$mesecorrente=date('m');
$annocorrente=date('Y');

//echo "Giorno: ".$giorno." Mese: ".$mese." Anno: ".$anno;

$mese=$_REQUEST['mese'];
if ($mese==""){$mese=$mesecorrente;}


$anno=$_REQUEST['anno'];
if ($anno==""){$anno=$annocorrente;}



$giorno=01;

$giorni = array('Domenica','Lunedì','Martedì','Mercoledì','Giovedì','Venerdì','Sabato');



//echo $giorni[date('w',strtotime($data))]; 

///RICAVO PRIMO GIORNO
$data = "".$anno."-".$mese."-".$giorno; $giorno_n=date('w',strtotime($data));
$giorno_n=date('w',strtotime($data));


$giornimese = date("t",strtotime($data));

// Esegui la query
$query = "SELECT DISTINCT provenienza FROM t_user_info";
$result = mysqli_query($admin, $query);

// Array per memorizzare le stringhe filtrate
$filtered_results = array();
$user_counts = array(); // Array per memorizzare il conteggio degli utenti

// Parole chiave da cercare
$keywords = array('ref', 'react', 'website', 'app');

// Elabora i risultati della query
while ($row = mysqli_fetch_assoc($result)) {
    $provenienza = $row['provenienza'];
    foreach ($keywords as $keyword) {
        if (stripos($provenienza, $keyword) !== false) {
            $filtered_results[] = $provenienza;
            break; // Esci dal ciclo delle parole chiave se una corrispondenza è trovata
        }
    }
}

// Array per memorizzare i conteggi aggregati
$aggregated_counts = [
    'website_app_ref2' => 0
];

// Esegui una query per ogni elemento di $filtered_results per ottenere il conteggio degli utenti
foreach ($filtered_results as $provenienza) {
    $query_count = "SELECT COUNT(*) AS count 
                    FROM t_user_info 
                    WHERE active=1 
                      AND email NOT LIKE '%.top' 
                      AND provenienza='$provenienza' 
                      AND MONTH(reg_date) = '$mese' 
                      AND YEAR(reg_date) = '$anno'";
    $result_count = mysqli_query($admin, $query_count);

    if ($result_count) {
        $row_count = mysqli_fetch_assoc($result_count);
        $count = $row_count['count'];

        // Aggrega i conteggi per website, app e ref2
        if (stripos($provenienza, 'website') !== false || stripos($provenienza, 'app') !== false || stripos($provenienza, 'ref2') !== false) {
            $aggregated_counts['website_app_ref2'] += $count;
        } else {
            $user_counts[$provenienza] = $count;
        }
    } else {
        // Se la query fallisce, imposta il conteggio a 0
        if (stripos($provenienza, 'website') !== false || stripos($provenienza, 'app') !== false || stripos($provenienza, 'ref2') !== false) {
            $aggregated_counts['website_app_ref2'] += 0;
        } else {
            $user_counts[$provenienza] = 0;
        }
    }
}

// Query per ottenere il conteggio totale
$queryCount = "SELECT COUNT(*) as total_count FROM t_user_info WHERE MONTH(reg_date) = ? AND YEAR(reg_date) = ?";
$stmtCount = $admin->prepare($queryCount);
$stmtCount->bind_param("ii", $mese, $anno); // Assicurati che i parametri siano interi
$stmtCount->execute();
$resultCount = $stmtCount->get_result();
$rowCount = $resultCount->fetch_assoc();
$total_count = $rowCount['total_count'];

// Query per ottenere le date di registrazione
$queryDates = "SELECT reg_date FROM t_user_info WHERE MONTH(reg_date) = ? AND YEAR(reg_date) = ?";
$stmtDates = $admin->prepare($queryDates);
$stmtDates->bind_param("ii", $mese, $anno); // Assicurati che i parametri siano interi
$stmtDates->execute();
$resultDates = $stmtDates->get_result();

// Inizializza l'array per memorizzare i timestamp delle iscrizioni
$iscritti = [];

// Fetch delle date di registrazione e conversione a timestamp
while ($rowDates = $resultDates->fetch_assoc()) {
    $giornoiscrizione = $rowDates['reg_date'];
    $timestamp = strtotime($giornoiscrizione);
    $iscritti[] = $timestamp; // Aggiungi il timestamp all'array
}

// Stampa l'array degli iscritti
print_r($iscritti);

?>

<table id="tabIscritti" class='table table-striped table-bordered table-hover' cellpadding="5">
<thead>
	<tr>
		<th colspan="8"><h3>Registrati Totali: <span class="badge badge-light"><?php echo $total_count ?> </span></h3></th>
	</tr>
    <tr>
        <?php 
        $column_count = 0; // Inizializza il contatore delle colonne
        $total_elements = count($user_counts) + 1; // Numero totale di elementi inclusa la parte aggregata
        $class_index = 0; // Indice per i colori
        
        // Funzione per generare colori dinamici
        function getColor($index, $total) {
            $hue = 240 - ($index / $total) * 40; // Hue compreso tra 200 e 240
            return "hsl($hue, 70%, 50%)";
        }
        
        // Funzione per ottenere nomi personalizzati
        function getCustomName($provenienza) {
            switch ($provenienza) {
                case 'ref3':
                    return 'MVF';
                case 'ref4':
                    return 'EmyOri';
                case 'ref5':
                    return 'AdviceMe';
                case 'ref6':
                    return 'BigDLead';
				case 'ref66':
						return 'BigDSito';
				case 'ref666':
					     return 'BigDDem';
				case 'react':
							return 'Riattivi';	
				case 'ref9':
							return 'Bagnato';			
                default:
                    return ucfirst($provenienza);
            }
        }
        
        // Aggiungi la parte aggregata come primo elemento
        if ($column_count % 8 == 0 && $column_count > 0) {
            echo '</tr><tr>'; // Chiudi la riga precedente e inizia una nuova riga
        }
        $color = getColor($class_index, $total_elements);
        ?>
        <th>
            <button type="button" class="btn" style="background-color: <?php echo $color; ?>; color: #fff;">
                <b>Social</b> <span class="badge badge-light"><?php $totalGruop += $aggregated_counts['website_app_ref2']; echo htmlspecialchars($aggregated_counts['website_app_ref2']);  ?></span>
            </button>
        </th>
        <?php 
        $column_count += 1; // Aggiungi 1 al conteggio delle colonne per la parte aggregata
        $class_index++; // Incrementa l'indice per cambiare il colore
        
        // Ciclo per le altre provenienze
        foreach ($user_counts as $provenienza => $count): 
            if ($column_count % 8 == 0): // Ogni 8 colonne, inizia una nuova riga
                echo '</tr><tr>'; // Chiudi la riga precedente e inizia una nuova riga
            endif;
            $color = getColor($class_index, $total_elements);
            $custom_name = getCustomName($provenienza);
        ?>
        <th>
            <button type="button" class="btn" style="background-color: <?php echo $color; ?>; color: fff;">
                <b><?php echo htmlspecialchars($custom_name); ?> </b><span class="badge badge-light"><?php $totalGruop += $count; echo htmlspecialchars($count); ?></span>
            </button>
        </th>
        <?php 
            $column_count += 1; // Aggiungi 1 al conteggio delle colonne
            $class_index++; // Incrementa l'indice per cambiare il colore
        endforeach; 
		?>
		 <th>
            <button type="button" class="btn" style="background-color: <?php echo $color; ?>; color: #fff;">
                <b>Amici</b> <span class="badge badge-light"><?php  
				$totAmici=$total_count-$totalGruop;
				echo htmlspecialchars($totAmici); 
				?></span>
            </button>
        </th>
		<?php
        if ($column_count % 8 != 0) echo '</tr>'; // Chiudi la riga corrente, se non già chiusa
        ?>
    </tr>
</thead>




<tr><td>Lunedi'</td><td>Martedì'</td><td>Mercoledì'</td><td>Giovedì'</td><td>Venerdì'</td><td>Sabato</td><td>Domenica</td><td><b>ISCRITTI</b></td></tr>
<?php
for ($i = 1; $i <= 6; $i++) {
$iscrittisettimana=0;
if ($giorno<=$giornimese)
{
?>
<tr>
<td>
<?php 
if ($giorno_n==1 && $giorno<=$giornimese) {
				  for ($k = 1; $k <= $total_count; $k++) {
															   $timestamp_iscritto=$iscritti[$k];
															   $giorno_iscritto = date('d', $timestamp_iscritto);
															   $giorno_iscritto= intval($giorno_iscritto);
					                                           //echo $giorno_iscritto;
					                                           if ($giorno_iscritto==$giorno){$iscrittisettimana=$iscrittisettimana+1;}
															   
															   }	
				  echo $giorno; 
				  //if ($iscrittisettimana>0) {echo " (".$iscrittisettimana.")";}
				  $giorno=$giorno+1; 
				  $data = "".$anno."-".$mese."-".$giorno; 
				  $giorno_n=date('w',strtotime($data));
				  } 
?>
</td>
<td>
<?php 
if ($giorno_n==2 && $giorno<=$giornimese) {
				  for ($k = 1; $k <= $total_count; $k++) {
															   $timestamp_iscritto=$iscritti[$k];
															   $giorno_iscritto = date('d', $timestamp_iscritto);
															   $giorno_iscritto= intval($giorno_iscritto);
															   //echo $giorno_iscritto;
															   if ($giorno_iscritto==$giorno){$iscrittisettimana=$iscrittisettimana+1;}
															   
															   }
				  echo $giorno; 
				  //if ($iscrittisettimana>0) {echo " (".$iscrittisettimana.")";}
				  $giorno=$giorno+1; 
				  $data = "".$anno."-".$mese."-".$giorno; 
				  $giorno_n=date('w',strtotime($data));
				  } 
?>
</td>
<td>
<?php 
if ($giorno_n==3 && $giorno<=$giornimese) {
				  for ($k = 1; $k <= $total_count; $k++) {
															   $timestamp_iscritto=$iscritti[$k];
															   $giorno_iscritto = date('d', $timestamp_iscritto);
															   $giorno_iscritto= intval($giorno_iscritto);
															   //echo $giorno_iscritto;
															   if ($giorno_iscritto==$giorno){$iscrittisettimana=$iscrittisettimana+1;}
															   
															   }
				  echo $giorno; 
				  //if ($iscrittisettimana>0) {echo " (".$iscrittisettimana.")";}
				  $giorno=$giorno+1; 
				  $data = "".$anno."-".$mese."-".$giorno; 
				  $giorno_n=date('w',strtotime($data));
				  } 
?>
</td>
<td>
<?php 
if ($giorno_n==4 && $giorno<=$giornimese) {
				  for ($k = 1; $k <= $total_count; $k++) {
															   $timestamp_iscritto=$iscritti[$k];
															   $giorno_iscritto = date('d', $timestamp_iscritto);
															   $giorno_iscritto= intval($giorno_iscritto);
															   //echo $giorno_iscritto;
															   if ($giorno_iscritto==$giorno){$iscrittisettimana=$iscrittisettimana+1;}
															   
															   }
															   
				  echo $giorno; 
				  //if ($iscrittisettimana>0) {echo " (".$iscrittisettimana.")";}
				  $giorno=$giorno+1; 
				  $data = "".$anno."-".$mese."-".$giorno; 
			 	  $giorno_n=date('w',strtotime($data));
				  } 
?>
</td>
</td>
<td>
<?php 
if ($giorno_n==5 && $giorno<=$giornimese) {
				  for ($k = 1; $k <= $total_count; $k++) {
															   $timestamp_iscritto=$iscritti[$k];
															   $giorno_iscritto = date('d', $timestamp_iscritto);
															   $giorno_iscritto= intval($giorno_iscritto);
					                                           //echo $giorno_iscritto;
					                                           if ($giorno_iscritto==$giorno){$iscrittisettimana=$iscrittisettimana+1;}
															   
															   }
															   
				  echo $giorno; 
				  //if ($iscrittisettimana>0) {echo " (".$iscrittisettimana.")";}
				  $giorno=$giorno+1; 
				  $data = "".$anno."-".$mese."-".$giorno; 
				  $giorno_n=date('w',strtotime($data));
				  } 
?>
</td>
<td>
<?php 
if ($giorno_n==6 && $giorno<=$giornimese) {
			      for ($k = 1; $k <= $total_count; $k++) {
															   $timestamp_iscritto=$iscritti[$k];
															   $giorno_iscritto = date('d', $timestamp_iscritto);
															   $giorno_iscritto= intval($giorno_iscritto);
															   //echo $giorno_iscritto;
					                                           if ($giorno_iscritto==$giorno){$iscrittisettimana=$iscrittisettimana+1;}
															   
															   }
				  echo $giorno; 
				  //if ($iscrittisettimana>0) {echo " (".$iscrittisettimana.")";}
				  $giorno=$giorno+1; 
				  $data = "".$anno."-".$mese."-".$giorno; 
				  $giorno_n=date('w',strtotime($data));
			      } 
?>
</td>
<td>
<?php 
if ($giorno_n==0 && $giorno<=$giornimese) {
				  for ($k = 1; $k <= $total_count; $k++) {
															   $timestamp_iscritto=$iscritti[$k];
															   $giorno_iscritto = date('d', $timestamp_iscritto);
															   $giorno_iscritto= intval($giorno_iscritto);
															   //echo $giorno_iscritto;
					                                           if ($giorno_iscritto==$giorno){$iscrittisettimana=$iscrittisettimana+1;}
															   
															   }
 			      echo $giorno; 
				  //if ($iscrittisettimana>0) {echo " (".$iscrittisettimana.")";}
			      $giorno=$giorno+1; 
			      $data = "".$anno."-".$mese."-".$giorno; 
			      $giorno_n=date('w',strtotime($data));
				  } 
?>
</td>
<td>
<?php
echo "<b>".$iscrittisettimana."</b>"; 
?>
</td>

</tr>

<?php
}
}
?>
</table>