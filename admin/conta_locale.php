<?php require_once('../Connections/admin.php'); 
	  require_once('inc_auth.php'); 
	  mysqli_select_db($database_admin, $admin);

$titolo = 'Desktop Gestionale';
$sitowebdiriferimento = 'www.millebytes.com';
$areapagina = "home";
$coldx = "no";
$mesi2=date("Y-m-d H:i:s", mktime(date("H")-6,0,0,date("m")-2,date("d"),date("Y")));
$mesi3=date("Y-m-d H:i:s", mktime(date("H")-6,0,0,date("m")-3,date("d"),date("Y")));
require_once('inc_taghead.php');
require_once('inc_tagbody.php');
$conta_incomplete=0;
$conta_filtrati=0;
$conta_complete=0;
$conta_quotafull=0;
$conta_giorno=0;
$panel_esterno=0;
$loi=0;
$sumDiff=0;
$contaCompl=0;
$redemption_panel=0;

$esci=false;
$sid=$_GET['sid'];
$prj=$_GET['prj'];
$data=date("Y-m-d H:i:s");
//echo "la ricerca è:".$sid." ".$prj;

      
	  /////Target
	  
	  $query_trg = "SELECT * FROM elencotag";
	  $tot_targ = mysqli_query($admin,$query_trg) or die(mysql_error());     
	 
	 
	 
    //Media redemption Panel//
	//anno 2014
	
	$query_conta = "SELECT COUNT(sur_id) as tot  FROM t_panel_control where panel=1 and stato=1 and sur_date like '2015%'";
	$surClo = mysqli_query($admin,$query_conta) or die(mysql_error());
	$cloSur = mysqli_fetch_assoc($surClo);
	
	
	$query_ric = "SELECT * FROM t_panel_control where panel=1 and stato=1 and sur_date like '2015%' ";
	$tot_close = mysqli_query($admin,$query_ric) or die(mysql_error());
	

	while ($row = mysqli_fetch_assoc($tot_close))
		{
		  $totRed=$row['red_panel']+$totRed;
		}
		$medRed=$totRed/$cloSur['tot'];
	
    // ultimi 2 mesi
	$query_conta = "SELECT COUNT(sur_id) as tot  FROM t_panel_control where panel=1 and stato=1 and sur_date > '$mesi2'";
	$surClo2 = mysqli_query($admin,$query_conta) or die(mysql_error());
	$cloSur2 = mysqli_fetch_assoc($surClo2);
	
	
	$query_m2 = "SELECT * FROM t_panel_control where panel=1 and stato=1 and sur_date > '$mesi2' ";
	$m2_close = mysqli_query($admin,$query_m2) or die(mysql_error());
	

	while ($row = mysqli_fetch_assoc($m2_close))
		{
		  $totRed2=$row['red_panel']+$totRed2;
		}
		$medRed2=$totRed2/$cloSur2['tot'];
		

	

//ABILITATI PANEL INTERNO

$query_user_abilitati = "SELECT count(*) as total FROM t_respint where ((sid='".$sid."') AND (uid NOT LIKE 'IDEX%'))";
$tot_user_abilitati = mysqli_query($admin,$query_user_abilitati) or die(mysql_error());
$tot_use_abilitati = mysqli_fetch_assoc($tot_user_abilitati);


//ABILITATI PANEL ESTERNO

$query_user_abilitati_ssi = "SELECT count(*) as total FROM t_respint where ((sid='".$sid."') AND (uid LIKE 'IDEX%'))";
$tot_user_abilitati_ssi = mysqli_query($admin,$query_user_abilitati_ssi) or die(mysql_error());
$tot_use_abilitati_ssi = mysqli_fetch_assoc($tot_user_abilitati_ssi);


//ABILITATI TOTALE

$query_user_abilitati_totali = "SELECT count(*) as total FROM t_respint where (sid='".$sid."')";
$tot_user_abilitati_totali = mysqli_query($admin,$query_user_abilitati_totali) or die(mysql_error());
$tot_use_abilitati_totali = mysqli_fetch_assoc($tot_user_abilitati_totali);




$query_new = "SELECT user_id,email,first_name,gender,birth_date  FROM t_user_info as info, t_respint as respint where (respint.sid='".$sid."' AND respint.uid=info.user_id AND (status='1' or status='0')) ORDER BY RAND() limit 50000";
$csv_mvf = mysqli_query($admin,$query_new) or die(mysql_error());




$query_new_attivi = "SELECT *  FROM t_user_info as info, t_respint as respint,t_user_stats as story where (respint.sid='".$sid."' AND respint.uid=info.user_id AND (status='1' or status='0') AND story.user_id=info.user_id AND story.last_update > '$mesi3' and year_surveys>0 ) limit 50000";
$csv_mvf_attivi = mysqli_query($admin,$query_new_attivi) or die(mysql_error());


//// ESPORTA CAMPIONE MVF IN CSV ////


    @$csv="uid;email;firstName;genderSuffix;sid;prj";
    $csv .= "\n";
	
	
    while ($row = mysqli_fetch_assoc($csv_mvf)) 
    { 
            
            $uid=$row['user_id'];
            $mail=$row['email'];
            $nome=$row['first_name'];
            $sesso=$row['gender'];
            if($sesso==1){$genderTransform="o";}
            else {$genderTransform="a";}
            
            $csv .=$uid.";".$mail.";".$nome.";".$genderTransform.";".$sid.";".$prj; 
            $csv .= "\n";
    } 
	
	
	
	
	
	
	@$csv_attivi="uid;email;firstName;genderSuffix;sid;prj";
    $csv_attivi .= "\n";
	
	
	
	
    while ($row = mysqli_fetch_assoc($csv_mvf_attivi)) 
    { 
            
            $uid=$row['user_id'];
            $mail=$row['email'];
            $nome=$row['first_name'];
            $sesso=$row['gender'];
            if($sesso==1){$genderTransform="o";}
            else {$genderTransform="a";}
            
            $csv_attivi .=$uid.";".$mail.";".$nome.";".$genderTransform.";".$sid.";".$prj; 
            $csv_attivi .= "\n";
    } 







