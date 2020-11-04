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



$del="DELETE FROM t_test";
$resA = mysqli_query($admin,$del);

////Calculator
$year1=$currentYear-$ag1;
$year2=$currentYear-$ag2;

$addSex="";
$addTag="";
$fromTag="";


if($sex_target !=3) {$addSex="gender=".$sex_target." AND "; }
if($tags !="undefined" && $tags !="") {$fromTag=", utenti_target t";   $addTag="target='".$tags."' AND i.user_id=t.uid AND "; }


$query_new_attivi = "SELECT * FROM t_user_info i ".$fromTag."
where  
".$addSex.$addTag." active=1 AND Year(birth_date)<'$year1' and Year(birth_date)>'$year2'";

$csv_mvf_attivi = mysqli_query($admin,$query_new_attivi);



while ($row = mysqli_fetch_assoc($csv_mvf_attivi)) 
    {

	$proView=$row['province_id'];
	@include('cod_reg.php'); 

	if ( ($arView==$aree[0] || $arView==$aree[1] || $arView==$aree[2] || $arView==$aree[3]) && ($proView !=0 && $proView !=104 ))
	{
		
		$id=$row['user_id'];
		$inTab="INSERT INTO t_test(uid) VALUES('$id')";
		$resTab = mysqli_query($admin,$inTab);


	}	
	


	if (($reView==$codregione[0] || $reView==$codregione[1] || $reView==$codregione[2] || $reView==$codregione[3] || $reView==$codregione[4] || $reView==$codregione[5] || $reView==$codregione[6] || $reView==$codregione[7] || $reView==$codregione[8] || $reView==$codregione[9] || $reView==$codregione[10] || $reView==$codregione[11] || $reView==$codregione[12] || $reView==$codregione[13] || $reView==$codregione[14] || $reView==$codregione[15] || $reView==$codregione[16] || $reView==$codregione[17] || $reView==$codregione[18] || $reView==$codregione[19]) && ($proView !=0 && $proView !=104 ))
	{
	
		//echo "<div>".$codregione[1]."</div>";
		$id=$row['user_id'];
		$inTab="INSERT INTO t_test(uid) VALUES('$id')";
		$resTab = mysqli_query($admin,$inTab);

	
	}

	if ($codregione[0]=="null" && $aree[0]=="null") 
	{
		$id=$row['user_id'];
		$inTab="INSERT INTO t_test(uid) VALUES('$id')";
		$resTab = mysqli_query($admin,$inTab);

	
	}
	
}


	
if ($goal=="") {$goal=100000; }

if ($azione=="DISPONIBILI")
{
$query_contaDisp = "SELECT COUNT(*) as total FROM t_user_info i,t_test t where t.uid=i.user_id and reg_date >= $iscrizione and active=1 and user_id NOT IN (SELECT uid FROM t_respint where sid='".$sid."')  ";
$contaDisp= mysqli_query($admin,$query_contaDisp);
$dataDisp=mysqli_fetch_assoc($contaDisp);



$totRed3=18;
if($tags !="") { $totRed3=45; }
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
$query_crea = "SELECT *  FROM t_user_info i,t_test t where t.uid=i.user_id and reg_date >= $iscrizione and active=1 and user_id NOT IN (SELECT uid FROM t_respint where sid='".$sid."')  ORDER BY RAND()  LIMIT ".$goal."";
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