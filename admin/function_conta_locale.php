 <?php
$conta_bloccate=0;
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


 //array prezzi cint
 $arrStime = array(1.35, 1.55, 2.05, 2.80, 3.75, 5.25, 8.00, 11.70, 14.65, 19.85, 1.60, 1.85, 2.35, 3.10, 4.05, 5.55, 8.25, 11.95, 14.95, 20.10, 1.90, 2.15, 2.65, 3.40, 4.35, 5.85, 8.60, 12.30, 15.25, 20.40, 2.20, 2.45, 2.95, 3.70, 4.65, 6.15, 8.90, 12.60, 15.55, 20.75, 2.55, 2.75, 3.25, 4.00, 4.95, 6.45, 9.20, 12.90, 15.85, 21.05, 2.85, 3.05, 3.60, 4.30, 5.30, 6.75, 9.50, 13.20, 16.15, 21.35, 3.50, 3.70, 4.20, 4.95, 5.90, 7.40, 10.15, 13.85, 16.80, 22.00, 4.05, 4.25, 4.80, 5.55, 6.50, 7.95, 10.70, 14.40, 17.35, 22.55, 4.70, 4.90, 5.40, 6.15, 7.10, 8.60, 11.35, 15.05, 18.00, 23.20, 5.10, 5.35, 5.85, 6.60, 7.55, 9.05, 11.75, 15.45, 18.45, 23.60, 5.55, 5.75, 6.30, 7.00, 8.00, 9.45, 12.20, 15.90, 18.85, 24.05, 5.95, 6.20, 6.70, 7.45, 8.40, 9.90, 12.65, 16.35, 19.30, 24.50, 6.40, 6.65, 7.15, 7.90, 8.85, 10.35, 13.05, 16.75, 19.75, 24.90 );
    
      /////Target
	  
	  $query_trg = "SELECT * FROM elencotag ORDER BY tag ASC";
	  $tot_targ = mysqli_query($admin,$query_trg) ;     
	 
//RICERCHE IN CORSO

$query_ricerche = "SELECT * FROM t_panel_control where stato=0  order by stato,id DESC";
$tot_ricerche = mysqli_query($admin,$query_ricerche);
	 
	 
    //Media redemption Panel//
	
	$query_conta = "SELECT COUNT(sur_id) as tot  FROM t_panel_control where panel=1 and stato=1 and sur_date like '2020%'";
	$surClo = mysqli_query($admin,$query_conta) ;
	$cloSur = mysqli_fetch_assoc($surClo);
	
	
	$query_ric = "SELECT * FROM t_panel_control where panel=1 and stato=1 and sur_date like '2020%' ";
	$tot_close = mysqli_query($admin,$query_ric) ;
	

	while ($row = mysqli_fetch_assoc($tot_close))
		{
		  $totRed=$row['red_panel']+$totRed;
		}
		$medRed=$totRed/$cloSur['tot'];
	
    // ultimi 2 mesi
	$query_conta = "SELECT COUNT(sur_id) as tot  FROM t_panel_control where panel=1 and stato=1 and sur_date > '$mesi2'";
	$surClo2 = mysqli_query($admin,$query_conta) ;
	$cloSur2 = mysqli_fetch_assoc($surClo2);
	
	
	$query_m2 = "SELECT * FROM t_panel_control where panel=1 and stato=1 and sur_date > '$mesi2' ";
	$m2_close = mysqli_query($admin,$query_m2) ;
	

	while ($row = mysqli_fetch_assoc($m2_close))
		{
		  $totRed2=$row['red_panel']+$totRed2;
		}
		$medRed2=$totRed2/$cloSur2['tot'];
		

	

//ABILITATI PANEL INTERNO

$query_user_abilitati = "SELECT count(*) as total FROM t_respint where ((sid='".$sid."') AND (uid NOT LIKE 'IDEX%'))";
$tot_user_abilitati = mysqli_query($admin,$query_user_abilitati) ;
$tot_use_abilitati = mysqli_fetch_assoc($tot_user_abilitati);


//ABILITATI PANEL ESTERNO

$query_user_abilitati_ssi = "SELECT count(*) as total FROM t_respint where ((sid='".$sid."') AND (uid LIKE 'IDEX%'))";
$tot_user_abilitati_ssi = mysqli_query($admin,$query_user_abilitati_ssi) ;
$tot_use_abilitati_ssi = mysqli_fetch_assoc($tot_user_abilitati_ssi);


