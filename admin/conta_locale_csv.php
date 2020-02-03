<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 
	  

$titolo = 'Desktop Gestionale';
$sitowebdiriferimento = 'www.millebytes.com';
$areapagina = "home";
$coldx = "no";
$mesi2=date("Y-m-d H:i:s", mktime(date("H")-6,0,0,date("m")-2,date("d"),date("Y")));
require_once('inc_taghead.php');
require_once('inc_tagbody.php');
$conta_incomplete=0;
$conta_filtrati=0;
$conta_complete=0;
$conta_quotafull=0;
$conta_giorno=0;
$esci=false;
$sid=$_GET['sid'];
$prj=$_GET['prj'];
$data=date("Y-m-d H:i:s");
//echo "la ricerca è:".$sid." ".$prj;

    //Media redemption Panel//
	//anno 2014
	mysqli_select_db($database_admin, $admin);
	$query_conta = "SELECT COUNT(sur_id) as tot  FROM t_panel_control where panel=1 and stato=1 and sur_date like '2014%'";
	$surClo = mysqli_query($query_conta, $admin) or die(mysql_error());
	$cloSur = mysqli_fetch_assoc($surClo);
	
	mysqli_select_db($database_admin, $admin);
	$query_ric = "SELECT * FROM t_panel_control where panel=1 and stato=1 and sur_date like '2014%' ";
	$tot_close = mysqli_query($query_ric, $admin) or die(mysql_error());
	

	while ($row = mysqli_fetch_assoc($tot_close))
		{
		  $totRed=$row['red_panel']+$totRed;
		}
		$medRed=$totRed/$cloSur['tot'];
	
    // ultimi 2 mesi
	$query_conta = "SELECT COUNT(sur_id) as tot  FROM t_panel_control where panel=1 and stato=1 and sur_date > '$mesi2'";
	$surClo2 = mysqli_query($query_conta, $admin) or die(mysql_error());
	$cloSur2 = mysqli_fetch_assoc($surClo2);
	
	mysqli_select_db($database_admin, $admin);
	$query_m2 = "SELECT * FROM t_panel_control where panel=1 and stato=1 and sur_date > '$mesi2' ";
	$m2_close = mysqli_query($query_m2, $admin) or die(mysql_error());
	

	while ($row = mysqli_fetch_assoc($m2_close))
		{
		  $totRed2=$row['red_panel']+$totRed2;
		}
		$medRed2=$totRed2/$cloSur2['tot'];

//ABILITATI PANEL INTERNO
mysqli_select_db($database_admin, $admin);
$query_user_abilitati = "SELECT count(*) as total FROM t_respint where ((sid='".$sid."') AND (uid NOT LIKE 'IDEX%'))";
$tot_user_abilitati = mysqli_query($query_user_abilitati, $admin) or die(mysql_error());
$tot_use_abilitati = mysqli_fetch_assoc($tot_user_abilitati);


//ABILITATI PANEL ESTERNO
mysqli_select_db($database_admin, $admin);
$query_user_abilitati_ssi = "SELECT count(*) as total FROM t_respint where ((sid='".$sid."') AND (uid LIKE 'IDEX%'))";
$tot_user_abilitati_ssi = mysqli_query($query_user_abilitati_ssi, $admin) or die(mysql_error());
$tot_use_abilitati_ssi = mysqli_fetch_assoc($tot_user_abilitati_ssi);


//ABILITATI TOTALE
mysqli_select_db($database_admin, $admin);
$query_user_abilitati_totali = "SELECT count(*) as total FROM t_respint where (sid='".$sid."')";
$tot_user_abilitati_totali = mysqli_query($query_user_abilitati_totali, $admin) or die(mysql_error());
$tot_use_abilitati_totali = mysqli_fetch_assoc($tot_user_abilitati_totali);



mysqli_select_db($database_admin, $admin);
$query_new = "SELECT *  FROM t_user_info as info, t_respint as respint where (respint.sid='".$sid."' AND respint.uid=info.user_id AND (status='1' or status='0')) limit 50000";
$csv_mvf = mysqli_query($query_new, $admin) or die(mysql_error());


//// ESPORTA CAMPIONE MVF IN CSV ////


    @$csv="uid;email;firstName;genderSuffix";
    $csv .= "\n";
    while ($row = mysqli_fetch_assoc($csv_mvf)) 
    { 
            
            $uid=$row['user_id'];
            $mail=$row['email'];
            $nome=$row['first_name'];
            $sesso=$row['gender'];
            if($sesso==1){$genderTransform="o";}
            else {$genderTransform="a";}
            
            $csv .=$uid.";".$mail.";".$nome.";".$genderTransform; 
            $csv .= "\n";
    } 





