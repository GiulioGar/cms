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

}
<?php 