//ABILITATI TOTALE

$query_user_abilitati_totali = "SELECT count(*) as total FROM t_respint where (sid='".$sid."')";
$tot_user_abilitati_totali = mysqli_query($admin,$query_user_abilitati_totali) ;
$tot_use_abilitati_totali = mysqli_fetch_assoc($tot_user_abilitati_totali);




$query_new = "SELECT user_id,email,first_name,gender,birth_date  FROM t_user_info as info, t_respint as respint where (respint.sid='".$sid."' AND respint.uid=info.user_id AND (status='1' or status='0')) ORDER BY RAND() limit 50000";
$csv_mvf = mysqli_query($admin,$query_new) ;




$query_new_attivi = "SELECT *  FROM t_user_info as info, t_respint as respint,t_user_stats as story where (respint.sid='".$sid."' AND respint.uid=info.user_id AND (status='1' or status='0') AND story.user_id=info.user_id AND story.last_update > '$mesi3' and year_surveys>0 ) limit 50000";
$csv_mvf_attivi = mysqli_query($admin,$query_new_attivi) ;


//// ESPORTA CAMPIONE MVF IN CSV ////
//lettura punteggio da assegnare
$query_cerca_punteggio = "SELECT * FROM millebytesdb.t_surveys_env where sid='$sid' and prj_name='$prj' and name='prize_complete'";
$cerca_punteggio = mysqli_query($admin,$query_cerca_punteggio);
$punteggio = mysqli_fetch_assoc($cerca_punteggio);

//lettura argomento da assegnare
$query_cerca_argo = "SELECT * FROM millebytesdb.t_surveys_env where sid='$sid' and prj_name='$prj' and name='survey_object'";
$cerca_argo = mysqli_query($admin,$query_cerca_argo);
$argomento = mysqli_fetch_assoc($cerca_argo);

//lettura punteggio da assegnare
$query_cerca_loi = "SELECT * FROM millebytesdb.t_surveys_env where sid='$sid' and prj_name='$prj' and name='length_of_interview'";
$cerca_loi = mysqli_query($admin,$query_cerca_loi);
$durata = mysqli_fetch_assoc($cerca_loi);

$bytes=$punteggio['value'];
$argo=$argomento['value'];
$loi=$durata['value'];


@$csv="uid;email;firstName;genderSuffix;sid;prj;argo;bytes;loi";
$csv .= "\n";
	
	
    while ($row = mysqli_fetch_assoc($csv_mvf)) 
    { 
            
            $uid=$row['user_id'];
            $mail=$row['email'];
            $nome=$row['first_name'];
            $sesso=$row['gender'];
            if($sesso==1){$genderTransform="o";}
            else {$genderTransform="a";}
            
			$csv .=$uid.";".$mail.";".$nome.";".$genderTransform.";".$sid.";".$prj.";".$argo.";".$bytes.";".$loi; 
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


//ESPORTA STATUS INTERVISTE ESTERNE

$query_status = "SELECT * FROM t_respint WHERE sid='$sid' and uid like 'IDEX%'";
$csv_status = mysqli_query($admin,$query_status) ;


@$csv_sta="uid;stato;stato";
$csv_sta .= "\n";

while ($row = mysqli_fetch_assoc($csv_status)) 
{ 
	$uid=$row['uid'];
	$status=$row['status'];
	if ($status==1) { $status2="suspended";}
	if ($status==3) { $status2="complete";}
	if ($status==4) { $status2="screen out";}
	if ($status==5) { $status2="quotafull";}

	if ($status !=0) 
	{
	$csv_sta .=$uid.";".$status.";".$status2; 
    $csv_sta .= "\n";
	}


}	


$query_last_update = "SELECT * FROM t_panel_control where (sur_id='".$sid."')";
$last_update = mysqli_query($admin,$query_last_update) ;
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
$query_pulisci_respint_copy_sample = mysqli_query($admin,$query_pulisci_respint_copy) ;
$query_pulisci_respint_copy_sample_t = mysqli_fetch_assoc($query_pulisci_respint_copy_sample);

//RICOPIO
$query_copia_respint_copy="INSERT t_abilitatipanel (sid, uid, prj_name)
SELECT sid, uid, prj_name
FROM t_respint
WHERE sid = '".$sid."'";
$query_copia_respint_copy_sample = mysqli_query($admin,$query_copia_respint_copy) ;
$query_copia_respint_copy_sample_t = mysqli_fetch_assoc($query_copia_respint_copy_sample);




//AGGIORNAMENTO DATA IN RESPINT//
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// RIPRISTINA DOPO PUBBLICAZIONE
$fl_sample = glob('/var/imr/fields/'.$prj.'/'.$sid.'/samples/*.txt');
//$fl_sample = glob('../var/imr/fields/'.$prj.'/'.$sid.'/samples/*.txt');

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
$aggiorna_statistiche_sample = mysqli_query($admin,$query_aggiorna_statistiche_sample) ;
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
	$aggiorna_abilitati_query = mysqli_query($admin,$query_aggiorna_abilitati_aggiornati) ;
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
	$aggiorna_abilitati_query = mysqli_query($admin,$query_aggiorna_abilitati_aggiornati) ;
	$aggiorna_abilitati_query_esegui = mysqli_fetch_assoc($aggiorna_abilitati_query);
	}
}

