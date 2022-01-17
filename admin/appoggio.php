<?php

require_once('../Connections/admin.php'); 
require_once('inc_auth.php'); 
mysqli_select_db($admin,$database_admin);

@$azione = $_REQUEST['azione'];
$sex_target=$_REQUEST['sex_target'];
$caree=$_REQUEST['aree'];
$codreg=$_REQUEST['reg'];
$codAmp=$_REQUEST['ampiezza'];
$ag1=$_REQUEST['age1_target'];
$ag2=$_REQUEST['age2_target'];
$goal=$_REQUEST['goal'];
$sid=$_REQUEST['id_sur'];
$prj=$_REQUEST['prj'];
$tags=$_REQUEST['tag'];
$iscrizione=$_REQUEST['iscrizione'];
$currentYear=date("Y");

$codregione= explode(",", $codreg);
$aree= explode(",", $caree);
$codAmpiezza= explode(",", $codAmp);


////Calculator
$year1=$currentYear-$ag1;
$year2=$currentYear-$ag2;

$addSex="";
$addArea="";
if($aree[0]=="null") { $numArea=0;}
else { $numArea=sizeof($aree); }
$addReg="";
if($codregione[0]=="null") {$numReg=0;}
else {$numReg=sizeof($codregione);}
$addTag="";
$fromTag="";
if($codAmpiezza[0]=="null") {$numAmp=0;}
else {$numAmp=sizeof($codAmpiezza);}
$addAmp="";


// Condition to check array is empty or not


if ($numArea>0)
{
$contArea=1;
foreach ($aree as $valore) 
	{
	if($contArea>1 && $contArea<= $numArea) { $addArea=$addArea." OR "; }
	if($numArea>1 && $contArea==1) { $addArea=$addArea."("; }
	$addArea=$addArea."area=".$valore." ";
	if($numArea>1 && $contArea==$numArea) { $addArea=$addArea.")"; }
	$contArea++;

	}
}


if($numReg>0)
{
$contRegione=1;
foreach ($codregione as $valore) 
	{
	if($contRegione>1 && $contRegione<= $numReg) { $addReg=$addReg." OR "; }
	if($numReg>1 && $contRegione==1) { $addReg=$addReg."("; }
	$addReg=$addReg."reg=".$valore." ";
	if($numReg>1 && $contRegione==$numReg) { $addReg=$addReg.")"; }
	$contRegione++;

	}
}

if($numAmp>0)
{
$contAmpiezza=1;
$valPeople;

foreach ($codAmpiezza as $valore) 
	{
	if($valore==1) { $valPeople="(amp>=0 AND amp <=149999)"; }
	if($valore==2) { $valPeople="(amp>=150000 AND amp <=499999)"; }
	if($valore==3) { $valPeople="(amp>=500000 AND amp <=999999)"; }
	if($valore==4) { $valPeople="(amp>=1000000)"; }
	

	if($contAmpiezza>1 && $contAmpiezza<= $numAmp) { $addAmp=$addAmp." OR "; }
	if($numAmp>1 && $contAmpiezza==1) { $addAmp=$addAmp."("; }
	$addAmp=$addAmp.$valPeople." ";
	if($numAmp>1 && $contAmpiezza==$numAmp) { $addAmp=$addAmp.")"; }
	$contAmpiezza++;

	}
}


if($sex_target !=3) {$addSex="gender=".$sex_target." AND "; }
if($numArea>0) {$addArea=$addArea." AND ";}
if($numReg >0) { $addReg=$addReg." AND "; }
if($numAmp >0) { $addAmp=$addAmp." AND "; }
if($tags !="undefined" && $tags !="") {$fromTag=", utenti_target t";   $addTag="target='".$tags."' AND i.user_id=t.uid AND "; }


$query_new_attivi = "SELECT * FROM t_user_info i ".$fromTag."
where  
".$addSex.$addArea.$addReg.$addAmp.$addTag." active=1 AND Year(birth_date)<'$year1' and Year(birth_date)>'$year2'";