$query_last_update = "SELECT * FROM t_panel_control where (sur_id='".$sid."')";
$last_update = mysqli_query($admin,$query_last_update) or die(mysql_error());
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
$query_pulisci_respint_copy="DELETE FROM t_abilitatipanel WHERE (sid='".$sid."')";
$query_pulisci_respint_copy_sample = mysqli_query($admin,$query_pulisci_respint_copy) or die(mysql_error());
$query_pulisci_respint_copy_sample_t = mysqli_fetch_assoc($query_pulisci_respint_copy_sample);

//RICOPIO
$query_copia_respint_copy="INSERT t_abilitatipanel (sid, uid, prj_name)
SELECT sid, uid, prj_name
FROM t_respint
WHERE sid = '".$sid."'";
$query_copia_respint_copy_sample = mysqli_query($admin,$query_copia_respint_copy) or die(mysql_error());
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





$query_aggiorna_statistiche_sample = "UPDATE t_abilitatipanel set data_abilitazione='".$data_creazione_file."' where (sid='".$sid."' and uid='".$id_sample[0]."' and ((data_abilitazione is NULL) or (data_abilitazione ='')))";
$aggiorna_statistiche_sample = mysqli_query($admin,$query_aggiorna_statistiche_sample) or die(mysql_error());
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
	
	$query_aggiorna_abilitati_aggiornati = "UPDATE t_panel_control set abilitati_aggiornati='".$aggiorna_abilitati."' where sur_id='".$sid."'";
	$aggiorna_abilitati_query = mysqli_query($admin,$query_aggiorna_abilitati_aggiornati) or die(mysql_error());
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
	
	$query_aggiorna_abilitati_aggiornati = "UPDATE t_panel_control set abilitati_aggiornati='".$aggiorna_abilitati."', abilitati='".$aggiorna_abilitati."' where sur_id='".$sid."'";
	$aggiorna_abilitati_query = mysqli_query($admin,$query_aggiorna_abilitati_aggiornati) or die(mysql_error());
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

$query_user_disponibili =$qq ;
$tot_user_disponibili = mysqli_query($admin,$query_user_disponibili) or die(mysql_error());
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
$contaSospeso=0;
$contaFiltri=0;
$contaCompl=0;


$conta0=0;
$conta1=0;
$conta2=0;
$conta3=0;
$conta4=0;
$conta5=0;
$conta6=0;
$conta7=0;
$conta8=0;
$conta9=0;
$conta10=0;
$conta11=0;
$conta12=0;
$conta13=0;
$conta14=0;
$conta15=0;
$conta16=0;
$conta17=0;
$conta18=0;
$conta19=0;
$conta20=0;
$conta21=0;
$conta22=0;
$conta23=0;
$conta24=0;
$conta25=0;
$conta26=0;
$conta27=0;
$conta28=0;
$conta29=0;
$conta30=0;
$conta31=0;
$conta32=0;
$conta33=0;
$conta34=0;
$varapp;