//echo "<br>Ultimo aggiornamento:".$ultimo_aggiornamento;
//echo "<br>Data odierna:".$data;
$confrontodata=(strtotime($data_odierna))-(strtotime($data));
$ore_differenza=($confrontodata/60)/60;
//echo "<br>Differenza:".(($confrontodata/60)/60)." ore";

//recupero tutti i file sre dalla cartella e li conto

//ATTENZIONE RIPRISTINARE IL PERCORSO DOPO PUBBLICAZIONE

$fl = glob('/var/imr/fields/'.$prj.'/'.$sid.'/results/*.sre');

//$fl = glob('../var/imr/fields/'.$prj.'/'.$sid.'/results/*.sre');

$contatti=count($fl);




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
$tot_user_disponibili = mysqli_query($admin,$query_user_disponibili) ;
$tot_use_disponibili = mysqli_fetch_assoc($tot_user_disponibili);
}

$conta_bloccate=0;
$conta_incomplete=0;
$conta_complete=0;
$conta_filtrati=0;
$conta_quotafull=0;
$conta_bloccate_ssi=0;
$conta_incomplete_ssi=0;
$conta_complete_ssi=0;
$conta_filtrati_ssi=0;
$conta_quotafull_ssi=0;
$conta_bloccate_panel=0;
$conta_incomplete_panel=0;
$conta_complete_panel=0;
$conta_filtrati_panel=0;
$conta_quotafull_panel=0;
$contaSospeso=0;
$contaSospeso2=0;
$contaSospeso3=0;
$contaFiltri=0;
$contaFiltri2=0;
$contaFiltri3=0;
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

$versionSre=$elementi[0];
if ($versionSre==="2.0") { $statSur=$elementi[8];}
else  { $statSur=$elementi[6];}

$uidSurv="";


if ($versionSre=="2.0") { $leggi_id=$elementi[4];}
else  { $leggi_id=$elementi[3];}					

$leggi_id_parziale=substr($leggi_id,0,4);

//echo "<div>".$i."-".$statSur."</div>";


//CALCOLO LOI
if ($statSur==3)
	{
	$contaCompl++;
	if ($versionSre==="2.0") 
	{	
	$startSur=substr($elementi[5],11,-4); 
	$endSur=substr($elementi[6],11,-4);
	}

	else
	{	
		$startSur=substr($elementi[4],11,-4); 
		$endSur=substr($elementi[5],11,-4);
	}

	$differenza=date_diff(date_create($endSur),date_create($startSur));  
	
	$saveDiff=$differenza->format('%i');
	
	$saveDiff2=(int)$saveDiff;
	
	//echo $saveDiff2."<br>";

$varapp=$contatori[$saveDiff2];
$varapp=$varapp+1;
$contatori[$saveDiff2]=$varapp;
	

	
	$sumDiff=$sumDiff+$saveDiff;
	}
	

	
//TRACCIA FILTRATI TOT
if ($statSur==4)
	{
	$contaFiltri++;
	$lastQf=$elementi[7];

	if ($versionSre==="2.0") 
	{	
		$lastQf=$elementi[9];
	}

	else
	{	
		$lastQf=$elementi[7];
	}

	if ($filtri[$lastQf]=='') {$filtri[$lastQf]=1;}
						 else
						 {$filtri[$lastQf]=$filtri[$lastQf]+1;}
	}


	