mysqli_select_db($database_admin, $admin);
$query_last_update = "SELECT * FROM t_panel_control where (sur_id='".$sid."')";
$last_update = mysqli_query($query_last_update, $admin) or die(mysql_error());
$lu = mysqli_fetch_assoc($last_update);
$data_odierna=date("Y-m-d H:i:s");
$ultimo_aggiornamento=$lu['last_update'];
$salva_abilitati=$lu['abilitati'];
$stato_ricerca=$lu['stato'];
$leggi_abilitati_aggiornati=$lu['abilitati_aggiornati'];
$target_sesso=$lu['sex_target'];
$target_age_1=$lu['age1_target'];
$target_age_2=$lu['age2_target'];
$panel_in=$lu['panel'];






if ($stato_ricerca != 1)
{


//ELIMINO RECORD
$query_pulisci_respint_copy="DELETE FROM t_abilitatiPanel WHERE (sid='".$sid."')";
$query_pulisci_respint_copy_sample = mysqli_query($query_pulisci_respint_copy, $admin) or die(mysql_error());
$query_pulisci_respint_copy_sample_t = mysqli_fetch_assoc($query_pulisci_respint_copy_sample);

//RICOPIO
$query_copia_respint_copy="INSERT t_abilitatiPanel (sid, uid, prj_name)
SELECT sid, uid, prj_name
FROM t_respint
WHERE sid = '".$sid."'";
$query_copia_respint_copy_sample = mysqli_query($query_copia_respint_copy, $admin) or die(mysql_error());
$query_copia_respint_copy_sample_t = mysqli_fetch_assoc($query_copia_respint_copy_sample);




//AGGIORNAMENTO DATA IN RESPINT//
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$fl_sample = glob('/var/imr/fields/'.$prj.'/'.$sid.'/samples/*.txt');
$contatti_sample=count($fl_sample);
//$sid="ITA1411148";
//echo "NUMERO CAMPIONI:".$contatti_sample."<br><br><br>";
for ($i = 0; $i < $contatti_sample; $i++) 
{
//conto righe contenuto nel file (tolgo 1 perchè la prima riga è l'intestazione)
$abilitati_sample=count(file($fl_sample[$i]))-1;

//mi ricavo la data di creazione del file
$data_creazione_file=date("d/m/Y H:i:s", filemtime($fl_sample[$i]));

//echo "<b>".$fl_sample[$i]."</b> creato il ".$data_creazione_file."  Abilitati:".$abilitati_sample."<br><br>";

//inserisco riga per riga in vettore
$righe_sample = file($fl_sample[$i]);



for ($j=1; $j<=$abilitati_sample; $j++)
{

//prendo singola riga
$riga_sample=$righe_sample[$j];

//divido il testo in array stabilendo come separatore il punto e virgola
$id_sample = explode(";", $riga_sample);
//echo $id_sample[0]."<br>";




mysqli_select_db($database_admin, $admin);
$query_aggiorna_statistiche_sample = "UPDATE t_abilitatiPanel set data_abilitazione='".$data_creazione_file."' where (sid='".$sid."' and uid='".$id_sample[0]."' and ((data_abilitazione is NULL) or (data_abilitazione ='')))";
$aggiorna_statistiche_sample = mysqli_query($query_aggiorna_statistiche_sample, $admin) or die(mysql_error());
$aggiorna_statistiche_t_sample = mysqli_fetch_assoc($aggiorna_statistiche_sample);




}


}
}
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////














if ($lu['abilitati'] != 0)
{
if (($lu['abilitati'] != $tot_use_abilitati['total'])) 
{
// se già siamo a conoscenza dell'aggiornamento 
if ($leggi_abilitati_aggiornati==$tot_use_abilitati['total']) 
{
$data=$lu['last_update'];
}
else
{
	//solo se stato ricerca è aperta
	if ($stato_ricerca != 1)
	{

	$aggiorna_abilitati=$tot_use_abilitati['total'];
	$data=date("Y-m-d H:i:s");
	mysqli_select_db($database_admin, $admin);
	$query_aggiorna_abilitati_aggiornati = "UPDATE t_panel_control set abilitati_aggiornati='".$aggiorna_abilitati."' where sur_id='".$sid."'";
	$aggiorna_abilitati_query = mysqli_query($query_aggiorna_abilitati_aggiornati, $admin) or die(mysql_error());
	$aggiorna_abilitati_query_esegui = mysqli_fetch_assoc($aggiorna_abilitati_query);
	}
}
//echo "<br>Numero abilitati modificato";
$aggiornamento=true;
}
else
{
$data=$lu['last_update'];
//echo "<br>Numero abilitati non modificato";
$aggiornamento=false;
}
}
else
{
if ($stato_ricerca != 1)
	{
	$aggiorna_abilitati=$tot_use_abilitati['total'];
	mysqli_select_db($database_admin, $admin);
	$query_aggiorna_abilitati_aggiornati = "UPDATE t_panel_control set abilitati_aggiornati='".$aggiorna_abilitati."', abilitati='".$aggiorna_abilitati."' where sur_id='".$sid."'";
	$aggiorna_abilitati_query = mysqli_query($query_aggiorna_abilitati_aggiornati, $admin) or die(mysql_error());
	$aggiorna_abilitati_query_esegui = mysqli_fetch_assoc($aggiorna_abilitati_query);
	}
}

