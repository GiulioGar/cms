<?php

require_once('../Connections/admin.php'); 
require_once('inc_auth.php'); 
mysqli_select_db($database_admin, $admin);

@$azione = $_REQUEST['azione'];
$sex_target=$_REQUEST['sex_target'];
$caree=$_REQUEST['aree'];
$codreg=$_REQUEST['reg'];
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

$contArea=1;

// Condition to check array is empty or not


if ($numArea>0)
{
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


if($sex_target !=3) {$addSex="gender=".$sex_target." AND "; }
if($numArea>0) {$addArea=$addArea." AND ";}
if($numReg >0) { $addReg=$addReg." AND "; }
if($tags !="undefined" && $tags !="") {$fromTag=", utenti_target t";   $addTag="target='".$tags."' AND i.user_id=t.uid AND "; }


$query_new_attivi = "SELECT * FROM t_user_info i ".$fromTag."
where  
".$addSex.$addArea.$addReg.$addTag." active=1 AND Year(birth_date)<'$year1' and Year(birth_date)>'$year2'";

$csv_mvf_attivi = mysqli_query($admin,$query_new_attivi);


	
if ($goal=="") {$goal=100000; }

if ($azione=="DISPONIBILI")
{
$query_contaDisp = "SELECT COUNT(DISTINCT i.user_id) as total  FROM t_user_info i ".$fromTag." where ".$addSex.$addArea.$addReg.$addTag." active=1 AND Year(birth_date)<'$year1' and Year(birth_date)>'$year2' AND reg_date >= $iscrizione and active=1 and user_id NOT IN (SELECT uid FROM t_respint where sid='".$sid."')  ";
$contaDisp= mysqli_query($admin,$query_contaDisp);
$dataDisp=mysqli_fetch_assoc($contaDisp);

echo $query_contaDisp;

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
$query_crea = "SELECT *  FROM t_user_info i ".$fromTag." where ".$addSex.$addArea.$addReg.$addTag." active=1 AND Year(birth_date)<'$year1' and Year(birth_date)>'$year2' and reg_date >= $iscrizione and active=1 and user_id NOT IN (SELECT uid FROM t_respint where sid='".$sid."')  ORDER BY RAND()  LIMIT ".$goal."";
$csv_mvf = mysqli_query($admin,$query_crea);
$total_rows=mysqli_num_rows($csv_mvf);


    //// ESPORTA CAMPIONE MVF IN CSV ////

    @$csv="uid;email;firstName;genderSuffix;sid;prj";
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
            
            $csv .=$uid.";".$mail.";".$nome.";".$genderTransform.";".$sid.";".$prj; 
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