//TRACCIA FILTRATI INTERNE
if ($statSur==4 && $leggi_id_parziale !="IDEX")
	{
	$contaFiltri2++;

	if ($filtri2[$lastQf]=='') {$filtri2[$lastQf]=1;}
						 else
						 {$filtri2[$lastQf]=$filtri2[$lastQf]+1;}
	}

//TRACCIA FILTRATI ESTERNE
if ($statSur==4 && $leggi_id_parziale =="IDEX")
	{
	$contaFiltri3++;

	if ($filtri3[$lastQf]=='') {$filtri3[$lastQf]=1;}
						 else
						 {$filtri3[$lastQf]=$filtri3[$lastQf]+1;}
	}

//TRACCIA SOSPESI  TOT
if ($statSur==0)
	{
	$contaSospeso++;
	
	$lastQ=$elementi_ultima[1];
	if ($sospese[$lastQ]=='') {$sospese[$lastQ]=1;}
						 else
						 {$sospese[$lastQ]=$sospese[$lastQ]+1;}
	}

//TRACCIA SOSPESI INTERNE
if ($statSur==0 && $leggi_id_parziale !="IDEX")
	{
	$contaSospeso2++;
	
	$lastQ=$elementi_ultima[1];
	if ($sospese2[$lastQ]=='') {$sospese2[$lastQ]=1;}
						 else
						 {$sospese2[$lastQ]=$sospese2[$lastQ]+1;}
	}	

//TRACCIA SOSPESI  ESTERNE
if ($statSur==0 && $leggi_id_parziale =="IDEX")
	{
	$contaSospeso3++;
	
	$lastQ=$elementi_ultima[1];
	if ($sospese3[$lastQ]=='') {$sospese3[$lastQ]=1;}
						 else
						 {$sospese3[$lastQ]=$sospese3[$lastQ]+1;}
	}
	



//recupero file sdl



$sdl = file_get_contents('/var/imr/fields/'.$prj.'/'.$sid.'/'.$sid.'.sdl');
$sdlb = file('/var/imr/fields/'.$prj.'/'.$sid.'/'.$sid.'.sdl');	

/*RIPRISTINA PER TEST

$sdl = file_get_contents('../var/imr/fields/'.$prj.'/'.$sid.'/'.$sid.'.sdl');
$sdlb = file('../var/imr/fields/'.$prj.'/'.$sid.'/'.$sid.'.sdl');	

*/

//CONTA STATISTICHE TOTALI
if ($i==0) {


			if ($versionSre==="2.0") 
			{	
				$giorno_controllato=substr($elementi[5],0,10);
				$conta_giorno=substr($elementi[5],0,10);
			}

			else
			{	
				$giorno_controllato=substr($elementi[4],0,10);
				$conta_giorno=substr($elementi[4],0,10);
			}


			

			$conta_giorno=str_replace('/', '-', $conta_giorno);
			//$diario[$conta_giorno]=substr($elementi[4],3,2);
			$diario[$conta_giorno]=strtotime($conta_giorno);
			
		   }


		   else
		   {
			$nuovogiorno_controllato="";

			if ($versionSre==="2.0") {$nuovogiorno_controllato=substr($elementi[5],0,10); }
			else {$nuovogiorno_controllato=substr($elementi[4],0,10);}

		   if (($nuovogiorno_controllato != ($giorno_controllato)))
					{
						if ($versionSre=="2.0") 
						{	
							$giorno_controllato=substr($elementi[5],0,10);
							$conta_giorno=substr($elementi[5],0,10);
						}
			
						else
						{	
							$giorno_controllato=substr($elementi[4],0,10);
							$conta_giorno=substr($elementi[4],0,10);
						}



						$conta_giorno=str_replace('/', '-', $conta_giorno);
						//$diario[$conta_giorno]=substr($elementi[4],3,2);
						$diario[$conta_giorno]=strtotime($conta_giorno);
						
					}
		   }



if ($statSur==0){
					$conta_incomplete=$conta_incomplete+1;
					$diario_incomplete[$conta_giorno]=$diario_incomplete[$conta_giorno]+1;
					}