//echo "<br>Ultimo aggiornamento:".$ultimo_aggiornamento;
//echo "<br>Data odierna:".$data;
$confrontodata=(strtotime($data_odierna))-(strtotime($data));
$ore_differenza=($confrontodata/60)/60;
//echo "<br>Differenza:".(($confrontodata/60)/60)." ore";

//recupero tutti i file sre dalla cartella e li conto
$fl = glob('/var/imr/fields/'.$prj.'/'.$sid.'/results/*.sre');
$contatti=count($fl);

/*
$ftp_server="46.37.21.33";
$ftp_user_name="primis";
$ftp_user_pass="Imr_PrimiFields13";
// set up basic connection
$conn_id = ftp_connect($ftp_server);

// login with username and password
$login_result = ftp_login($conn_id, $ftp_user_name, $ftp_user_pass);

// get contents of the current directory
$contents = ftp_nlist($conn_id, "/".$prj."/".$sid."/results/");


$contatti=count($contents);
*/


//CALCOLO QUERY IN BASE AI TARGET
$query_base="SELECT count(*) as total FROM t_user_info WHERE t_user_info.active=1 AND t_user_info.user_id NOT IN (SELECT uid FROM t_respint where sid='".$sid."')";


if ($target_sesso==1){$query_base=$query_base." and gender=1";}
if ($target_sesso==2){$query_base=$query_base." and gender=2";}


if ($target_age_1 <> NULL)
{
$anno_corrente = date("Y");
$anno_nascita= $anno_corrente-$target_age_1;
$query_base=$query_base." AND birth_date <= ".$anno_nascita;
}



if ($target_age_2 <> NULL)
{
$anno_corrente = date("Y")+"<br>";
$anno_nascita= $anno_corrente-$target_age_2;
$query_base=$query_base." AND birth_date >= ".$anno_nascita;
}

//echo $query_base;

/////////////////////////////////


//$qq=$_GET['txtquery'];
$qq=$query_base;

if ($qq <>'')
{
mysqli_select_db($database_admin, $admin);
$query_user_disponibili =$qq ;
$tot_user_disponibili = mysqli_query($query_user_disponibili, $admin) or die(mysql_error());
$tot_use_disponibili = mysqli_fetch_assoc($tot_user_disponibili);
}





$conta_incomplete=0;
$conta_complete=0;
$conta_filtrati=0;
$conta_quotafull=0;
$conta_incomplete_ssi=0;
$conta_complete_ssi=0;
$conta_filtrati_ssi=0;
$conta_quotafull_ssi=0;
$conta_incomplete_panel=0;
$conta_complete_panel=0;
$conta_filtrati_panel=0;
$conta_quotafull_panel=0;

