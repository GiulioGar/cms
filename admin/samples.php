<?php
require_once('../Connections/admin.php'); 
$fl_sample = glob('/var/imr/fields/MWB/ITA1411148/samples/*.txt');
$contatti_sample=count($fl_sample);
$sid="ITA1411148";
echo "NUMERO CAMPIONI:".$contatti_sample."<br><br><br>";
for ($i = 0; $i < $contatti_sample; $i++) 
{
//conto righe contenuto nel file (tolgo 1 perchè la prima riga è l'intestazione)
$abilitati_sample=count(file($fl_sample[$i]))-1;

//mi ricavo la data di creazione del file
$data_creazione_file=date("d/m/Y H:i:s", filemtime($fl_sample[$i]));

echo "<b>".$fl_sample[$i]."</b> creato il ".$data_creazione_file."  Abilitati:".$abilitati_sample."<br><br>";

//inserisco riga per riga in vettore
$righe_sample = file($fl_sample[$i]);



for ($j=1; $j<=$abilitati_sample; $j++)
{

//prendo singola riga
$riga_sample=$righe_sample[$j];

//divido il testo in array stabilendo come separatore il punto e virgola
$id_sample = explode(";", $riga_sample);
echo $id_sample[0]."<br>";


mysqli_select_db($database_admin, $admin);
$query_aggiorna_statistiche_sample = "UPDATE t_respint set data_abilitazione='".$data_creazione_file."' where (sid='".$sid."' and uid='".$id_sample[0]."' and ((data_abilitazione is NULL) or (data_abilitazione ='')))";
$aggiorna_statistiche_sample = mysqli_query($query_aggiorna_statistiche_sample, $admin) or die(mysql_error());
$aggiorna_statistiche_t_sample = mysqli_fetch_assoc($aggiorna_statistiche_sample);


}


}

?>