if ($statSur==3){
					 $conta_complete=$conta_complete+1;
					 $diario_complete[$conta_giorno]=$diario_complete[$conta_giorno]+1;
					}
if ($statSur==4){
					$conta_filtrati=$conta_filtrati+1;
					$diario_filtrati[$conta_giorno]=$diario_filtrati[$conta_giorno]+1;
					}
if ($statSur==5){
					$conta_quotafull=$conta_quotafull+1;
					$diario_quotafull[$conta_giorno]=$diario_quotafull[$conta_giorno]+1;
					}
					if ($statSur==7)    {
						$conta_bloccate=$conta_bloccate+1;
						}


//CONTA STATISTICHE SSI
if (($statSur==0)&&($leggi_id_parziale=="IDEX")){
													$conta_incomplete_ssi=$conta_incomplete_ssi+1;
													$diario_incomplete_ssi[$conta_giorno]=$diario_incomplete_ssi[$conta_giorno]+1;
													}
if (($statSur==3)&&($leggi_id_parziale=="IDEX")){
													$conta_complete_ssi=$conta_complete_ssi+1;
													$diario_complete_ssi[$conta_giorno]=$diario_complete_ssi[$conta_giorno]+1;
													}
if (($statSur==4)&&($leggi_id_parziale=="IDEX")){
													$conta_filtrati_ssi=$conta_filtrati_ssi+1;
													$diario_filtrati_ssi[$conta_giorno]=$diario_filtrati_ssi[$conta_giorno]+1;
													}
if (($statSur==5)&&($leggi_id_parziale=="IDEX")){
													$conta_quotafull_ssi=$conta_quotafull_ssi+1;
													$diario_quotafull_ssi[$conta_giorno]=$diario_quotafull_ssi[$conta_giorno]+1;
													}

													if (($statSur==7)&&($leggi_id_parziale=="IDEX")){
														$conta_bloccate_ssi=$conta_bloccate_ssi+1;
													
												}


//CONTA STATISTICHE PANEL
if (($statSur==0)&&($leggi_id_parziale<>"IDEX")){
													$conta_incomplete_panel=$conta_incomplete_panel+1;
													$diario_incomplete_panel[$conta_giorno]=$diario_incomplete_panel[$conta_giorno]+1;
													}
if (($statSur==3)&&($leggi_id_parziale<>"IDEX")){
													$conta_complete_panel=$conta_complete_panel+1;
													$diario_complete_panel[$conta_giorno]=$diario_complete_panel[$conta_giorno]+1;
													}
if (($statSur==4)&&($leggi_id_parziale<>"IDEX")){
													$conta_filtrati_panel=$conta_filtrati_panel+1;
													$diario_filtrati_panel[$conta_giorno]=$diario_filtrati_panel[$conta_giorno]+1;
													}