for ($i = 0; $i < $contatti; $i++) {  

//trasformo la i nel formato 0001
//$nfile = sprintf('%04d', $i);

//apro il file e leggo la prima riga 
//$riga = file("ftp://primis:Imr_PrimiFields13@46.37.21.33".$contents[$i]);
//echo $fl[$i];
$riga = file($fl[$i]);
$prima_riga=$riga[0]; 
//echo $contents[$i]."<br>";


//divido il testo in array stabilendo come separatore il punto e virgola
$elementi = explode(";", $prima_riga);

//CONTA STATISTICHE TOTALI
if ($i==0) {
			$giorno_controllato=substr($elementi[4],0,10);
		    $conta_giorno=substr($elementi[4],0,10);
			$conta_giorno=str_replace('/', '-', $conta_giorno);
			//$diario[$conta_giorno]=substr($elementi[4],3,2);
			$diario[$conta_giorno]=strtotime($conta_giorno);
			
		   }
		   else
		   {
		   if ((substr($elementi[4],0,10)) != ($giorno_controllato))
					{
						$giorno_controllato=substr($elementi[4],0,10);
						$conta_giorno=substr($elementi[4],0,10);
						$conta_giorno=str_replace('/', '-', $conta_giorno);
						//$diario[$conta_giorno]=substr($elementi[4],3,2);
						$diario[$conta_giorno]=strtotime($conta_giorno);
						
					}
		   }



if ($elementi[6]==0){
					$conta_incomplete=$conta_incomplete+1;
					$diario_incomplete[$conta_giorno]=$diario_incomplete[$conta_giorno]+1;
					}
if ($elementi[6]==3){
					 $conta_complete=$conta_complete+1;
					 $diario_complete[$conta_giorno]=$diario_complete[$conta_giorno]+1;
					}
if ($elementi[6]==4){
					$conta_filtrati=$conta_filtrati+1;
					$diario_filtrati[$conta_giorno]=$diario_filtrati[$conta_giorno]+1;
					}
if ($elementi[6]==5){
					$conta_quotafull=$conta_quotafull+1;
					$diario_quotafull[$conta_giorno]=$diario_quotafull[$conta_giorno]+1;
					}

$leggi_id=$elementi[3];
$leggi_id_parziale=substr($leggi_id,0,4);

//CONTA STATISTICHE SSI
if (($elementi[6]==0)&&($leggi_id_parziale=="IDEX")){
													$conta_incomplete_ssi=$conta_incomplete_ssi+1;
													$diario_incomplete_ssi[$conta_giorno]=$diario_incomplete_ssi[$conta_giorno]+1;
													}
if (($elementi[6]==3)&&($leggi_id_parziale=="IDEX")){
													$conta_complete_ssi=$conta_complete_ssi+1;
													$diario_complete_ssi[$conta_giorno]=$diario_complete_ssi[$conta_giorno]+1;
													}
if (($elementi[6]==4)&&($leggi_id_parziale=="IDEX")){
													$conta_filtrati_ssi=$conta_filtrati_ssi+1;
													$diario_filtrati_ssi[$conta_giorno]=$diario_filtrati_ssi[$conta_giorno]+1;
													}
if (($elementi[6]==5)&&($leggi_id_parziale=="IDEX")){
													$conta_quotafull_ssi=$conta_quotafull_ssi+1;
													$diario_quotafull_ssi[$conta_giorno]=$diario_quotafull_ssi[$conta_giorno]+1;
													}




//CONTA STATISTICHE PANEL
if (($elementi[6]==0)&&($leggi_id_parziale<>"IDEX")){
													$conta_incomplete_panel=$conta_incomplete_panel+1;
													$diario_incomplete_panel[$conta_giorno]=$diario_incomplete_panel[$conta_giorno]+1;
													}
if (($elementi[6]==3)&&($leggi_id_parziale<>"IDEX")){
													$conta_complete_panel=$conta_complete_panel+1;
													$diario_complete_panel[$conta_giorno]=$diario_complete_panel[$conta_giorno]+1;
													}
if (($elementi[6]==4)&&($leggi_id_parziale<>"IDEX")){
													$conta_filtrati_panel=$conta_filtrati_panel+1;
													$diario_filtrati_panel[$conta_giorno]=$diario_filtrati_panel[$conta_giorno]+1;
													}
if (($elementi[6]==5)&&($leggi_id_parziale<>"IDEX")){
													$conta_quotafull_panel=$conta_quotafull_panel+1;
													$diario_quotafull_panel[$conta_giorno]=$diario_quotafull_panel[$conta_giorno]+1;
													}


if ($leggi_id_parziale=="IDEX"){$panel_esterno=$panel_esterno+1;}
}



$contatti_disponibili=$tot_use_disponibili['total'];


$media_redemption_panel=($medRed+$medRed2)/2;
$media_redemption_panel=number_format($media_redemption_panel, 2);


//Calcolo redemption field totale
$redemption_field=($conta_complete/($conta_complete+$conta_filtrati))*100;
$redemption_field=number_format($redemption_field, 2);


//Calcolo redemption field ssi
$redemption_field_ssi=($conta_complete_ssi/($conta_complete_ssi+$conta_filtrati_ssi))*100;
$redemption_field_ssi=number_format($redemption_field_ssi, 2);

//Calcolo redemption field panel
$redemption_field_panel=($conta_complete_panel/($conta_complete_panel+$conta_filtrati_panel))*100;
$redemption_field_panel=number_format($redemption_field_panel, 2);


$contatti_panel=$contatti-$panel_esterno;
//REDEMPTION PANEL
if ($lu['abilitati'] != 0)
{

if (($ore_differenza>24)&&($aggiornamento==true))
{
$redemption_panel=($contatti_panel/$tot_use_abilitati['total'])*100;
$redemption_panel=number_format($redemption_panel,2);
$totale_user_abilitati=$tot_use_abilitati['total'];
}
else
{
$redemption_panel=($contatti_panel/$salva_abilitati)*100;
$redemption_panel=number_format($redemption_panel,2);
$totale_user_abilitati=$salva_abilitati;
}
}
else
{
$redemption_panel=($contatti_panel/$tot_use_abilitati['total'])*100;
$redemption_panel=number_format($redemption_panel,2);
$totale_user_abilitati=$tot_use_abilitati['total'];
}
//Calcolo previsione
$previsione=($contatti_disponibili/100)*$media_redemption_panel;
$previsione=($previsione/100)*$redemption_field;
$previsione=number_format($previsione, 0);




 





?>
<script type="text/javascript">
<!--
function CompilaQuery()
{
var data = new Date();
var anno_corrente = data.getFullYear();

var eta;
var op;
if (document.getElementById('campo').value != 'birth_date')
{document.getElementById('query').value+=document.getElementById('logica').value+' '+document.getElementById('campo').value+document.getElementById('operatore').value+document.getElementById('valore').value+' ';}
else
{
if (document.getElementById('operatore').value=='>'){op='<';}
if (document.getElementById('operatore').value=='<'){op='>';}
if (document.getElementById('operatore').value=='>='){op='<=';}
if (document.getElementById('operatore').value=='<='){op='>=';}
if (document.getElementById('operatore').value=='='){op='=';}
eta=anno_corrente-document.getElementById('valore').value;
document.getElementById('query').value+=document.getElementById('logica').value+' '+document.getElementById('campo').value+op+eta+' ';
}
}
-->