for ($i = 0; $i < $contatti; $i++) {  

//trasformo la i nel formato 0001
//$nfile = sprintf('%04d', $i);

//apro il file e leggo la prima riga 
//$riga = file("ftp://primis:Imr_PrimiFields13@46.37.21.33".$contents[$i]);
//echo $fl[$i];
$riga = file($fl[$i]);
$prima_riga=$riga[0]; 
$ultima_calc=sizeof($riga) - 1 ; 
$ultima_riga=$riga[$ultima_calc]; 
//echo $contents[$i]."<br>";


//divido il testo in array stabilendo come separatore il punto e virgola
$elementi = explode(";", $prima_riga);
$elementi_ultima = explode(";",$ultima_riga);
//controllo status ricerca
$statSur=$elementi[6];



//CALCOLO LOI
if ($statSur==3)
	{
	$contaCompl++;
	$startSur=substr($elementi[4],11,-4);
	$endSur=substr($elementi[5],11,-4);
	$differenza=date_diff(date_create($endSur),date_create($startSur));  
	
	$saveDiff=$differenza->format('%i');
	
	$saveDiff2=(int)$saveDiff;
	
	//echo $saveDiff2."<br>";

$varapp=$contatori[$saveDiff2];
$varapp=$varapp+1;
$contatori[$saveDiff2]=$varapp;
	

	
	$sumDiff=$sumDiff+$saveDiff;
	}
	
//TRACCIA SOSPESI
if ($statSur==0)
	{
	$contaSospeso++;
	$lastQ=$elementi_ultima[1];
	if ($sospese[$lastQ]=='') {$sospese[$lastQ]=1;}
						 else
						 {$sospese[$lastQ]=$sospese[$lastQ]+1;}
	}
	
//TRACCIA FILTRATI
if ($statSur==4)
	{
	$contaFiltri++;
	$lastQf=$elementi[7];
	if ($filtri[$lastQf]=='') {$filtri[$lastQf]=1;}
						 else
						 {$filtri[$lastQf]=$filtri[$lastQf]+1;}
	}


//recupero file sdl
$sdl = file_get_contents('/var/imr/fields/'.$prj.'/'.$sid.'/'.$sid.'.sdl');
$sdlb = file('/var/imr/fields/'.$prj.'/'.$sid.'/'.$sid.'.sdl');	
	
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
?>


<?php
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

if (($ore_differenza>=3)&&($ore_differenza<6)&&($aggiornamento==true))
{
$redemption_panel=($contatti_panel/($lu['abilitati']+((($tot_use_abilitati['total']-$lu['abilitati'])*30)/100)))*100;
$redemption_panel=number_format($redemption_panel,2);
$totale_user_abilitati=$salva_abilitati;
//$totale_user_abilitati=$lu['abilitati']+((($tot_use_abilitati['total']-$lu['abilitati'])*30)/100);
}
if (($ore_differenza>=6)&&($ore_differenza<10)&&($aggiornamento==true))
{
$redemption_panel=($contatti_panel/($lu['abilitati']+((($tot_use_abilitati['total']-$lu['abilitati'])*50)/100)))*100;
$redemption_panel=number_format($redemption_panel,2);
$totale_user_abilitati=$salva_abilitati;
//$totale_user_abilitati=$lu['abilitati']+((($tot_use_abilitati['total']-$lu['abilitati'])*50)/100);
}
if (($ore_differenza>=10)&&($ore_differenza<16)&&($aggiornamento==true))
{
$redemption_panel=($contatti_panel/($lu['abilitati']+((($tot_use_abilitati['total']-$lu['abilitati'])*70)/100)))*100;
$redemption_panel=number_format($redemption_panel,2);
$totale_user_abilitati=$salva_abilitati;
//$totale_user_abilitati=$lu['abilitati']+((($tot_use_abilitati['total']-$lu['abilitati'])*70)/100);
}
if (($ore_differenza>=16)&&($aggiornamento==true))
{
$redemption_panel=($contatti_panel/$tot_use_abilitati['total'])*100;
$redemption_panel=number_format($redemption_panel,2);
$totale_user_abilitati=$tot_use_abilitati['total'];
}
if (($ore_differenza<3)||($aggiornamento==false))
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
					  
					  
regiondb["birth_date"] = [ {value:"1", text:"1"}, {value:"2", text:"2"}, {value:"3", text:"3"}, {value:"4", text:"4"}, {value:"5", text:"5"}, {value:"6", text:"6"}, {value:"7", text:"7"}, {value:"8", text:"8"}, {value:"9", text:"9"}, {value:"10", text:"10"}, {value:"11", text:"11"}, {value:"12", text:"12"}, {value:"13", text:"13"}, {value:"14", text:"14"}, {value:"15", text:"15"}, {value:"16", text:"16"}, {value:"17", text:"17"}, {value:"18", text:"18"}, {value:"19", text:"19"}, {value:"20", text:"20"}, {value:"21", text:"21"}, {value:"22", text:"22"}, {value:"23", text:"23"}, {value:"24", text:"24"}, {value:"25", text:"25"}, {value:"26", text:"26"}, {value:"27", text:"27"}, {value:"28", text:"28"}, {value:"29", text:"29"}, {value:"30", text:"30"}, {value:"31", text:"31"}, {value:"32", text:"32"}, {value:"33", text:"33"}, {value:"34", text:"34"}, {value:"35", text:"35"}, {value:"36", text:"36"}, {value:"37", text:"37"}, {value:"38", text:"38"}, {value:"39", text:"39"}, {value:"40", text:"40"}, {value:"41", text:"41"}, {value:"42", text:"42"}, {value:"43", text:"43"}, {value:"44", text:"44"}, {value:"45", text:"45"}, {value:"46", text:"46"}, {value:"47", text:"47"}, {value:"48", text:"48"}, {value:"49", text:"49"}, {value:"50", text:"50"}, {value:"51", text:"51"}, {value:"52", text:"52"}, {value:"53", text:"53"}, {value:"54", text:"54"}, {value:"55", text:"55"}, {value:"56", text:"56"}, {value:"57", text:"57"}, {value:"58", text:"58"}, {value:"59", text:"59"}, {value:"60", text:"60"}, {value:"61", text:"61"}, {value:"62", text:"62"}, {value:"63", text:"63"}, {value:"64", text:"64"}, {value:"65", text:"65"}, {value:"66", text:"66"}, {value:"67", text:"67"}, {value:"68", text:"68"}, {value:"69", text:"69"}, {value:"70", text:"70"}, {value:"71", text:"71"}, {value:"72", text:"72"}, {value:"73", text:"73"}, {value:"74", text:"74"}, {value:"75", text:"75"}, {value:"76", text:"76"}, {value:"77", text:"77"}, {value:"78", text:"78"}, {value:"79", text:"79"}, {value:"80", text:"80"}, {value:"81", text:"81"}, {value:"82", text:"82"}, {value:"83", text:"83"}, {value:"84", text:"84"}, {value:"85", text:"85"}, {value:"86", text:"86"}, {value:"87", text:"87"}, {value:"88", text:"88"}, {value:"89", text:"89"}, {value:"90", text:"90"}, {value:"91", text:"91"}, {value:"92", text:"92"}, {value:"93", text:"93"}, {value:"94", text:"94"}, {value:"95", text:"95"}, {value:"96", text:"96"}, {value:"97", text:"97"}, {value:"98", text:"98"}, {value:"99", text:"99"} 					];
					
					



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
/*
$(document).ready(function() {
	var alta=0;
	var altRes=$('div.statRic').height();
	var altTrac=$('div.traccia').height();
	alta=altRes+altTrac;
	$(".containTab").css("min-height",alta);
	$(".survey").css("min-height",alta);
});
*/
</script>


<script type='text/javascript'>
//Altezza menu a sinistra
        $(document).ready(function() {
		var altezza=0;
        var altezzaDes=$('.contieniDestra').height();
        var altezzaSta=$('.inRic').height();
		altezza=altezzaSta+170;
		$('.statusRic').css('height',altezza);
		$('.menuSinistra').css('height',altezzaDes+170);
		$('#footer').hide();
	
		
		
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
$loi=$sumDiff/$contaCompl;

//Conta PANEL
$contaPan=0;

if ($panel_esterno>0) { $contaPan++;}
if ($panel_in==1 || $panel_in==2) { $contaPan++;}

$contaIns=0;

?>

<div class="content-wrapper">
<div class="container">

<div class="row">

<div class="col-md-3 col-sm-3 col-xs-3">
<div class="alert alert-info back-widget-set text-center">                        
<h3>Ricerca</h3> 
<b>
<div id=''><?php echo $sid; ?>  </div>
<div id=''><?php echo $lu['description']; ?> </div>
<div>&nbsp;</div>
</b>                      
 </div>
</div>

<div class="col-md-3 col-sm-3 col-xs-3">
<div class="alert alert-success back-widget-set text-center">                        
<h3>Target:</h3>
<div><b>Interviste: </b><?php echo $lu['goal']; ?></div>
<div><b>Sesso: </b><?php echo $sex; ?></div>
<div><b>Età: </b><?php echo $lu['age1_target']."-".$lu['age2_target']." anni" ?></div>
</div>
</div>

<div class="col-md-3 col-sm-3 col-xs-23">
<div class="alert alert-warning back-widget-set text-center">                        
<h3>Tempistiche:</h3>
<div><b>Inizio Field:</b> <?php echo $newDateStart;  ?></div>
<div><b>Fine Field:</b> <?php echo $newDate;  ?></div>
<div>&nbsp;</div>
</div>
</div>


<div class="col-md-3 col-sm-3 col-xs-3">
<div class="alert alert-danger back-widget-set text-center">                        
<h3>Durata:</h3>
<div><b>Stato Field:</b> <?php echo $stato; ?></div>
<div><b>Durata intervista:</b> <span style="color:red"><?php echo substr($loi,0,4); ?> minuti</span></div>
<div>&nbsp;</div>
</div>
</div>







</div>


<div class="row">

			<?php if ($contaPan>1) 		
			{ ?>
                <div class="col-md-4 col-sm-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            TOTALE
                        </div>
                        <div class="panel-body">

								<table class="table table-striped table-bordered" >
								<tr> <td> Complete: </td> <td> <b><?php echo  $conta_complete; ?></b> </td> </tr>
								<tr> <td> Non in target: </td> <td> <b><?php echo  $conta_filtrati; ?></b> </td> </tr>
								<tr> <td> Over Quota: </td> <td> <b><?php echo  $conta_quotafull; ?></b> </td> </tr>
								<tr> <td> Sospese: </td> <td> <b><?php echo  $conta_incomplete; ?></b> </td> </tr>
								<tr> <td> Contatti: </td> <td> <b><?php echo  $contatti; ?></b> </td>
								<tr> <td> Abilitati: </td> <td> <b><?php echo  $tot_use_abilitati_totali['total']; ?></b> </td> </tr>
								<tr> <td> Redemption(IR): </td> <td> <b><?php echo  $redemption_field."%"; ?></b> </td> </tr> 
								</table> 
	
		
                            
                        </div>
                        <div class="panel-footer">
					
                            
                        </div>
                    </div>
                </div>
		<?php 
			$contaIns++;  }?>
			

				
				 <div class="col-md-4 col-sm-4">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            PANEL MILLEBYTES
                        </div>
                        <div class="panel-body">
					<?php if ($panel_in==1 || $panel_in==2) 		
						{ ?>

					
								<table class="table table-striped table-bordered"  >
								<tr> <td> Complete: </td> <td> <b><?php echo  $conta_complete_panel; ?></b> </td> </tr>
								<tr> <td> Non in target: </td> <td> <b><?php echo  $conta_filtrati_panel; ?></b> </td> </tr> 
								<tr> <td> Over Quota: </td> <td> <b><?php echo  $conta_quotafull_panel; ?></b> </td> </tr>
								<tr> <td> Sospese: </td> <td> <b><?php echo  $conta_incomplete_panel; ?></b> </td> </tr>
								<tr> <td> Contatti: </td> <td> <b><?php echo  $contatti_panel; ?></b> </td>
								<tr> <td> Abilitati: </td> <td> <b><?php echo  $tot_use_abilitati['total']; ?></b> </td> </tr>
								<tr> <td> Redemption(IR): </td> <td> <b><?php echo  $redemption_field_panel."%"; ?></b> </td> </tr>
								</table>
							<?php 
							$contaIns++;  }
			else  { echo "<h3>Non utilizzato</h3>"; } ?>
								
                            
                        </div>
                        <div class="panel-footer">
                           						<form name="modulo" action="crea_target.php" target="_blank" method="GET">
<table>
	<input type="hidden" name="sid" value="<?php echo $sid;?>" />
	<tr><td colspan="2" >Target:</td></tr>
		<tr><td>
			<select class="form-control" name="Tag">
			<?php
			while ($row = mysqli_fetch_assoc($tot_targ))
			{
			?>
		    <option value="<?php echo $row['tag'];?>"><?php echo $row['tag'];?></option>
			<?php
			}
			?>
				
			</select>
		</td>
	</tr>
	<tr>
		<td colspan="2" ><input class="btn btn-danger" type="submit" value="TAG"></td>
	</tr>
</table>
</form>

<div class="campioni">
		<div style='color:red'><b>DOWNLOAD SOLLECITO</b></div>		
			<table>
			<tr>
			<td>
			<form style="width: 50px" action="csv.php" method="post" target="_blank">
				<input type="hidden" name="csv" value="<?php echo $csv ?>" />
				<input type="hidden" name="filename" value="user_list" />
				<input class="form-control" type="image" value="submit" src="img/CSV.gif" />
				Random
				</form>
		</td>
		<td width="30">&nbsp;</td>
		<td>
				<form  style="width: 50px" action="csv.php" method="post" target="_blank">
				<input type="hidden" name="csv" value="<?php echo $csv_attivi ?>" />
				<input type="hidden" name="filename" value="user_list" />
				<input class="form-control" type="image" value="submit" src="img/CSV.gif" />
				Attivi
				</form>		
		</td>
		</tr>	
		</table>
		</div>
                        </div>
                    </div>
                </div>

				

				
					<div class="col-md-4 col-sm-4">
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                           PANEL ESTERNO
                        </div>
                        <div class="panel-body">
						
					<?php if ($panel_esterno>0) 		
						{ ?>
					
								<table class="table table-striped table-bordered">
								<tr class="intesta"><th colspan='2'>Panel esterno</th></tr> 
								<tr> <td> Complete: </td> <td> <b><?php echo  $conta_complete_ssi; ?></b> </td> </tr>
								<tr> <td> Non in target: </td> <td> <b><?php echo  $conta_filtrati_ssi; ?></b> </td> </tr> 
								<tr> <td> Over Quota: </td> <td> <b><?php echo  $conta_quotafull_ssi; ?></b> </td> </tr>
								<tr> <td> Sospese: </td> <td> <b><?php echo  $conta_incomplete_ssi; ?></b> </td> </tr>
								<tr> <td> Contatti: </td> <td> <b><?php echo   $panel_esterno; ?></b> </td>
								<tr> <td> Abilitati: </td> <td> <b><?php echo  $tot_use_abilitati_ssi['total']; ?></b> </td> </tr>
								<tr> <td> Redemption(IR): </td> <td> <b><?php echo  $redemption_field_ssi."%"; ?></b> </td> </tr>
								</table>
						
								
					<?php 
							$contaIns++;  }
			else  { echo "<h3>Non utilizzato</h3>"; } ?>
                            
                        </div>
                        <div class="panel-footer">
                            &nbsp;
                        </div>
                    </div>
                </div>
			


</div>


 <div class="row">
 
 			<?php if ($panel_in==1 || $panel_in==2)
			{
						$daFare=$lu['goal']-$conta_complete;	
						$totalRed=$conta_complete/$tot_use_abilitati_totali['total']*100;
						$totalRed=number_format($totalRed, 2);
						$inviaUtenti=$daFare*$tot_use_abilitati_totali['total']/$conta_complete;
						$inviaUtenti=number_format($inviaUtenti, 0);
						?>
						
						
             <div class="col-md-4 col-sm-4">
				
				    <div class="panel panel-info">
                        <div class="panel-heading">
                            Calcolo stima
                        </div>
                        <div class="panel-body">

						<div class="tabGen"  <?php if ($contaIns<3) { echo "style='float:left;'"; }?> >
						<table class="table table-striped table-bordered">
						<tr> <td>Utenti disponibili </td> <td> <b><?php echo  $contatti_disponibili; ?></b> </td> </tr>
						<tr> <td>% Media Panel </td> <td> <b><?php echo  $media_redemption_panel."%"; ?></b> </td> </tr>
						<tr> <td>% Panel Field </td> <td> <b><?php echo  $redemption_panel."%"; ?> </b></td> </tr>
						<tr> <td>% Total: </td> <td> <b><?php echo  $totalRed."%"; ?> </b></td> </tr>
						<tr> <td> Casi possibili </td> <td> <b><?php echo  $previsione ?></b> </td> </tr>
						<tr> <td> Da Fare: </td> <td> <b><?php echo  $daFare ?></b> </td> </tr>
						<tr> <td>Utenti da inviare: </td> <td> <b><?php echo  $inviaUtenti ?></b> </td> </tr>
						</table>
						<div id="chart_div"></div>
						</div>
					
					  
					  
					  
                        </div>
                        <div class="panel-footer">
                            &nbsp;
                        </div>
                    </div>
                </div>
		<?php
				$contaIns++; 
			}
			?>
				
				
		<div class="col-md-4 col-sm-4">
			<div class="panel panel-danger">
                        <div class="panel-heading">
                           Traccia filtrate
                        </div>
						
                <div class="panel-body">
                      
		<table class="table table-striped table-bordered">
		<tr><td>Domanda</td><td>Cod.</td><td>Num.</td><td>%</td></tr>
		<?php
		$contaImm==0;
		arsort($filtri);
		foreach ( $filtri as $chiave => $valore) 
				{
				$contaImm++;
				if ($contaImm<4) { $coltr="#F7C3C3";}
				else { $coltr="#FFF";}
				$contaRiga=0;
				//cerca testo domanda
				$ricerca=', '.trim($chiave).');'; 
				$ricerca2='new question'; 
				$txtdom="";
				$txtread="";
				$txtcompleto="";
				$code="";
				$codiceStampa="n/d";
				foreach ($sdlb as $r) 
					{
						$contaRiga++;
						$domain = strstr($r, $ricerca);
						$domain2 = strstr($r, $ricerca2);
						if ($domain !=false && $domain2 !=false) 
							{  
							$code=$sdlb[$contaRiga+1];
							$trovato=strpos($code, '"code"');
							if ($trovato != false){
							                       $code=trim($code);
												   $code=str_replace('qst.setProperty("code",','',$code);
												   $code=str_replace('");','',$code);
												   $code=str_replace('"','',$code);
												   $codiceStampa=$code;
												   
												  }
												  
							
							
							$code=$sdlb[$contaRiga+2];
							$trovato=strpos($code, '"code"');
							if ($trovato != false){
							                       $code=trim($code);
												   $code=str_replace('qst.setProperty("code",','',$code);
												   $code=str_replace('");','',$code);
												   $code=str_replace('"','',$code);
												   $codiceStampa=$code;
												   
												  }
							
							$code=$sdlb[$contaRiga+3];
							$trovato=strpos($code, '"code"');
							if ($trovato != false){
							                       $code=trim($code);
												   $code=str_replace('qst.setProperty("code",','',$code);
												   $code=str_replace('");','',$code);
												   $code=str_replace('"','',$code);
												   $codiceStampa=$code;
												  
												  }
							
							$txtdom=$sdlb[$contaRiga]; 
							$txtread = explode('"',$txtdom);
							$contaT=0;
							foreach ($txtread as $t) 
								{
								$contaT++;
								if ($contaT>2)
									{
										$txtread[$contaT]=str_replace('+"', ' ', $txtread[$contaT]);
										$txtread[$contaT]=str_replace('"+', ' ', $txtread[$contaT]);
										$txtcompleto=$txtcompleto.$txtread[$contaT];
										
									}
								}
							
							}
						if($txtcompleto=="") { $txtstamp="Testo non disponibile";}
						else { $txtstamp=$txtcompleto;}
						$txtstamp=strip_tags($txtstamp);
						$txtstamp=str_replace(");","",$txtstamp);
					}
				
				if ($contaImm<10)
					{
					$perfDam=$valore/$contaFiltri*100;
					echo "<tr style='background:".$coltr."'>
					<td><a href='#' class='tooltip_default'title='".html_entity_decode($txtstamp, ENT_QUOTES,'UTF-8')."'/> q".$chiave."</a></td>
					<td><a href='#' class='tooltip_default'title='".html_entity_decode($txtstamp, ENT_QUOTES,'UTF-8')."'/>".$codiceStampa."</a></td>
					<td><b>".$valore."</b></td>
					<td><b>".round($perfDam)."%</b></td></tr>";
					}	
					
				}
		$contaIns++;		
		?>
		</table>
			</div>
                        <div class="panel-footer">
                            &nbsp;
                        </div>
                    </div>
            </div>
			
			
<div class="col-md-4 col-sm-4">
			<div class="panel panel-warning">
                        <div class="panel-heading">
                           Traccia sospese
                        </div>
                        <div class="panel-body">
                      
			<table class="table table-striped table-bordered">
		<tr><td>Domanda</td><td>Cod.</td><td>Num.</td><td>%</td></tr>
		<?php
		$contaImm2==0;
		
		arsort($sospese);
		foreach ( $sospese as $chiave => $valore) 
				{
				$contaImm2++;
				if ($contaImm2<4) { $coltr="#F7C3C3";}
				else { $coltr="#FFF";}
				$contaRiga=0;
				//cerca testo domanda
						
				$ricerca=', '.trim($chiave).');'; 
				$ricerca2='new question'; 
				$txtdom="";
				$txtread="";
				$txtcompleto="";
				$code="";
				$codiceStampa="n/d";
				
				foreach ($sdlb as $r) 
					{
						$contaRiga++;
						$domain = strstr($r, $ricerca);
						$domain2 = strstr($r, $ricerca2);
						if ($domain !=false && $domain2 !=false) 
							{  
							$code=$sdlb[$contaRiga+1];
							$trovato=strpos($code, '"code"');
							if ($trovato != false){
							                       $code=trim($code);
												   $code=str_replace('qst.setProperty("code",','',$code);
												   $code=str_replace('");','',$code);
												   $code=str_replace('"','',$code);
												   $codiceStampa=$code;
												   
												  }
												  
							
							
							$code=$sdlb[$contaRiga+2];
							$trovato=strpos($code, '"code"');
							if ($trovato != false){
							                       $code=trim($code);
												   $code=str_replace('qst.setProperty("code",','',$code);
												   $code=str_replace('");','',$code);
												   $code=str_replace('"','',$code);
												   $codiceStampa=$code;
												   
												  }
							
							$code=$sdlb[$contaRiga+3];
							$trovato=strpos($code, '"code"');
							if ($trovato != false){
							                       $code=trim($code);
												   $code=str_replace('qst.setProperty("code",','',$code);
												   $code=str_replace('");','',$code);
												   $code=str_replace('"','',$code);
												   $codiceStampa=$code;
												  
												  }
							
							
							$txtdom=$sdlb[$contaRiga]; 
							$txtread = explode('"',$txtdom);
							$contaT=0;
							foreach ($txtread as $t) 
								{
								$contaT++;
								if ($contaT>2)
									{
										$txtread[$contaT]=str_replace('+"', ' ', $txtread[$contaT]);
										$txtread[$contaT]=str_replace('"+', ' ', $txtread[$contaT]);
										$txtcompleto=$txtcompleto.$txtread[$contaT];
									}
								}
							
							}
						if($txtcompleto=="") { $txtstamp="Testo non disponibile";}
						else { $txtstamp=$txtcompleto;}
						$txtstamp=strip_tags($txtstamp);
						$txtstamp=str_replace(");","",$txtstamp);
						
						
						
					}
				if ($contaImm2<10)
					{
					$perDam=$valore/$contaSospeso*100;
					echo "<tr style='background:".$coltr."'>
					<td><a href='#' class='tooltip_default'title='".html_entity_decode($txtstamp, ENT_QUOTES,'UTF-8')."'/> q".$chiave."</a></td>
					<td><a href='#' class='tooltip_default'title='".html_entity_decode($txtstamp, ENT_QUOTES,'UTF-8')."'/>".$codiceStampa."</a></td>
					<td><b>".$valore."</b></td>
					<td><b>".round($perDam)."%</b></td></tr>";
					}	
					
				}
		$contaIns++;	
		?>
		</table>
					  
					  
                        </div>
                        <div class="panel-footer">
                            &nbsp;
                        </div>
             </div>
            </div>			
 
 

</div> 


<div class="row">

            <div class="col-md-4 col-sm-4">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                           Controllo quote
                        </div>
                        <div class="panel-body">
                           <?php
			$query_quo = "SELECT * FROM millebytesdb.t_quota_status where survey_id='$sid' and project_name='$prj' order by target_name ASC";
			$tot_quo = mysqli_query($admin,$query_quo) or die(mysql_error());
			$num_righe = mysqli_num_rows($tot_quo);
			
		if ($num_righe>0)
		{	
		?>
	
		
					<table class="table table-striped table-bordered">
				<tr class="intesta"><th colspan='4'><span style="color:red"><b>QUOTE</b></span></th></tr>
				<?php

				
				echo "<tr><td><b>Target</b></td><td><b>Totale</b></td><td><b>Svolte</b></td><td><b>Da fare</b></td></tr>";
				$sfondo="";
				
				
				while ($row = mysqli_fetch_assoc($tot_quo))
					{
					$diffQuo=$row['current_value']-$row['target_value'];
					if ($diffQuo>=0) { $sfondo="style='background-color:red; font-weight:bold;'";}
					else  { $sfondo="";}
					
					
					
					  echo "<tr><td><b>".$row['target_name']."</b></td><td>".$row['target_value']."</td><td>".$row['current_value']."</td><td ".$sfondo.">".$diffQuo."</td></tr>";
					}

				?>
				</table>
					<?php } 
					else  {echo "<h3>Nessuna quota impostata</h3>";}
					?>	
					
					
                        </div>
                        <div class="panel-footer">
                            &nbsp;
                        </div>
                    </div>
                </div>



                <div class="col-md-8 col-sm-8">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            DIARIO RICERCA
                        </div>
                        <div class="panel-body">
						
						<?php if ($contaPan>1) 
							{ ?>
								
							<div id="diarioTot">
							<table class="table table-striped table-bordered" style="font-size:11px;"  >
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
							if ($diario_complete[$chiave]==0) { $redemption_field_giornaliero="N.D.";}
							else { $redemption_field_giornaliero=$redemption_field_giornaliero."%"; }

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
							<td><b>".$redemption_field_giornaliero."</b></td>
							</tr>";
							}
							?>
							</table>
							</div>
							<?php  } ?>
							
							
							
							
						
<?php if ($panel_in==1 || $panel_in==2)
{
									?>

									<div id="diaPan">
									<table class="table table-striped table-bordered" style="font-size:11px;">
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


									$giorno_due_cifre=substr($chiave,0,2);
									$query_user_abilitati_dp = "SELECT count(*) as total FROM t_abilitatipanel where ((sid='".$sid."') AND (uid NOT LIKE 'IDEX%')AND (data_abilitazione LIKE '".$giorno_due_cifre."%'))";
									$tot_user_abilitati_dp = mysqli_query($admin,$query_user_abilitati_dp) or die(mysql_error());
									$tot_use_abilitati_dp = mysqli_fetch_assoc($tot_user_abilitati_dp);
									$abilitati_totali_sample=$abilitati_totali_sample+$tot_use_abilitati_dp['total'];

									if ($diario_complete_panel[$chiave]==""){$diario_complete_panel[$chiave]=0;}
									if ($diario_filtrati_panel[$chiave]==""){$diario_filtrati_panel[$chiave]=0;}
									if ($diario_quotafull_panel[$chiave]==""){$diario_quotafull_panel[$chiave]=0;}
									if ($diario_incomplete_panel[$chiave]==""){$diario_incomplete_panel[$chiave]=0;}
									$contatti_totali_sample=$contatti_totali_sample+$diario_complete_panel[$chiave]+$diario_filtrati_panel[$chiave]+$diario_quotafull_panel[$chiave]+$diario_incomplete_panel[$chiave];
									$red_panel_sample=($contatti_totali_sample/$abilitati_totali_sample)*100;
									$red_panel_sample=number_format($red_panel_sample, 2);

									$redemption_field_giornalieroMb=($diario_complete_panel[$chiave]/($diario_complete_panel[$chiave]+$diario_filtrati_panel[$chiave]))*100;
									$redemption_field_giornalieroMb=number_format($redemption_field_giornalieroMb, 2);

									$sumPanDiaComp=$sumPanDiaComp+$diario_complete_panel[$chiave];
									$sumPanDiaFilt=$sumPanDiaFilt+$diario_filtrati_panel[$chiave];
									$sumPanDiaQf=$sumPanDiaQf+$diario_quotafull_panel[$chiave];
									$sumPanDiaInc=$sumPanDiaInc+$diario_incomplete_panel[$chiave];
									$sumPanDiaCont=$diario_complete_panel[$chiave]+$diario_filtrati_panel[$chiave]+$diario_quotafull_panel[$chiave]+$diario_incomplete_panel[$chiave];
									if ($diario_complete_panel[$chiave]==0) { $redemption_field_giornalieroMb="N.D.";}
									else { $redemption_field_giornalieroMb=$redemption_field_giornalieroMb."%"; }

									if ($sumPanDiaCont>2 || $sumPanDiaComp>0)
									{
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
									<td>".$redemption_field_giornalieroMb."</td>
									<td>".$red_panel_sample."%</td>
									<td>".$abilitati_totali_sample."</td>
									</tr>";
									}

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
									<table class="table table-striped table-bordered" style="font-size:11px;">
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

									$redemption_field_giornalieroEx=($diario_complete_ssi[$chiave]/($diario_complete_ssi[$chiave]+$diario_filtrati_ssi[$chiave]))*100;
									$redemption_field_giornalieroEx=number_format($redemption_field_giornalieroEx, 2);

									$sumExtDiaComp=$sumExtDiaComp+$diario_complete_ssi[$chiave];
									$sumExtDiaFilt=$sumExtDiaFilt+$diario_filtrati_ssi[$chiave];
									$sumExtDiaQf=$sumExtDiaQf+$diario_quotafull_ssi[$chiave];
									$sumExtDiaInc=$sumExtDiaInc+$diario_incomplete_ssi[$chiave];
									$sumExtDiaCont=$diario_complete_ssi[$chiave]+$diario_filtrati_ssi[$chiave]+$diario_quotafull_ssi[$chiave]+$diario_incomplete_ssi[$chiave];

									if($sumExtDiaCont>0)
									{
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
									<td>".$redemption_field_giornalieroEx."%</td>
									</tr>";
									}
									}
									?>
									</table>
									<?php
									}

									//AGGIORNA COMPLETE DIVISE PER INTERNO ED ESTERNO
										$loiultima=substr($loi,0,4);
										if ($loiultima==""){$loiultima=0;}
										
										//echo "ciaooo".$loiultima;
										$query_compInt = "UPDATE t_panel_control set complete_int='".$conta_complete_panel."',complete_ext='".$conta_complete_ssi."',durata='".$loiultima."' where sur_id='".$sid."'";
										$aggiorna_compInt = mysqli_query($admin,$query_compInt) or die(mysql_error());
										$aggiorna_compInt_esegui = mysqli_fetch_assoc($query_compInt);

										
				ksort($contatori);

							echo "<table class='table table-striped table-bordered' style='font-size:11px;'><tr><td>Minuti</td><td>Casi</td></tr>";
							foreach ( $contatori as $chiave => $valore) 
							{ 
							echo "<tr><td>".$chiave."</td><td>".$contatori[$chiave]."</td></tr>";
							}										
							echo "</table>";		
									?>
						
                            
                        </div>
                        <div class="panel-footer">
                            &nbsp;
                        </div>
                    </div>
                </div>

			
		
</div>
		

		
		



</div>
</div>

<?php


if (is_numeric($redemption_panel)){ $redemption_panel=number_format( $redemption_panel, 2); }
else  { $redemption_panel=0; }





if ($data==''){$data=date("Y-m-d H:i:s");}



if ($stato_ricerca != 1)
{

$query_aggiorna_statistiche = "UPDATE t_panel_control set abilitati='".$totale_user_abilitati."', contatti='".$contatti_panel."', filtrati='".$conta_filtrati."', quota_full='".$conta_quotafull."',incomplete='".$conta_incomplete."',panel_interno='".$contatti_panel."',contatti_totali='".$contatti."',panel_esterno='".$panel_esterno."', red_panel='".$redemption_panel."', last_update='".$data."', complete='".$conta_complete."', red_surv='".$redemption_field."' where sur_id='".$sid."' AND id <> '' ";
$aggiorna_statistiche = mysqli_query($admin,$query_aggiorna_statistiche) or die(mysqli_error());
$aggiorna_statistiche_t = mysqli_fetch_assoc($aggiorna_statistiche);


}


if (($stato_ricerca == 1)&&(($panel_in==1)||($panel_in==2))) 
{
$costo=$conta_complete_panel*0.31;


$query_aggiorna_statistiche_costo = "UPDATE t_panel_control set costo='".$costo."' where sur_id='".$sid."'";
$aggiorna_statistiche_costo = mysqli_query($admin,$query_aggiorna_statistiche_costo) or die(mysqli_error());
$aggiorna_statistiche_t_costo = mysqli_fetch_assoc($aggiorna_statistiche_costo);
}
?>

	<script type='text/javascript'>
	$(document).ready(function()
	{
	$('.tooltip_default').tooltip({track:true});
	});
	</script>

<?php

require_once('inc_footer.php'); 

mysql_close();
?>