if (($statSur==5)&&($leggi_id_parziale<>"IDEX")){
													$conta_quotafull_panel=$conta_quotafull_panel+1;
													$diario_quotafull_panel[$conta_giorno]=$diario_quotafull_panel[$conta_giorno]+1;
													}


													if (($statSur==7)&&($leggi_id_parziale<>"IDEX"))    {
														$conta_bloccate_panel=$conta_bloccate_panel+1;
			
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

if (($ore_differenza>=3)&&($ore_differenza<12)&&($aggiornamento==true))
{
$redemption_panel=($contatti_panel/($lu['abilitati']+((($tot_use_abilitati['total']-$lu['abilitati'])*10)/100)))*100;
$redemption_panel=number_format($redemption_panel,2);
$totale_user_abilitati=$salva_abilitati;
//$totale_user_abilitati=$lu['abilitati']+((($tot_use_abilitati['total']-$lu['abilitati'])*30)/100);
}
if (($ore_differenza>=12)&&($ore_differenza<18)&&($aggiornamento==true))
{
$redemption_panel=($contatti_panel/($lu['abilitati']+((($tot_use_abilitati['total']-$lu['abilitati'])*20)/100)))*100;
$redemption_panel=number_format($redemption_panel,2);
$totale_user_abilitati=$salva_abilitati;
//$totale_user_abilitati=$lu['abilitati']+((($tot_use_abilitati['total']-$lu['abilitati'])*50)/100);
}
if (($ore_differenza>=18)&&($ore_differenza<24)&&($aggiornamento==true))
{
$redemption_panel=($contatti_panel/($lu['abilitati']+((($tot_use_abilitati['total']-$lu['abilitati'])*30)/100)))*100;
$redemption_panel=number_format($redemption_panel,2);
$totale_user_abilitati=$salva_abilitati;
//$totale_user_abilitati=$lu['abilitati']+((($tot_use_abilitati['total']-$lu['abilitati'])*70)/100);
}
if (($ore_differenza>=24)&&($aggiornamento==true))
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
$previsione=round($previsione);
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




//////////  progresso field//////////////
$obiet=round($lu['goal']); 
$daFare=$lu['goal']-$conta_complete;

//totale
$progressTot=$conta_complete/$obiet*100;

if ($progressTot>=100) {$progressTot=100;}

$progressTot=round($progressTot, 1);

//millebytes
$progress=$conta_complete_panel/$obiet*100;

if ($progress>=100) {$progress=100;}

$progress=round($progress, 1);

//esterne
$progressExt=$conta_complete_ssi/$obiet*100;

if ($progressExt>=100) {$progressExt=100;}

$progressExt=round($progressExt, 1);

////////// allert stima  //////////////


if ($previsione >= $daFare) {$alsuccess=1; }
else {$alsuccess=0;}

//AGGIORNA COMPLETE DIVISE PER INTERNO ED ESTERNO
$loiultima=substr($loi,0,4);
if ($loiultima==""){$loiultima=0;}

//echo "ciaooo".$loiultima;
$query_compInt = "UPDATE t_panel_control set complete_int='".$conta_complete_panel."',complete_ext='".$conta_complete_ssi."',durata='".$loiultima."' where sur_id='".$sid."'";
$aggiorna_compInt = mysqli_query($admin,$query_compInt) ;
$aggiorna_compInt_esegui = mysqli_fetch_assoc($query_compInt);




if (is_numeric($redemption_panel)){ $redemption_panel=number_format( $redemption_panel, 2); }
else  { $redemption_panel=0; }



?>


<?php

//funzioni

function giornoSettimana($mese, $giorno,$anno) {
	$jd=gregoriantojd($mese,$giorno,$anno);

	$wday= jddayofweek($jd,2);
	if($wday=="Mon") {$wday="Lun";}
	if($wday=="Tue") {$wday="Mar";}
	if($wday=="Wed") {$wday="Mer";}
	if($wday=="Thu") {$wday="Gio";}
	if($wday=="Fri") {$wday="Ven";}
	if($wday=="Sat") {$wday="Sab";}
	if($wday=="Sun") {$wday="Dom";}


	return $wday;
  }


 //calcolo cpi//
 $loi2=number_format($loi, 0);
 $redx=number_format($redemption_field, 0);


 	if ($loi2<3) {$riga2=0;}
	if ($loi2>=4 && $loi2<=6) {$riga2=1;}
	if ($loi2>=7 && $loi2<=10) {$riga2=2;}
	if ($loi2>=11 && $loi2<=15) {$riga2=3;}
	if ($loi2>=16 && $loi2<=20) {$riga2=4;}
	if ($loi2>=21 && $loi2<=25) {$riga2=5;}
	if ($loi2>=26 && $loi2<=30) {$riga2=6;}
	if ($loi2>=31 && $loi2<=35) {$riga2=7;}
	if ($loi2>=36 && $loi2<=40) {$riga2=8;}
	if ($loi2>=41 && $loi2<=45) {$riga2=9;}
	if ($loi2>=51 && $loi2<=55) {$riga2=10;}
	if ($loi2>55) {$riga2=11;}

	if ($redx>=75) {$colonna2=0;}
	if ($redx>=50  && $redx<=74) {$colonna2=1;}
	if ($redx>=30 && $redx<=49) {$colonna2=2;}
	if ($redx>=20 && $redx<=29) {$colonna2=3;}
	if ($redx>=15 && $redx<=19) {$colonna2=4;}
	if ($redx>=10 && $redx<=14) {$colonna2=5;}
	if ($redx>=7 && $redx<=9) {$colonna2=6;}
	if ($redx>=5 && $redx<=6) {$colonna2=7;}
	if ($redx>=3 && $redx<=4) {$colonna2=8;}
	if ($redx<3) {$colonna2=9;} 
	$matrice2=($riga2*10) +$colonna2;


?>