var regiondb = new Object()
regiondb["gender"] = [{value:"1", text:"Maschio"},
                      {value:"2", text:"Femmina"},
                     ];
					  
					  
regiondb["birth_date"] = [
{value:"1", text:"1"},
{value:"2", text:"2"},
{value:"3", text:"3"},
{value:"4", text:"4"},
{value:"5", text:"5"},
{value:"6", text:"6"},
{value:"7", text:"7"},
{value:"8", text:"8"},
{value:"9", text:"9"},
{value:"10", text:"10"},
{value:"11", text:"11"},
{value:"12", text:"12"},
{value:"13", text:"13"},
{value:"14", text:"14"},
{value:"15", text:"15"},
{value:"16", text:"16"},
{value:"17", text:"17"},
{value:"18", text:"18"},
{value:"19", text:"19"},
{value:"20", text:"20"},
{value:"21", text:"21"},
{value:"22", text:"22"},
{value:"23", text:"23"},
{value:"24", text:"24"},
{value:"25", text:"25"},
{value:"26", text:"26"},
{value:"27", text:"27"},
{value:"28", text:"28"},
{value:"29", text:"29"},
{value:"30", text:"30"},
{value:"31", text:"31"},
{value:"32", text:"32"},
{value:"33", text:"33"},
{value:"34", text:"34"},
{value:"35", text:"35"},
{value:"36", text:"36"},
{value:"37", text:"37"},
{value:"38", text:"38"},
{value:"39", text:"39"},
{value:"40", text:"40"},
{value:"41", text:"41"},
{value:"42", text:"42"},
{value:"43", text:"43"},
{value:"44", text:"44"},
{value:"45", text:"45"},
{value:"46", text:"46"},
{value:"47", text:"47"},
{value:"48", text:"48"},
{value:"49", text:"49"},
{value:"50", text:"50"},
{value:"51", text:"51"},
{value:"52", text:"52"},
{value:"53", text:"53"},
{value:"54", text:"54"},
{value:"55", text:"55"},
{value:"56", text:"56"},
{value:"57", text:"57"},
{value:"58", text:"58"},
{value:"59", text:"59"},
{value:"60", text:"60"},
{value:"61", text:"61"},
{value:"62", text:"62"},
{value:"63", text:"63"},
{value:"64", text:"64"},
{value:"65", text:"65"},
{value:"66", text:"66"},
{value:"67", text:"67"},
{value:"68", text:"68"},
{value:"69", text:"69"},
{value:"70", text:"70"},
{value:"71", text:"71"},
{value:"72", text:"72"},
{value:"73", text:"73"},
{value:"74", text:"74"},
{value:"75", text:"75"},
{value:"76", text:"76"},
{value:"77", text:"77"},
{value:"78", text:"78"},
{value:"79", text:"79"},
{value:"80", text:"80"},
{value:"81", text:"81"},
{value:"82", text:"82"},
{value:"83", text:"83"},
{value:"84", text:"84"},
{value:"85", text:"85"},
{value:"86", text:"86"},
{value:"87", text:"87"},
{value:"88", text:"88"},
{value:"89", text:"89"},
{value:"90", text:"90"},
{value:"91", text:"91"},
{value:"92", text:"92"},
{value:"93", text:"93"},
{value:"94", text:"94"},
{value:"95", text:"95"},
{value:"96", text:"96"},
{value:"97", text:"97"},
{value:"98", text:"98"},
{value:"99", text:"99"}
					];
					
					



function setCities(chooser) {
    var newElem;
    var where = (navigator.appName == "Microsoft Internet Explorer") ? -1 : null;
    var cityChooser = chooser.form.elements["argomento"];
    while (cityChooser.options.length) {
        cityChooser.remove(0);
    }
    var choice = chooser.options[chooser.selectedIndex].value;
    var db = regiondb[choice];
    newElem = document.createElement("option");
    newElem.text = "Seleziona un argomento:";
    newElem.value = "";
    cityChooser.add(newElem, where);
    if (choice != "") {
        for (var i = 0; i < db.length; i++) {
            newElem = document.createElement("option");
            newElem.text = db[i].text;
            newElem.value = db[i].value;
            cityChooser.add(newElem, where);
        }
    }
}




</script>

<script type='text/javascript'>
        $(document).ready(function() {
        var altezza=$('.containDia').height();
		altezza=altezza-5;
		$('.infoSur').css('height',altezza);
		$('#bigbox_down').css('position','relative').css('top','-15px');
        });
</script>

<?php
$newDate = date("d-M", strtotime($lu['end_field']));
$newDateStart = date("d-M", strtotime($lu['sur_date']));
if ($lu['stato']==0){$stato="Aperta"; }
if ($lu['stato']==1){$stato="Chiusa"; }
if ($lu['sex_target']==1){$sex="Uomini";}
if ($lu['sex_target']==2){$sex="Donne";}
if ($lu['sex_target']==3){$sex="Uomini-Donne";}