$csv_mvf_attivi = mysqli_query($admin,$query_new_attivi);


	
if ($goal=="") {$goal=100000; }

if ($azione=="DISPONIBILI")
{
$query_contaDisp = "SELECT COUNT(DISTINCT i.user_id) as total  FROM t_user_info i ".$fromTag." where ".$addSex.$addArea.$addReg.$addAmp.$addTag." active=1 AND Year(birth_date)<'$year1' and Year(birth_date)>'$year2' AND reg_date >= $iscrizione and active=1 and user_id NOT IN (SELECT uid FROM t_respint where sid='".$sid."')  ";
$contaDisp= mysqli_query($admin,$query_contaDisp);
$dataDisp=mysqli_fetch_assoc($contaDisp);


$totRed3=13;
if($tags !="") { $totRed3=35; }
$medRed3=0;

$medRed3=($dataDisp['total']/100)*$totRed3;
$medRed3=number_format($medRed3,0);

?>

<div class="udisp"><i class="fas fa-users"></i> Utenti disponibili: <span class="udisp"> </span> <?php echo $dataDisp['total']; ?> </div>
<br/>
<div class="udisp"><i class="fas fa-bullseye"></i> Casi possibili: <b><?php echo $medRed3; ?> interviste </b></div>

<?php }

if ($azione=="CREA")
{
$query_crea = "SELECT *  FROM t_user_info i ".$fromTag." where ".$addSex.$addArea.$addReg.$addAmp.$addTag." active=1 AND Year(birth_date)<'$year1' and Year(birth_date)>'$year2' and reg_date >= $iscrizione and active=1 and user_id NOT IN (SELECT uid FROM t_respint where sid='".$sid."')  ORDER BY RAND()  LIMIT ".$goal."";
$csv_mvf = mysqli_query($admin,$query_crea);
$total_rows=mysqli_num_rows($csv_mvf);

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

echo $query_cerca_punteggio;

    //// ESPORTA CAMPIONE MVF IN CSV ////

	@$csv="uid;email;firstName;genderSuffix;sid;prj;argo;bytes;loi";
	$csv .= "\n";

	
	
    while ($row = mysqli_fetch_assoc($csv_mvf)) 
    { 
            
			$uid=$row['user_id'];		
			
	
            $mail=$row['email'];
			$nome=$row['first_name'];
			$nome=str_replace('"', "", $nome);
			$nome=str_replace("'", "", $nome);
            $sesso=$row['gender'];
            if($sesso==1){$genderTransform="o";}
            else {$genderTransform="a";}
            
			$csv .=$uid.";".$mail.";".$nome.";".$genderTransform.";".$sid.";".$prj.";".$argo.";".$bytes.";".$loi; 
			$csv .= "\n";
			
			$query_abilita = "INSERT INTO t_respint VALUES ('".$sid."','".$uid."','0','-1','".$prj."')";
			mysqli_query($admin,$query_abilita);
           
    }
	

}

?>

<?php
if ($azione=="CREA")	
{
?>
<hr/>
<div class="form-row">
<h6 class="align-items-center justify-content-between text-center"><button id="alert1" class="btn btn-alert btn-success alcasi" type="button">Il campione è stato abilitato!</button></h6>
</div>
<hr/>
<div class="form-row">
<div class="udisp"><i class="fas fa-users"></i> Utenti trovati: <?php echo $total_rows; ?> </div>
<div class="form-check">
			<form action="csv.php" method="post" target="_blank">
				<input type="hidden" name="csv" value="<?php echo $csv ?>" />
				<input type="hidden" name="filename" value="user_list" />
        <input type="hidden" name="filetype" value="campione" />
        <input  class="form-control" type="image" value="submit" src="img/csv.png" />
        </form>		

</div>
</div>




<?php } ?>