?>

<div style="padding:10px" class="contSur">

<div class="infoSur" style="float:left;" >
<div class="infopt"><div class="desc">Ricerca:</div> <?php echo $sid; ?></div>
<div class="infopt"><div class="desc">Descrizione:</div><?php echo $lu['description']; ?></div>
<div class="infopt"><div class="desc">Interviste:</div><?php echo $lu['goal']; ?></div>
<div class="infopt"><div class="desc">Sesso:</div><?php echo $sex; ?></div>
<div class="infopt"><div class="desc">Età:</div><?php echo $lu['age1_target']."-".$lu['age2_target']." anni" ?></div>
<div class="infopt"><div class="desc">Inizio Field:</div><?php echo $newDateStart;  ?></div>
<div class="infopt"><div class="desc">Fine Field:</div><?php echo $newDate;  ?></div>
<div class="infopt"><div class="desc">Stato Field:</div><?php echo $stato; ?></div>
</div>



<div class="containTab" style="float:left;">
<div class="intestaDia">ANDAMENTO RICERCA</div>
	<div class="tabGen" style="float:left;" >
	<table class="tabdat" >
	<tr class="intesta"><th colspan='2'>Totale</th></tr>
	<tr> <td> Complete: </td> <td> <b><?php echo  $conta_complete; ?></b> </td> </tr>
	<tr> <td> Non in target: </td> <td> <b><?php echo  $conta_filtrati; ?></b> </td> </tr>
	<tr> <td> Over Quota: </td> <td> <b><?php echo  $conta_quotafull; ?></b> </td> </tr>
	<tr> <td> Sospese: </td> <td> <b><?php echo  $conta_incomplete; ?></b> </td> </tr>
	<tr> <td> Contatti: </td> <td> <b><?php echo  $contatti; ?></b> </td>
	<tr> <td> Abilitati: </td> <td> <b><?php echo  $tot_use_abilitati_totali['total']; ?></b> </td> </tr>
	<tr> <td> Redemption(IR): </td> <td> <b><?php echo  $redemption_field."%"; ?></b> </td> </tr> 
	</table> 
	</div>
	<?php if ($panel_in==1) 		
	{ ?>
	<div class="tabGen">
	<table class="tabdat"  >
	<tr class="intesta"><th colspan='2'>Panel</th></tr> 
	<tr> <td> Complete: </td> <td> <b><?php echo  $conta_complete_panel; ?></b> </td> </tr>
	<tr> <td> Non in target: </td> <td> <b><?php echo  $conta_filtrati_panel; ?></b> </td> </tr> 
	<tr> <td> Over Quota: </td> <td> <b><?php echo  $conta_quotafull_panel; ?></b> </td> </tr>
	<tr> <td> Sospese: </td> <td> <b><?php echo  $conta_incomplete_panel; ?></b> </td> </tr>
	<tr> <td> Contatti: </td> <td> <b><?php echo  $contatti_panel; ?></b> </td>
	<tr> <td> Abilitati: </td> <td> <b><?php echo  $tot_use_abilitati['total']; ?></b> </td> </tr>
	<tr> <td> Redemption(IR): </td> <td> <b><?php echo  $redemption_field_panel."%"; ?></b> </td> </tr>
	</table>
	</div>
	<?php 
	}
	?>	
	<?php if ($panel_esterno>0) 		
	{ ?>
	<div class="tabGen" style="float:left;">
	<table class="tabdat">
	<tr class="intesta"><th colspan='2'>Esterne</th></tr> 
	<tr> <td> Complete: </td> <td> <b><?php echo  $conta_complete_ssi; ?></b> </td> </tr>
	<tr> <td> Non in target: </td> <td> <b><?php echo  $conta_filtrati_ssi; ?></b> </td> </tr> 
	<tr> <td> Over Quota: </td> <td> <b><?php echo  $conta_quotafull_ssi; ?></b> </td> </tr>
	<tr> <td> Sospese: </td> <td> <b><?php echo  $conta_incomplete_ssi; ?></b> </td> </tr>
	<tr> <td> Contatti: </td> <td> <b><?php echo   $panel_esterno; ?></b> </td>
	<tr> <td> Abilitati: </td> <td> <b><?php echo  $tot_use_abilitati_ssi['total']; ?></b> </td> </tr>
	<tr> <td> Redemption (IR): </td> <td> <b><?php echo  $redemption_field_ssi."%"; ?></b> </td> </tr>
	</table>
	</div>
	<?php 
	}
	?>
	

	
	<?php if ($panel_in==1)
			{
			?>
			<div class="tabGenStima" style="float:left;" >
			<table class="tabdat">
			<tr class="intesta"><th colspan='2'><span style="color:red"><b>Calcolo stima</b></span></th></tr>
			<tr> <td>Utenti disponibili </td> <td> <b><?php echo  $contatti_disponibili; ?></b> </td> </tr>
			<tr> <td>% Media Panel </td> <td> <b><?php echo  $media_redemption_panel."%"; ?></b> </td> </tr>
			<tr> <td>% Panel Field </td> <td> <b><?php echo  $redemption_panel."%"; ?> </b></td> </tr>
			<tr> <td> Casi possibili: </td> <td> <b><?php echo  $previsione ?></b> </td> </tr>
			</table>
			</div>
			<?php
			}
			?>
	
	
</div>

<div class="containDia">

<div class="intestaDia">DIARIO RICERCA</div>

<div id="diarioTot">
<table class="tabdat diario">
<col>
<col span="2">
<col span="2">
<col span="2">
<col span="2">
<col>
<thead>
<th class="titleDia" colspan="11">GENERALE</th>
<tr><th><b>Giorno</b></th><th colspan="2"><b>Complete</b></th><th colspan="2"><b>Non in target</b></th><th colspan="2"><b>Over Quota</b></th><th colspan="2"><b>Sospese</b></th>
<th><b>Contatti</b></th><th><b>Incidenza</b></th></tr>
</thead>
<?php

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

echo "<tr><td>".$chiave."</td>
<td>".$diario_complete[$chiave]."</td>
<td><span>".$sumDiaComp."</span></td>
<td>".$diario_filtrati[$chiave]."</td>
<td><span>".$sumDiaFilt."</span></td>
<td>".$diario_quotafull[$chiave]."</td>
<td><span>".$sumDiaQf."</span></td>
<td>".$diario_incomplete[$chiave]."</td>
<td><span>".$sumDiaInc."</span></td>
<td><span>".$sumDiaCont."</span></td>
<td><b>".$redemption_field_giornaliero."%</b></td>
</tr>";
}
?>
</table>
</div>

<?php if ($panel_in==1)
{
?>

<div id="diaPan">
<table class="tabdat diario">
<col>
<col span="2">
<col span="2">
<col span="2">
<col span="2">
<col>
<thead>
<th class="titleDia" colspan="13">PANEL MILLEBYTES</th>
<tr><th><b>Giorno</b></th><th colspan="2"><b>Complete</b></th><th colspan="2"><b>Non in target</b></th><th colspan="2"><b>Over Quota</b></th><th colspan="2"><b>Sospese</b></th>
<th><b>Contatti</b></th><th><b>Incidenza</b></th><th><b>Panel %</b></th><th><b>Abilitati</b></th></tr>
</thead>

<?php
asort($diario);

$abilitati_totali_sample=0;
$contatti_totali_sample=0;
foreach ( $diario as $chiave => $valore) 
{ 

mysqli_select_db($database_admin, $admin);
$giorno_due_cifre=substr($chiave,0,2);
$query_user_abilitati_dp = "SELECT count(*) as total FROM t_abilitatiPanel where ((sid='".$sid."') AND (uid NOT LIKE 'IDEX%')AND (data_abilitazione LIKE '".$giorno_due_cifre."%'))";
$tot_user_abilitati_dp = mysqli_query($query_user_abilitati_dp, $admin) or die(mysql_error());
$tot_use_abilitati_dp = mysqli_fetch_assoc($tot_user_abilitati_dp);
$abilitati_totali_sample=$abilitati_totali_sample+$tot_use_abilitati_dp['total'];

if ($diario_complete_panel[$chiave]==""){$diario_complete_panel[$chiave]=0;}
if ($diario_filtrati_panel[$chiave]==""){$diario_filtrati_panel[$chiave]=0;}
if ($diario_quotafull_panel[$chiave]==""){$diario_quotafull_panel[$chiave]=0;}
if ($diario_incomplete_panel[$chiave]==""){$diario_incomplete_panel[$chiave]=0;}
$contatti_totali_sample=$contatti_totali_sample+$diario_complete_panel[$chiave]+$diario_filtrati_panel[$chiave]+$diario_quotafull_panel[$chiave]+$diario_incomplete_panel[$chiave];
$red_panel_sample=($contatti_totali_sample/$abilitati_totali_sample)*100;
$red_panel_sample=number_format($red_panel_sample, 2);

$redemption_field_giornaliero=($diario_complete_panel[$chiave]/($diario_complete_panel[$chiave]+$diario_filtrati_panel[$chiave]))*100;
$redemption_field_giornaliero=number_format($redemption_field_giornaliero, 2);

$sumPanDiaComp=$sumPanDiaComp+$diario_complete_panel[$chiave];
$sumPanDiaFilt=$sumPanDiaFilt+$diario_filtrati_panel[$chiave];
$sumPanDiaQf=$sumPanDiaQf+$diario_quotafull_panel[$chiave];
$sumPanDiaInc=$sumPanDiaInc+$diario_incomplete_panel[$chiave];
$sumPanDiaCont=$diario_complete_panel[$chiave]+$diario_filtrati_panel[$chiave]+$diario_quotafull_panel[$chiave]+$diario_incomplete_panel[$chiave];

echo "<tr><td>".$chiave."</td>
<td>".$diario_complete_panel[$chiave]."</td>
<td><span>".$sumPanDiaComp."</span></td>
<td>".$diario_filtrati_panel[$chiave]."</td>
<td><span>".$sumPanDiaFilt."</span></td>
<td>".$diario_quotafull_panel[$chiave]."</td>
<td><span>".$sumPanDiaQf."</span></td>
<td>".$diario_incomplete_panel[$chiave]."</td>
<td><span>".$sumPanDiaInc."</span></td>
<td><span>".$sumPanDiaCont."</span></td>
<td>".$redemption_field_giornaliero."%</td>
<td>".$red_panel_sample."%</td>
<td>".$abilitati_totali_sample."</td>
</tr>";


}
?>
</table>
</div>
<?php
}
?>

<?php 
if ( $panel_esterno>0)
{
?>

<div id="diarioExt">
<table class="tabdat diario">
<col>
<col span="2">
<col span="2">
<col span="2">
<col span="2">
<col>
<thead>
<th class="titleDia" colspan="11">PANEL ESTERNO</th>
<tr><th><b>Giorno</b></th><th colspan="2"><b>Complete</b></th><th colspan="2"><b>Non in target</b></th><th colspan="2"><b>Over Quota</b></th><th colspan="2"><b>Sospese</b></th>
<th><b>Contatti</b></th><th><b>Incidenza</b></th></tr>
</thead>
<?php

asort($diario);


foreach ( $diario as $chiave => $valore) 
{ 
if ($diario_complete_ssi[$chiave]==""){$diario_complete_ssi[$chiave]=0;}
if ($diario_filtrati_ssi[$chiave]==""){$diario_filtrati_ssi[$chiave]=0;}
if ($diario_quotafull_ssi[$chiave]==""){$diario_quotafull_ssi[$chiave]=0;}
if ($diario_incomplete_ssi[$chiave]==""){$diario_incomplete_ssi[$chiave]=0;}

$redemption_field_giornaliero=($diario_complete_ssi[$chiave]/($diario_complete_ssi[$chiave]+$diario_filtrati_ssi[$chiave]))*100;
$redemption_field_giornaliero=number_format($redemption_field_giornaliero, 2);

$sumExtDiaComp=$sumExtDiaComp+$diario_complete_ssi[$chiave];
$sumExtDiaFilt=$sumExtDiaFilt+$diario_filtrati_ssi[$chiave];
$sumExtDiaQf=$sumExtDiaQf+$diario_quotafull_ssi[$chiave];
$sumExtDiaInc=$sumExtDiaInc+$diario_incomplete_ssi[$chiave];
$sumExtDiaCont=$diario_complete_ssi[$chiave]+$diario_filtrati_ssi[$chiave]+$diario_quotafull_ssi[$chiave]+$diario_incomplete_ssi[$chiave];

echo "<tr>
<td>".$chiave."</td>
<td>".$diario_complete_ssi[$chiave]."</td>
<td><span>".$sumExtDiaComp."</span></td>
<td>".$diario_filtrati_ssi[$chiave]."</td>
<td><span>".$sumExtDiaFilt."</span></td>
<td>".$diario_quotafull_ssi[$chiave]."</td>
<td><span>".$sumExtDiaQf."</span></td>
<td>".$diario_incomplete_ssi[$chiave]."</td>
<td><span>".$sumExtDiaInc."</span></td>
<td><span>".$sumExtDiaCont."</span></td>
<td>".$redemption_field_giornaliero."%</td>
</tr>";
}
?>
</table>
</div>
<?php
}
?>





</div>

 <div style="float:left;">&nbsp;</div>	

  <form style="position:relative; left:-44px" action="csv.php" method="post" target="_blank">
        <input type="hidden" name="csv" value="<?php echo htmlspecialchars($csv) ?>" />
        <input type="hidden" name="filename" value="user_list" />
        <input type="image" value="submit" src="img/CSV.gif" />
        </form>
 
</div>


<?php

if ($stato_ricerca != 1)
{
mysqli_select_db($database_admin, $admin);
$query_aggiorna_statistiche = "UPDATE t_panel_control set abilitati='".$totale_user_abilitati."', contatti='".$contatti_panel."', filtrati='".$conta_filtrati."', quota_full='".$conta_quotafull."',incomplete='".$conta_incomplete."',panel_interno='".$contatti_panel."',contatti_totali='".$contatti."',panel_esterno='".$panel_esterno."', red_panel='".$redemption_panel."', last_update='".$data."', complete='".$conta_complete."', red_surv='".$redemption_field."' where sur_id='".$sid."'";
$aggiorna_statistiche = mysqli_query($query_aggiorna_statistiche, $admin) or die(mysql_error());
$aggiorna_statistiche_t = mysqli_fetch_assoc($aggiorna_statistiche);
}
?>


<?php
if (!isset($coldx)) {
require_once('inc_col_dx.php');
}
require_once('inc_footer.php'); 
?>
